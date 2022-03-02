$(document).ready(function () {

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: request_url,
        columns: request_fields
    });

    $('#testing_id').on('submit', function (e) {
        e.preventDefault();
        validationFunction($('#testing_id'));
    });


    function validationFunction(form) {
        var isValid = true;
        var inputs = form.find('[validate]');
        $(inputs).removeClass('is-invalid');
        $.each($(inputs), function (i, v) {
            var currentInputValue = $.trim(v.value);

            if (currentInputValue == null || currentInputValue == "") {
                isValid = false;
                $(v).addClass('is-invalid');

                let error_message = 'This field is required.';
                let field_error_message = $(v).data('required-error');

                setErrorMessageOnField(v, error_message, field_error_message);
            }

            if (v.type == 'tel') {
                if (currentInputValue.length > 0) {
                    let phoneno = /^\d{10}$/;
                    phoneno = /^[\+]?[(]?[0-9]{4}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{3,6}$/im;
                    // phoneno = [0-9]{0,14}$;
                    // https://stackoverflow.com/questions/2113908/what-regular-expression-will-match-valid-international-phone-numbers
                    if (!(currentInputValue.match(phoneno))) {
                        $(v).addClass('is-invalid');
                        let error_message = 'Please enter valid Phone Number';
                        let field_error_message = $(v).data('valid-number-error');
                        setErrorMessageOnField(v, error_message, field_error_message);
                        isValid = false;
                    }
                }
            }

            if (v.type == 'email') {
                if (currentInputValue.length > 0) {
                    var is_email_return = true;
                    if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(currentInputValue)) {
                        isValid = false;
                        $(v).addClass('is-invalid');
                        let error_message = 'Please enter valid email';
                        let field_error_message = $(v).data('valid-email-error');
                        setErrorMessageOnField(v, error_message, field_error_message);
                    }
                }
            }

        });

        return isValid;
    }

    function setErrorMessageOnField(v, error_message, field_error_message) {
        if (field_error_message != undefined && field_error_message != '') {
            error_message = field_error_message;
        }
        $(v).siblings('.invalid-feedback').html(error_message);
    }

    $(document).on('click', '.submit-btn', function (e) {
        e.preventDefault();
        var form_obj = $(this).closest('form');
        var form_url = form_obj.attr('action');
        var form_method = form_obj.attr('method');
        var form_field = form_obj.serializeArray();
        var isValid = validationFunction(form_obj);

        if (isValid) {
            $.ajax({
                url: form_url,
                method: form_method,
                // data: form_field,
                data: new FormData(form_obj[0]), // I used for getting other file input data
                processData: false,
                contentType: false,
                success: function (res) {
                    $('.alert.alert-success').html(res.message).show();
                    // $('.modal-close-btn').closest('form').find('[validate]').removeClass('is-invalid').val('');
                    // $('.modal-close-btn').closest('form').find('input:not([name=_token])').removeClass('is-invalid').val('');
                    removeClassAndSetValueEmpty($('.modal-close-btn').closest('form'));
                    $('.modal-close-btn').closest('.modal').trigger('click');

                    table.ajax.reload();
                },
                error: function (err) {
                    if (err.responseJSON != undefined && err.responseJSON != '') {
                        var errors = err.responseJSON.errors;

                        $.each(errors, (i, v) => {
                            $('[name=' + i + ']').addClass('is-invalid');
                            setErrorMessageOnField($('[name=' + i + ']'), '', v[0]);
                        });
                    }
                    if (err.responseText != undefined && err.responseText != '') {
                        var texterrors = jQuery.parseJSON(err.responseText).errors;
                        for (let x in texterrors) {
                            $('[name=' + x + ']').addClass('is-invalid');
                            setErrorMessageOnField($('[name=' + x + ']'), '', texterrors[x]);
                        }

                    }
                },
            });
        }
    });

    $(document).on('click', '.edit-modal', function (e) {
        e.preventDefault();
        // $($(this).data('target')).find('input:not([name=_token])').removeClass('is-invalid').val('');
        removeClassAndSetValueEmpty($($(this).data('target')));
        $.ajax({
            url: $(this).data('url'),
            success: function (res) {
                if (res != null && res != '') {
                    for (let x in res) {
                        $('[name=' + x + ']').val(res[x]);
                    }
                }
            },
            error: function (err) {
                var errors = err.responseJSON.errors;

                $.each(errors, (i, v) => {
                    $('[name=' + i + ']').addClass('is-invalid');
                    setErrorMessageOnField($('[name=' + i + ']'), '', v[0]);
                });
            },
        });
    });

    $(document).on('click', '.modal-close-btn', function (e) {
        e.preventDefault();
        // $(this).closest('form').find('[validate]').removeClass('is-invalid').val('');
        // $(this).closest('form').find('input:not([name=_token])').removeClass('is-invalid').val('');
        removeClassAndSetValueEmpty($(this).closest('form'));
    });

    $(document).on('click', '.modal-open-btn', function (e) {
        e.preventDefault();
        // $($(this).data('target')).find('input:not([name=_token])').removeClass('is-invalid').val('');
        removeClassAndSetValueEmpty($($(this).data('target')));
    });

    function removeClassAndSetValueEmpty(form_obj) {
        form_obj.find('input:not([name=_token])').removeClass('is-invalid').val('');
    }

    $(document).on('click', '.delete-modal', function (e) {
        e.preventDefault();
        var url = $(this).data('url');
        $('#delete-btn').removeAttr('data-url');
        $('#delete-btn').attr('data-url', url);
    });

    $(document).on('click', '#delete-btn', function (e) {
        e.preventDefault();

        var delete_url = $('#delete-btn').attr('data-url');

        if (delete_url != '' && delete_url != undefined) {
            setCsrfToken();
            $.ajax({
                url: delete_url,
                method: 'delete',
                success: function (res) {
                    $('.modal-close-btn').closest('.modal').trigger('click');
                    $('.alert.alert-success').html(res.message).show();
                    table.ajax.reload();
                },
                error: function (err) {
                    console.log('err', err);
                },
            });
        }
    });

    function setCsrfToken() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    $(document).on('change', '#filter_select', function (e) {
        e.preventDefault();
        var newUrl  = request_url + '?' + jQuery.param(table.ajax.params());

        table.destroy();
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: newUrl,
            data: data,
            columns: request_fields
        });
    });

    $(document).on('click', '.redirect-related-page', function (e) {
        e.preventDefault();
        window.location.href = $(this).attr('data-url');
    });
});
