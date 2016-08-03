/**
 * Created by esabbath on 5/10/16.
 */

if ($('[data-content="projects"]').length)
{
    (function ()
    {
        $(document).on('click', '[data-action="set-status"]', function ()
        {
            var $this = $(this).closest('tr'), id = $this.data('id');
            var status = $(this).data('status');
            var statusTd = $(this).closest('tr').find('td[data-type=status]');

            $.post('/project/set-status', {id: id, status: status}, function (response)
            {
                if (!$.isEmptyObject(response) && typeof response.result != 'undefined' && response.result)
                {
                    if (response.status) {
                        $this.find(".ban").hide();
                        $this.find(".unban").hide();
                        statusTd.html(response.status);
                    }
                }
            }, 'json');
        });

        $('input[data-content=promo]').on('ifChecked', function(event){
            setProjectPromo($(this), 1);
        });
        $('input[data-content=promo]').on('ifUnchecked', function(event){
            setProjectPromo($(this), 0);
        });
        function setProjectPromo($ptr, status)
        {
            var $this = $ptr.closest('tr'), id = $this.data('id');
            $.post('/project/set-promo', {id: id, status: status});
        }
    })();
}

if ($('[data-content="users"]').length)
{
    (function ()
    {
        $(document).on('click', '[data-action="set-status"]', function ()
        {
            var $this = $(this).closest('tr'), id = $this.data('id');
            var status = $(this).data('status');
            var statusTd = $(this).closest('tr').find('td[data-type=status]');

            $.post('/user/set-status', {id: id, status: status}, function (response)
            {
                if (!$.isEmptyObject(response) && typeof response.result != 'undefined' && response.result)
                {
                    if ('banned' == response.status) {
                        $this.find(".ban").hide();
                        $this.find(".unban").show();
                    }
                    if ('active' == response.status) {
                        $this.find(".ban").show();
                        $this.find(".unban").hide();
                    }
                }
            }, 'json');
        });
    })();
}
