$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
});

function ajaxCreate(successRedirect = null) {
    $(document).on('submit', 'form.ajax-form', function (e) {
        e.preventDefault();

        const form = $(this);
        if (form.data('ajax-submit-locked')) {
            return false;
        }
        form.data('ajax-submit-locked', true);

        const submitBtn = form.find('button[type="submit"]');
        const btnOriginalText = submitBtn.length ? submitBtn.text() : 'Save';
        const formData = new FormData(this);

        const galleryInput = form.find('#galleryInput')[0];
        const usesGalleryInput = !!galleryInput;

        if (typeof Dropzone !== 'undefined' && Dropzone.instances && Dropzone.instances.length > 0 && !usesGalleryInput) {
            Dropzone.instances.forEach(function (dz) {
                dz.getQueuedFiles().forEach(function (file) {
                    const param = dz.options.paramName || 'file';
                    formData.append(param, file);
                });
            });
        }

        function handleSuccessResponse(response) {
            const methodOverride = form.find('input[name="_method"]').val();
            if (methodOverride !== 'PUT' && methodOverride !== 'PATCH') {
                form[0].reset();
            }

            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: response.message || 'Created successfully!',
                showConfirmButton: false,
                timer: 1500,
            });

            if (successRedirect) {
                setTimeout(function () {
                    window.location.href = successRedirect;
                }, 1600);
            } else if (response.redirect) {
                setTimeout(function () {
                    window.location.href = response.redirect;
                }, 1600);
            } else if (typeof $('#dataTable').DataTable === 'function') {
                $('#dataTable').DataTable().ajax.reload(null, false);
            }
        }

        function handle422(response) {
            form.find('.invalid-feedback').remove();
            form.find('.is-invalid').removeClass('is-invalid');

            if (response && response.success === false && response.message) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: response.message,
                });
            }

            const globalErrors = [];
            if (response && response.errors) {
                $.each(response.errors, function (key, messages) {
                    let input = form.find(`[name="${key}"]`);
                    if (!input.length) {
                        const dot = String(key).match(/^(.+)\.(\d+)$/);
                        if (dot) {
                            input = form.find(`[name="${dot[1]}[${dot[2]}]"]`);
                        }
                    }
                    if (!input.length) {
                        const br = String(key).match(/^(.+)\.(\d+)$/);
                        if (br) {
                            const named = form.find(`[name="${br[1]}[]"]`);
                            if (named.length) {
                                const idx = parseInt(br[2], 10);
                                input = named.eq(idx);
                            }
                        }
                    }
                    if (input.length) {
                        input.addClass('is-invalid');
                        input.after(`<div class="invalid-feedback d-block">${messages[0]}</div>`);
                    } else {
                        globalErrors.push(messages[0]);
                    }
                });
            }

            if (globalErrors.length > 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: globalErrors.join('<br>'),
                });
            }
        }

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'text',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                Accept: 'application/json',
            },
            beforeSend: function () {
                submitBtn.prop('disabled', true).text('Saving...');
            },
            success: function (raw, _textStatus, xhr) {
                const parsed =
                    typeof parseJsonFromAjaxResponse === 'function'
                        ? parseJsonFromAjaxResponse(raw)
                        : null;

                if (parsed && parsed.success) {
                    if (typeof raw === 'string' && (raw.indexOf('<b>Warning</b>') !== -1 || raw.indexOf('Maximum number of allowable file uploads') !== -1)) {
                        console.warn(
                            'Response included PHP warnings before JSON. Increase max_file_uploads and post_max_size in php.ini (or public/.user.ini) so all images are saved.',
                        );
                    }
                    handleSuccessResponse(parsed);
                    return;
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: (parsed && parsed.message) || 'Invalid response from server.',
                });
            },
            error: function (xhr) {
                const raw = xhr.responseText || '';
                const parsed =
                    xhr.responseJSON ||
                    (typeof parseJsonFromAjaxResponse === 'function' ? parseJsonFromAjaxResponse(raw) : null);

                if (parsed && parsed.success) {
                    if (raw.indexOf('<b>Warning</b>') !== -1 || raw.indexOf('Maximum number of allowable file uploads') !== -1) {
                        console.warn(
                            'Response included PHP warnings before JSON. Increase max_file_uploads and post_max_size in php.ini (or public/.user.ini) so all images are saved.',
                        );
                    }
                    handleSuccessResponse(parsed);
                    return;
                }

                if (xhr.status === 422 && parsed) {
                    handle422(parsed);
                    return;
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: (parsed && parsed.message) || 'Something went wrong!',
                });
            },
            complete: function () {
                submitBtn.prop('disabled', false).text(btnOriginalText);
                form.data('ajax-submit-locked', false);
            },
        });
    });
}
