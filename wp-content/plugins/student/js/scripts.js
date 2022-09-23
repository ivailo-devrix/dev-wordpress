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
});


