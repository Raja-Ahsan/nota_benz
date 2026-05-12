import Alpine from 'alpinejs';

document.addEventListener('alpine:init', () => {
    Alpine.data('storeProductMatrix', (payload) => ({
        dimensions: payload.dimensions ?? [],
        variations: payload.variations ?? [],
        defaultMain: payload.defaultMain ?? '',
        galleryUrls: payload.galleryUrls ?? [],
        defaultGallery: payload.defaultGallery ?? payload.galleryUrls ?? [],
        colorGalleries: payload.colorGalleries ?? {},
        colors: payload.colors ?? [],
        colorAttrId: payload.colorAttrId ?? null,
        fromPrice: payload.fromPrice ?? null,
        toPrice: payload.toPrice ?? null,
        mainImageOverride: null,
        selections: {},

        init() {
            this.dimensions.forEach((d) => {
                this.selections[this.k(d.id)] = '';
            });
            this.$watch(
                () => JSON.stringify(this.activeGalleryUrls),
                () => {
                    this.$nextTick(() => {
                        const root = this.$root?.querySelector?.('[data-thumbs-track]');
                        if (root) {
                            root.scrollLeft = 0;
                            root.dispatchEvent(new Event('scroll'));
                        }
                    });
                },
            );
        },

        k(attrId) {
            return String(attrId);
        },

        matchesPartial(v, partial) {
            for (const [key, val] of Object.entries(partial)) {
                if (! val) {
                    continue;
                }
                const got = v.options[key] ?? v.options[Number(key)];
                if (got !== val) {
                    return false;
                }
            }
            return true;
        },

        optionsForDimension(attrId) {
            const key = this.k(attrId);
            const idx = this.dimensions.findIndex((d) => this.k(d.id) === key);
            const partial = {};
            for (let i = 0; i < idx; i++) {
                const id = this.dimensions[i].id;
                const ik = this.k(id);
                if (this.selections[ik]) {
                    partial[ik] = this.selections[ik];
                }
            }
            const values = new Set();
            this.variations.forEach((v) => {
                if (! this.matchesPartial(v, partial)) {
                    return;
                }
                const val = v.options[key] ?? v.options[attrId] ?? '';
                values.add(val);
            });
            const arr = [...values];
            const dim = this.dimensions.find((d) => this.k(d.id) === key);
            const label = dim ? String(dim.name).trim().toLowerCase() : '';
            if (label === 'size') {
                arr.sort((a, b) => this.compareSizeOption(a, b));
            }
            return arr;
        },

        compareSizeOption(a, b) {
            const ra = this.sizeRank(a);
            const rb = this.sizeRank(b);
            if (ra !== rb) {
                return ra - rb;
            }
            return String(a).localeCompare(String(b), undefined, { sensitivity: 'base', numeric: true });
        },

        sizeRank(raw) {
            const s = String(raw).trim().toLowerCase().replace(/\s+/g, '');
            const alias = {
                xxs: 'xxs', '2xs': 'xxs', xs: 'xs', extraextrasmall: 'xxs', extrasmall: 'xs',
                s: 's', small: 's',
                m: 'm', medium: 'm',
                l: 'l', large: 'l',
                xl: 'xl', extralarge: 'xl', 'x-large': 'xl',
                xxl: 'xxl', '2xl': '2xl', '2xlarge': 'xxl', doublexl: 'xxl',
                xxxl: 'xxxl', '3xl': '3xl', '3xlarge': 'xxxl', triplexl: 'xxxl',
                '4xl': '4xl', '5xl': '5xl', '6xl': '6xl', '7xl': '7xl', '8xl': '8xl',
            };
            const normalized = alias[s] ?? s;
            const order = ['xxs', 'xs', 's', 'm', 'l', 'xl', 'xxl', '2xl', 'xxxl', '3xl', '4xl', '5xl', '6xl', '7xl', '8xl'];
            let i = order.indexOf(normalized);
            if (i !== -1) {
                return i;
            }
            const num = parseInt(s, 10);
            if (s !== '' && ! Number.isNaN(num) && String(num) === s) {
                return 200 + num;
            }
            return 500 + s.charCodeAt(0);
        },

        selectValue(attrId, value) {
            const key = this.k(attrId);
            if (this.colorAttrId != null && key === this.k(this.colorAttrId)) {
                this.mainImageOverride = null;
            }
            this.selections[key] = value;
            const idx = this.dimensions.findIndex((d) => this.k(d.id) === key);
            for (let i = idx + 1; i < this.dimensions.length; i++) {
                const id = this.dimensions[i].id;
                const ik = this.k(id);
                const opts = this.optionsForDimension(id);
                const cur = this.selections[ik];
                if (! opts.includes(cur)) {
                    this.selections[ik] = opts[0] ?? '';
                }
            }
        },

        isSelected(attrId, value) {
            return this.selections[this.k(attrId)] === value;
        },

        pickGallery(url) {
            this.mainImageOverride = url;
        },

        get activeGalleryUrls() {
            const cid = this.colorAttrId != null ? this.k(this.colorAttrId) : null;
            const c = cid ? String(this.selections[cid] ?? '').trim() : '';
            if (c !== '' && this.colorGalleries[c] && this.colorGalleries[c].length) {
                return this.colorGalleries[c];
            }
            const g = this.galleryUrls && this.galleryUrls.length ? this.galleryUrls : (this.defaultMain ? [this.defaultMain] : []);
            return g;
        },

        get matchingVariation() {
            const incomplete = this.dimensions.some((d) => ! String(this.selections[this.k(d.id)] ?? '').trim());
            if (incomplete) {
                return null;
            }
            return this.variations.find((v) => this.dimensions.every((d) => {
                const key = this.k(d.id);
                const need = this.selections[key];
                const got = v.options[key] ?? v.options[d.id];
                return String(need ?? '') === String(got ?? '');
            }));
        },

        get totalPrice() {
            const m = this.matchingVariation;
            return m ? Number(m.price) : 0;
        },

        get priceLine() {
            const m = this.matchingVariation;
            const from = this.fromPrice;
            const to = this.toPrice;
            if (m && Number(m.price) > 0) {
                return '$' + Number(m.price).toFixed(2);
            }
            if (m && from != null && to != null && (from > 0 || to > 0)) {
                return from === to
                    ? '$' + Number(from).toFixed(2)
                    : '$' + Number(from).toFixed(2) + ' – $' + Number(to).toFixed(2);
            }
            if (from != null && to != null && (from > 0 || to > 0)) {
                return from === to
                    ? '$' + Number(from).toFixed(2)
                    : '$' + Number(from).toFixed(2) + ' – $' + Number(to).toFixed(2);
            }
            if (m) {
                return '$' + Number(m.price).toFixed(2);
            }

            return '$0.00';
        },

        get displayMainImage() {
            if (this.mainImageOverride) {
                return this.mainImageOverride;
            }
            const urls = this.activeGalleryUrls;
            if (urls.length) {
                return urls[0];
            }
            return this.defaultMain;
        },
    }));
});

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.product-gallery[data-simple-gallery]').forEach((gallery) => {
        gallery.addEventListener('click', (e) => {
            const btn = e.target.closest('.product-gallery__thumb[data-full-src]');
            if (! btn || ! gallery.contains(btn)) {
                return;
            }
            const main = gallery.querySelector('.product-gallery__main-img');
            const src = btn.getAttribute('data-full-src');
            if (main && src) {
                main.setAttribute('src', src);
                gallery.querySelectorAll('.product-gallery__thumb').forEach((t) => {
                    t.classList.remove('is-active');
                });
                btn.classList.add('is-active');
            }
        });
    });

    document.querySelectorAll('[data-thumbs-slider]').forEach((root) => {
        const track = root.querySelector('[data-thumbs-track]');
        const prev = root.querySelector('[data-thumbs-scroll="prev"]');
        const next = root.querySelector('[data-thumbs-scroll="next"]');
        if (! track || ! prev || ! next) {
            return;
        }

        const step = () => Math.max(180, Math.floor(track.clientWidth * 0.65));

        const syncDisabled = () => {
            const maxScroll = Math.max(0, track.scrollWidth - track.clientWidth);
            const left = track.scrollLeft;
            prev.disabled = left <= 1;
            next.disabled = left >= maxScroll - 1;
        };

        prev.addEventListener('click', () => {
            track.scrollBy({ left: -step(), behavior: 'smooth' });
        });
        next.addEventListener('click', () => {
            track.scrollBy({ left: step(), behavior: 'smooth' });
        });
        track.addEventListener('scroll', syncDisabled, { passive: true });
        if (typeof ResizeObserver !== 'undefined') {
            new ResizeObserver(syncDisabled).observe(track);
        }
        window.addEventListener('load', syncDisabled, { once: true });
        syncDisabled();
    });
});
