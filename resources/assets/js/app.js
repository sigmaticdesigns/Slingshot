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
            $('div.fields-group__error label[for]').hide();
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

                //console.log('app.js');
                //console.log(response);
                if (!$.isEmptyObject(response))
                {
                    if (typeof response.message != 'undefined' && response.message) {
                        toastr["success"](response.message);
                    }
                    if (typeof response['error.message'] != 'undefined' && response['error.message']) {
                        toastr["error"](response['error.message']);
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
                if (401 == jqXhr.status) {
                    window.location = '/auth/login';
                    return;
                }
                removeAllErrors();
                $("#loading-msg").hide();

                if (!$.isEmptyObject(jqXhr.responseJSON))
                {
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
    if ($('input[name=avatar]').length) {
        initImageUploadForm('avatar', 258, 258, 'Your Profile Picture');
    }

    $('a#confirm-email').on('click', sendEmailConfirmLink);

    if ($('div.faq__title').length) {
        staticPage();
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

    initImageUploadForm('file', 256, 187, 'Your project picture');

    CKEDITOR.replace("wysiwyg", {
        'filebrowserImageUploadUrl':'/vendor/ckeditor/kcfinder/upload.php?type=images',
        'filebrowserFlashUploadUrl':'/vendor/ckeditor/kcfinder/upload.php?type=flash'
    });
}

function initImageUploadForm(fileFieldId, imgWidth, imgHeight, alt)
{
    var uploadBtn = document.getElementById(fileFieldId);
    var imgBox = document.querySelector(".fields-group__img-box");
    var imgClose = document.querySelector(".fields-group__img-close");
    var imgToUpload;

    function elemCreate(elType){
        var element = document.createElement(elType);
        if (arguments.length>1){
            var props = [].slice.call(arguments,1), key = props.shift();
            while (key){
                element.setAttribute(key,props.shift());
                key = props.shift();
            }
        }
        return element;
    }

    uploadBtn.addEventListener("change", function(){
        imgBox.style.display = "block";
        if (document.body.contains(imgToUpload)) {
            imgBox.removeChild(imgToUpload);
        }

        imgToUpload = elemCreate("img",
            "width", imgWidth,
            "height", imgHeight,
            "alt", alt);
        imgToUpload.src = window.URL.createObjectURL(this.files[0]);
        imgToUpload.height = imgHeight;
        imgBox.appendChild(imgToUpload);
    });

    imgClose.addEventListener("click", function() {
        imgBox.style.display = "none";
        imgBox.removeChild(imgToUpload);
    });

}

function sendEmailConfirmLink(e)
{
    e.preventDefault();
    $(this).hide();
    $.get('/user/settings/confirm-email', {}, function (r) {
        if (r.success && r.message) {
            toastr["success"](r.message);
        }
    }, 'json');
}

function staticPage()
{
    $('div.faq__title').on('click', function(){
        var $answer = $(this).next('div.faq__answer');
        $answer.toggle('fast');
    });

    $('li.how-to__item').on('click', function(){
        $('img.how-to__img').hide();
        var actImgId = $(this).data('id');
        $('img.how-to__img[data-value="' + actImgId + '"]').show();
    });
}