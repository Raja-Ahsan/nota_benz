@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css" />
    <style>
        .blog-summernote-wrap .note-editor.note-frame {
            border-color: rgba(255, 255, 255, 0.12);
        }
        .blog-summernote-wrap .note-toolbar {
            background: #1e1e1e;
            border-bottom-color: rgba(255, 255, 255, 0.12);
        }
        .blog-summernote-wrap .note-editable {
            background: #fafafa;
            color: #1a1a1a;
            min-height: 320px;
        }
        .blog-summernote-wrap .note-status-output {
            display: none;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>
    <script>
        (function() {
            var uploadUrl = @json(route('blogs.summernote-upload-image'));
            var csrf = $('meta[name="csrf-token"]').attr('content');
            var msgUploadFailed = @json(__('Image upload failed.'));
            var msgInsertImage = @json(__('Insert image'));

            function toAbsoluteImageUrl(u) {
                if (!u || typeof u !== 'string') {
                    return u;
                }
                if (/^https?:\/\//i.test(u)) {
                    return u;
                }
                return window.location.origin + (u.charAt(0) === '/' ? u : '/' + u);
            }

            function uploadBlogBodyImages(files) {
                var $ta = $('#blog_body');
                if (!files || !files.length) {
                    return;
                }
                for (var i = 0; i < files.length; i++) {
                    (function(file) {
                        var data = new FormData();
                        data.append('image', file);
                        data.append('_token', csrf);
                        $.ajax({
                            url: uploadUrl,
                            type: 'POST',
                            data: data,
                            dataType: 'json',
                            processData: false,
                            contentType: false,
                            headers: {
                                'X-CSRF-TOKEN': csrf,
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json',
                            },
                        })
                            .done(function(res) {
                                if (typeof res === 'string') {
                                    try {
                                        res = JSON.parse(res);
                                    } catch (e) {
                                        res = null;
                                    }
                                }
                                var raw = res && res.url ? res.url : '';
                                var abs = toAbsoluteImageUrl(raw);
                                if (abs) {
                                    $ta.summernote('focus');
                                    $ta.summernote('insertImage', abs);
                                    $ta.val($ta.summernote('code'));
                                } else if (typeof Swal !== 'undefined') {
                                    Swal.fire({ icon: 'error', title: msgUploadFailed });
                                } else {
                                    alert(msgUploadFailed);
                                }
                            })
                            .fail(function(xhr) {
                                var msg =
                                    (xhr.responseJSON && xhr.responseJSON.message) ||
                                    (xhr.responseJSON &&
                                        xhr.responseJSON.errors &&
                                        xhr.responseJSON.errors.image &&
                                        xhr.responseJSON.errors.image[0]) ||
                                    msgUploadFailed;
                                if (typeof Swal !== 'undefined') {
                                    Swal.fire({ icon: 'error', title: msg });
                                } else {
                                    alert(msg);
                                }
                            });
                    })(files[i]);
                }
            }

            $(function() {
                var $ta = $('#blog_body');
                if (!$ta.length || typeof $.fn.summernote === 'undefined') {
                    return;
                }

                $ta.wrap('<div class="blog-summernote-wrap"></div>');
                $ta.summernote({
                    height: 360,
                    placeholder: @json(__('Write here… Use the image button or paste a screenshot.')),
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['para', ['ul', 'ol']],
                        ['insert', ['link', 'nbImage']],
                        ['view', ['fullscreen']],
                    ],
                    buttons: {
                        nbImage: function() {
                            var ui = $.summernote.ui;
                            return ui
                                .button({
                                    contents: '<i class="note-icon-picture"></i>',
                                    tooltip: msgInsertImage,
                                    click: function() {
                                        var $inp = $(
                                            '<input type="file" accept="image/*" tabindex="-1" aria-hidden="true">'
                                        )
                                            .css({
                                                position: 'fixed',
                                                left: '-9999px',
                                                top: '0',
                                                opacity: 0,
                                                width: 0,
                                                height: 0,
                                            })
                                            .appendTo('body');
                                        $inp.on('change', function(e) {
                                            var f = e.target && e.target.files;
                                            if (f && f.length) {
                                                uploadBlogBodyImages(f);
                                            }
                                            $inp.remove();
                                        });
                                        $inp.trigger('click');
                                    },
                                })
                                .render();
                        },
                    },
                    callbacks: {
                        onChange: function() {
                            $ta.val($ta.summernote('code'));
                        },
                        onImageUpload: function(files) {
                            uploadBlogBodyImages(files);
                        },
                    },
                });
            });
        })();
    </script>
@endpush
