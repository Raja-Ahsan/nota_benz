const DEBOUNCE_MS = 350;

function buildQueryString(form) {
    const params = new URLSearchParams();
    const fd = new FormData(form);
    for (const [key, value] of fd.entries()) {
        const v = typeof value === 'string' ? value.trim() : String(value);
        if (v !== '') {
            params.set(key, v);
        }
    }

    return params.toString();
}

/**
 * Artifacts listing: debounced search + instant selects; replaces grid HTML from JSON.
 */
function initArtifactsFilter() {
    const form = document.getElementById('artifacts-filter-form');
    const grid = document.querySelector('[data-artifacts-grid]');
    const countEl = document.querySelector('[data-artifacts-count]');
    const loadMoreBtn = document.querySelector('[data-artifacts-load-more]');

    if (!form || !grid) {
        return;
    }

    const url = form.getAttribute('data-filter-url');
    if (!url) {
        return;
    }

    let debounceTimer = null;
    let abortController = null;
    let currentPage = 1;
    let lastPage = Number(loadMoreBtn?.dataset.lastPage || 1);

    const setLoading = (loading) => {
        grid.classList.toggle('opacity-60', loading);
        grid.classList.toggle('pointer-events-none', loading);
    };

    const updateLoadMore = (hasMore, nextPage, newLastPage) => {
        if (!loadMoreBtn) {
            return;
        }

        if (typeof newLastPage === 'number' && !Number.isNaN(newLastPage)) {
            lastPage = newLastPage;
            loadMoreBtn.dataset.lastPage = String(newLastPage);
        }

        if (!hasMore || nextPage > lastPage) {
            loadMoreBtn.classList.add('hidden');
            return;
        }

        loadMoreBtn.classList.remove('hidden');
        loadMoreBtn.dataset.page = String(nextPage);
        loadMoreBtn.disabled = false;
        loadMoreBtn.textContent = 'Load More';
    };

    const fetchResults = async ({ append = false } = {}) => {
        if (abortController) {
            abortController.abort();
        }
        abortController = new AbortController();

        const params = new URLSearchParams(buildQueryString(form));
        params.set('page', append ? String(currentPage + 1) : '1');
        const requestUrl = `${url}?${params.toString()}`;

        setLoading(true);

        try {
            const response = await fetch(requestUrl, {
                method: 'GET',
                headers: {
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                signal: abortController.signal,
            });

            if (!response.ok) {
                const err = await response.json().catch(() => ({}));
                throw new Error(err.message || response.statusText);
            }

            const payload = await response.json();
            if (append) {
                grid.insertAdjacentHTML('beforeend', payload.html ?? '');
            } else {
                grid.innerHTML = payload.html ?? '';
            }

            if (countEl && typeof payload.count === 'number') {
                countEl.textContent = String(payload.count);
            }

            currentPage = Number(payload.current_page || 1);
            const nextPage = Number(payload.next_page || currentPage + 1);
            const hasMore = Boolean(payload.has_more);
            const payloadLastPage = Number(payload.last_page || lastPage);
            updateLoadMore(hasMore, nextPage, payloadLastPage);
        } catch (e) {
            if (e.name === 'AbortError') {
                return;
            }
            console.error('[artifacts-filter]', e);
        } finally {
            setLoading(false);
        }
    };

    const scheduleFetch = () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => fetchResults({ append: false }), DEBOUNCE_MS);
    };

    form.querySelectorAll('input[name="search"]').forEach((el) => {
        el.addEventListener('input', scheduleFetch);
    });

    form.querySelectorAll('input[name="price_min"], input[name="price_max"]').forEach((el) => {
        el.addEventListener('input', scheduleFetch);
    });

    form.querySelectorAll('select').forEach((el) => {
        el.addEventListener('change', () => {
            clearTimeout(debounceTimer);
            fetchResults({ append: false });
        });
    });

    form.addEventListener('submit', (event) => {
        event.preventDefault();
        clearTimeout(debounceTimer);
        fetchResults({ append: false });
    });

    const clearBtn = document.getElementById('artifacts-filter-clear');
    clearBtn?.addEventListener('click', (event) => {
        event.preventDefault();
        form.reset();
        clearTimeout(debounceTimer);
        fetchResults({ append: false });
    });

    loadMoreBtn?.addEventListener('click', (event) => {
        event.preventDefault();
        loadMoreBtn.disabled = true;
        loadMoreBtn.textContent = 'Loading...';
        clearTimeout(debounceTimer);
        fetchResults({ append: true });
    });
}

document.addEventListener('DOMContentLoaded', initArtifactsFilter);
