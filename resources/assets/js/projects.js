/**
 * Created by esabbath on 6/1/16.
 */
$(function() {
    $('li.campaigns-category__item a').on('click', Listing.categoryFilter);
    $('div.campaigns__wrap a').on('click', Listing.sortFilter);

    if($('div[data-ref="projects"]').length) {
        Listing.setRefToProjects();
    }

    $("div[data-content=projects-list]").on('click', 'ul.pagination a', Listing.paginate);
});


Listing = {
    _uri: '/projects/list',
    _ref: 'home',
    _categoryId: 0,
    _sort: '',
    categoryFilter: function(e)
    {
        e.preventDefault();
        var $el = $(this);

        Listing._removeAllActiveLinks();
        $el.addClass('campaigns-category__item--active');
        Listing._filter({category_id: $el.data('id')});

        Listing._categoryId = $el.data('id');
    },
    sortFilter: function(e)
    {
        e.preventDefault();
        var $el = $(this);
        var data = {sort: $el.data('value')};

        Listing._sort = $el.data('value');

        /*on projects listing page do sort inside category*/
        if ('projects' == Listing._ref && Listing._categoryId) {
            data.category_id = Listing._categoryId;
            Listing._removeFilterActiveLinks();
        }
        else {
            Listing._removeAllActiveLinks();
        }

        $el.addClass('campaigns__filtre-item--active');
        Listing._filter(data);
    },
    paginate: function(e)
    {
        e.preventDefault();
        var $el = $(this);
        var pageParts = $el.prop('search').split('='), page = 0;
        if ('?page' == pageParts[0]) {
            page = pageParts[1];
        }
        var data = {
            page: page
        };
        if (Listing._categoryId) {
            data.category_id = Listing._categoryId;
        }
        if (Listing._sort) {
            data.sort = Listing._sort;
        }
        Listing._filter(data);
    },
    _filter: function(data)
    {
        data.ref = Listing._ref;
        $.get(Listing._uri, data, Listing._display, 'json');
    },
    _display: function(data)
    {
        //console.log(data);
        if (data && data.html) {
            $('div[data-content=projects-list]').html(data.html);
        }
    },
    _removeAllActiveLinks: function()
    {
        $('a.campaigns-category__item--active').removeClass('campaigns-category__item--active');
        $('a.campaigns__filtre-item--active').removeClass('campaigns__filtre-item--active');
    },
    _removeFilterActiveLinks: function()
    {
        $('a.campaigns__filtre-item--active').removeClass('campaigns__filtre-item--active');
    },
    setRefToProjects: function()
    {
        Listing._ref = 'projects';
    }
}