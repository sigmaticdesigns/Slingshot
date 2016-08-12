/**
 * Created by esabbath on 6/16/16.
 */

$(function() {
    if($('div[data-content="project"]').length)
    {
        $('div.tabs__nav a').on('click', Project.openTab);
        $('a[data-action="back-project"]').on('click', Project.payWindow);
        $('span.pay__close').on('click', function(){$("#pay-popup").hide();});

        window.commentResponse = function(response) {
            Comment.post(response);
        }

        Project.stripeInit();
        $('a[data-action="pay"]').on('click', Project.stripeForm);
    }

    //$("div[data-content=projects-list]").on('click', 'ul.pagination a', Listing.paginate);
});

var Project =
{
    _handler: null,
    openTab: function(e)
    {
        e.preventDefault();
        var $aEl = $(this),
            content = $aEl.data('value');

        $('a.tabs__nav-item--active').removeClass('tabs__nav-item--active');
        $aEl.addClass('tabs__nav-item--active');

        $('div.tab').hide();
        $('div[data-content=' + content + ']').show();
    },
    payWindow: function(e)
    {
        e.preventDefault();
        Project.checkAuth();
        $("#pay-popup").show();
    },
    checkAuth: function()
    {
        //$.get('/project/back', {}, function(r){
        //    console.log(r);
        //});
        $.ajax({
            url: '/project/back',
            type: 'get',
            cache: false,
            success: function (response) {
                //console.log('checkAuth');
                //console.log(response);
            },
            error: function (jqXhr, json, errorThrown)
            {
                if (401 == jqXhr.status) {
                    window.location = '/auth/login?redirect_to=' + window.location;
                    return;
                }
            }
        });
    },
    stripeInit: function()
    {
        Project._handler = StripeCheckout.configure({
            key: stripeDataKey,
            //image: '/packages/pingpong/admin/adminlte/img/user-bg.png',
            locale: 'auto',
            name: 'SlingShot Founding',
            email: userEmail,
            token: function (token) {
                // Use the token to create the charge with a server-side script.
                // You can access the token ID with `token.id`
                $("#stripeToken").val(token.id);
                //console.log(token);
                $("#payment-form").submit();
            }
        });

        // Close Checkout on page navigation
        $(window).on('popstate', function () {
            Project._handler.close();
        });
    },
    stripeForm: function(e)
    {
        $("#pay-popup").hide();

        var amount = parseFloat($('#summ').val())*100,
            description = 'Back the project: ' + $('h1.project-card__title').text();
        // Open Checkout with further options
        Project._handler.open({
            description: description,
            amount: amount
        });
    },
    updatePurse: function(response)
    {
        if (response.progress) {
            $('div.campaign-card__bar-scale').width(response.progress);
        }
    }
}

var Comment = {
    post: function(response)
    {
        //console.log(response);
        if (response.html) {
            $('div[data-content="cooments"]').prepend(response.html);
            $('textarea#comment').val('');
        }

    }
}

function updateProjectPurse(data)
{
    Project.updatePurse(data);
}