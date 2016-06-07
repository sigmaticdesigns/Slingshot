/**
 * Created by esabbath on 5/23/16.
 */
$(function() {
    $(document).on('submit', 'form', function (e) {
        var $form = $(this);

        /*login and register is working with redirect*/
        if ($form.data('no-ajax')) {
            return true;
        }

        /* Check if form is already validated return true */
        if ($form.data('validated')) {
            return true;
        }

        /* Remove all errors */
        var removeAllErrors = function() {
            $('.fields-group__field--invalid', $form).removeClass('fields-group__field--invalid');
            //$('.text-danger', $form).remove();
            //$('.bad', $form).removeClass('bad').addClass('not-bad');
            $('label[for]').hide();
        }

        /* Set request */
        $.ajax({
            url: $form.attr("action"),
            type: $form.attr("method"),
            data: new FormData(this),
            //data: $form.serialize(),
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
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

                        if ($field.length >= 1)
                        {
                            var $label = $('label[for=' + key + "]");
                            $label.html(value[0]);
                            $label.show();
                            $field.addClass('fields-group__field--invalid');
                            //$field.after($('<span />').html(value[0]).addClass('text-danger')).siblings('.not-bad').removeClass('not-bad').addClass('bad');
                            //$field.closest('div').addClass('has-error');
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

    if ($('div[data-content="project-form"]').length) {
        initProjectForm();
    }
});


function initProjectForm()
{
    //data pickers
    $('input[name=deadline]').pickmeup();
    $('input[name=half_deadline]').pickmeup();

    var maxCount = 135;

    $(".fields-group__counter").html(maxCount);

    $("#description").keyup(function() {
        var shortDesc = this.value.length;

        if (this.value.length > maxCount) {
            this.value = this.value.substr(0, maxCount);
        }
        var cnt = (maxCount - shortDesc);
        if(cnt <= 0){$(".fields-group__counter").html('0');}
        else {$(".fields-group__counter").html(cnt);}
    });

    CKEDITOR.replace("wysiwyg", {
        'filebrowserImageUploadUrl':'/vendor/ckeditor/kcfinder/upload.php?type=images',
        'filebrowserFlashUploadUrl':'/vendor/ckeditor/kcfinder/upload.php?type=flash'
    });
}