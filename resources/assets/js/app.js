/**
 * Created by esabbath on 5/23/16.
 */
$(function() {
    $(document).on('submit', 'form', function (e) {
        var $form = $(this);

        /* Check if form is already validated return true */
        if ($form.data('validated')) {
            return true;
        }

        /* Remove all errors */
        var removeAllErrors = function() {
            $('.has-error', $form).removeClass('has-error');
            $('.text-danger', $form).remove();
            $('.bad', $form).removeClass('bad').addClass('not-bad');
        }

        /* Set request */
        $.ajax({
            url: $form.attr("action"),
            type: $form.attr("method"),
            data: $form.serialize(),
            dataType: "json",
            success: function (response) {
                removeAllErrors();

                if (!$.isEmptyObject(response)) {
                    if (typeof response.message != 'undefined' && response.message) {
                        toastr["success"](response.message);
                    }

                    if (typeof response.redirect != 'undefined' && response.redirect) {
                        window.location = response.redirect;
                    }

                    if ($form.data('callback'))
                    {
                        window[$form.data('callback')](response);
                    }
                }
            },
            error: function (jqXhr, json, errorThrown)
            {
                removeAllErrors();
                $("#loading-msg").hide();

                if (!$.isEmptyObject(jqXhr.responseJSON)) {
                    var errorMessages = [],
                        errorMessage = '<strong>Whoops!</strong> There were some problems with your input.<br>';

                    /* Parse each error */
                    $.each(jqXhr.responseJSON, function (key, value)
                    {
                        var $field = $('[name="' + key + '"]', $form);

                        if ($field.length >= 1) {
                            $field.after($('<span />').html(value[0]).addClass('text-danger')).siblings('.not-bad').removeClass('not-bad').addClass('bad');
                            $field.closest('div').addClass('has-error');
                        }
                        //else {
                            errorMessages.push(value[0]);
                        //}
                    });

                    if (errorMessages.length >= 1) {
                        toastr["error"](errorMessage + errorMessages.join('<br />'));
                    }
                }
            }
        });

        e.preventDefault();
    });
});
