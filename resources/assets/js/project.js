/**
 * Created by esabbath on 6/16/16.
 */

$(function() {
    if($('div[data-content="project"]').length) {
        $('div.tabs__nav a').on('click', Project.openTab);
        $('#btn-back').on('click', Project.payWindow);
        $('span.pay__close').on('click', function(){$("#pay-popup").hide();});
    }

    //$("div[data-content=projects-list]").on('click', 'ul.pagination a', Listing.paginate);
});

var Project = {
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
        $("#pay-popup").show();
    }
}