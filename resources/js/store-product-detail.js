import Alpine from 'alpinejs';

document.addEventListener('alpine:init', () => {
    Alpine.data('storeProductMatrix', (payload) => ({
        dimensions: payload.dimensions ?? [],
        variations: payload.variations ?? [],
        defaultMain: payload.defaultMain ?? '',
        galleryUrls: payload.galleryUrls ?? [],
        mainImageOverride: null,
        selections: {},

        init() {
            const first = this.variations[0];
            if (first && first.options) {
                Object.keys(first.options).forEach((k) => {
                    this.selections[k] = first.options[k];
                });
            }
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
                const val = v.options[key] ?? v.options[attrId];
                if (val) {
                    values.add(val);
                }
            });
            return [...values].sort((a, b) => String(a).localeCompare(String(b)));
        },

        selectValue(attrId, value) {
            this.mainImageOverride = null;
            const key = this.k(attrId);
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

        get matchingVariation() {
            return this.variations.find((v) => this.dimensions.every((d) => {
                const key = this.k(d.id);
                const need = this.selections[key];
                const got = v.options[key] ?? v.options[d.id];
                return need && got === need;
            }));
        },

        get totalPrice() {
            const m = this.matchingVariation;
            return m ? Number(m.price) : 0;
        },

        get displayMainImage() {
            if (this.mainImageOverride) {
                return this.mainImageOverride;
            }
            const m = this.matchingVariation;
            if (m && m.imageUrl) {
                return m.imageUrl;
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
});
