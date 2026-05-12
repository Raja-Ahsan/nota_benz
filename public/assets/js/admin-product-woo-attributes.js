/**
 * Grouped product variations (attr_blocks). Vanilla JS, scoped to product create/edit forms only.
 * Re-indexes names before submit (capture phase) so the existing ajax-form / FormData flow stays intact.
 */
(function () {
    'use strict';

    var FORM_IDS = ['createProductForm', 'editProductForm'];

    function getProductForm(el) {
        if (!el || !el.closest) {
            return null;
        }
        var f = el.closest('form');
        if (!f || !f.id) {
            return null;
        }
        return FORM_IDS.indexOf(f.id) !== -1 ? f : null;
    }

    function reindexWooAttrBlocks(form) {
        var container = form.querySelector('#attr-blocks-container');
        if (!container) {
            return;
        }
        var blocks = container.querySelectorAll('.js-woo-attr-block');
        blocks.forEach(function (block, bi) {
            var colorInp = block.querySelector('.js-woo-color');
            if (colorInp) {
                colorInp.setAttribute('name', 'attr_blocks[' + bi + '][color]');
            }
            var rows = block.querySelectorAll('.js-woo-rows-tbody .js-woo-row');
            rows.forEach(function (row, ri) {
                var sizeInp = row.querySelector('.js-woo-size');
                var priceInp = row.querySelector('.js-woo-price');
                var imgInp = row.querySelector('.js-woo-image');
                if (sizeInp) {
                    sizeInp.setAttribute('name', 'attr_blocks[' + bi + '][rows][' + ri + '][size]');
                }
                if (priceInp) {
                    priceInp.setAttribute('name', 'attr_blocks[' + bi + '][rows][' + ri + '][price]');
                }
                if (imgInp) {
                    imgInp.setAttribute('name', 'attr_blocks[' + bi + '][rows][' + ri + '][image]');
                }
            });

            var cgInput = block.querySelector('.js-color-gallery-input');
            if (cgInput) {
                cgInput.setAttribute('name', 'attr_blocks[' + bi + '][color_gallery][]');
            }
            block.querySelectorAll('.js-color-gallery-keep').forEach(function (keepInp) {
                keepInp.setAttribute('name', 'attr_blocks[' + bi + '][color_gallery_keep][]');
            });
        });
    }

    function pruneEmptyWooRows(form) {
        var container = form.querySelector('#attr-blocks-container');
        if (!container) {
            return;
        }
        container.querySelectorAll('.js-woo-rows-tbody').forEach(function (tb) {
            var rows = tb.querySelectorAll('.js-woo-row');
            rows.forEach(function (tr) {
                var sizeInp = tr.querySelector('.js-woo-size');
                var priceInp = tr.querySelector('.js-woo-price');
                var imgInp = tr.querySelector('.js-woo-image');
                var size = sizeInp && sizeInp.value ? sizeInp.value.trim() : '';
                var price = priceInp && priceInp.value ? priceInp.value.trim() : '';
                var hasFile = imgInp && imgInp.files && imgInp.files.length > 0;
                if (size === '' && price === '' && !hasFile) {
                    if (tb.querySelectorAll('.js-woo-row').length > 1) {
                        tr.remove();
                    }
                }
            });
            if (tb.querySelectorAll('.js-woo-row').length === 0) {
                appendRowToTbody(tb);
            }
        });
    }

    function appendRowToTbody(tbody) {
        var tpl = document.getElementById('woo-tpl-row');
        if (!tpl || !tpl.content) {
            return;
        }
        var frag = tpl.content.cloneNode(true);
        var tr = frag.querySelector('tr');
        if (tr) {
            tbody.appendChild(tr);
        }
    }

    function appendEmptyBlock(container) {
        var tpl = document.getElementById('woo-tpl-block');
        if (!tpl || !tpl.content) {
            return;
        }
        var frag = tpl.content.cloneNode(true);
        var block = frag.querySelector('.js-woo-attr-block');
        if (!block) {
            return;
        }
        container.appendChild(block);
        var tb = block.querySelector('.js-woo-rows-tbody');
        if (tb) {
            appendRowToTbody(tb);
        }
    }

    function onSubmitCapture(e) {
        var form = e.target;
        if (!form || form.tagName !== 'FORM') {
            return;
        }
        if (FORM_IDS.indexOf(form.id) === -1) {
            return;
        }
        var typeSel = form.querySelector('#product_type_id');
        var slug = typeSel && typeSel.options[typeSel.selectedIndex]
            ? typeSel.options[typeSel.selectedIndex].getAttribute('data-slug')
            : '';
        if (slug !== 'variable') {
            return;
        }
        pruneEmptyWooRows(form);
        reindexWooAttrBlocks(form);
    }

    function onClick(e) {
        var t = e.target;
        if (!t.closest) {
            return;
        }
        var form = getProductForm(t);
        if (!form) {
            return;
        }
        var typeSel = form.querySelector('#product_type_id');
        var slug = typeSel && typeSel.options[typeSel.selectedIndex]
            ? typeSel.options[typeSel.selectedIndex].getAttribute('data-slug')
            : '';
        if (slug !== 'variable') {
            return;
        }

        if (t.closest('#btn-woo-add-color-group')) {
            e.preventDefault();
            var c = form.querySelector('#attr-blocks-container');
            if (c) {
                appendEmptyBlock(c);
                reindexWooAttrBlocks(form);
                if (typeof window.initWooColorGalleryBlocksForForm === 'function') {
                    window.initWooColorGalleryBlocksForForm(form);
                }
            }
            return;
        }

        var addSizeBtn = t.closest('.js-woo-add-size');
        if (addSizeBtn) {
            e.preventDefault();
            var block = addSizeBtn.closest('.js-woo-attr-block');
            var tb = block && block.querySelector('.js-woo-rows-tbody');
            if (tb) {
                appendRowToTbody(tb);
                reindexWooAttrBlocks(form);
            }
            return;
        }

        var rmBlock = t.closest('.js-woo-remove-block');
        if (rmBlock) {
            e.preventDefault();
            var blocks = form.querySelectorAll('#attr-blocks-container .js-woo-attr-block');
            if (blocks.length <= 1) {
                return;
            }
            rmBlock.closest('.js-woo-attr-block').remove();
            reindexWooAttrBlocks(form);
            return;
        }

        var rmRow = t.closest('.js-woo-remove-row');
        if (rmRow) {
            e.preventDefault();
            var row = rmRow.closest('.js-woo-row');
            var tbody = row && row.closest('.js-woo-rows-tbody');
            if (!tbody || !row) {
                return;
            }
            if (tbody.querySelectorAll('.js-woo-row').length <= 1) {
                return;
            }
            row.remove();
            reindexWooAttrBlocks(form);
        }
    }

    document.addEventListener('submit', onSubmitCapture, true);
    document.addEventListener('click', onClick, false);
})();
