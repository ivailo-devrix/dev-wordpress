jQuery(document).ready(function ($) { //wrapper
    $("select").on('change', function (e) {
        const currentElem = $(e.currentTarget);
        const elemValue = currentElem.val();
        let active = false;

        if ('active' === elemValue) {
            active = true;
        }

        $.ajax({
            url: my_ajax_obj.ajax_url, method: 'POST', data: {
                'action': 'my_tag_count',
                'nonce': my_ajax_obj.nonce,
                'active': active,
                'options-name': $(this).data("custom"),
            }
        }).success((response) => {
            console.log(response);
        });
    });

    $(".active-js-input").on('change', function (e) {
        const currentElem = $(this);
        let active = false;

        if (currentElem.is(":checked"))
        {
            active = true;
        }

        $.ajax({
            url: my_ajax_obj.ajax_url, method: 'POST', data: {
                'action': 'save_ajax_status',
                'nonce': my_ajax_obj.nonce,
                'active': active,
                'post-id': currentElem.data("post-id"),
            }
        }).success((response) => {
            console.log(response);
        });
    });


    $('.my-submit').click(function(e){
        e.preventDefault();
        jQuery.ajax({
            url: my_ajax_obj.ajax_url, method: 'POST', data: {
                'action' : 'search_oxford_dictionary',
                'query' : $('.oxford-search').val(),
                'sec' : $('.temp-time').val(),
            },
            success: function(result){ $('.result-html').html(result) }
        });
    });

});

