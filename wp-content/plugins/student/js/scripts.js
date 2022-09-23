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


jQuery(document).ready(function ($) { //wrapper
    $(".active-js-input").on('change', function (e) {
        const currentElem = $(this);
        //const elemValue = checked.val();
        let active = false;

        if ($(this).is(":checked"))
        {
            active = true;
        }

        console.log(active);
        //console.log(elemValue);
        //console.log($(this).data("post-id"));
        //console.log($("input['checked']").val());

        $.ajax({
            url: my_ajax_obj.ajax_url, method: 'POST', data: {
                'action': 'save_ajax_status',
                'nonce': my_ajax_obj.nonce,
                'active': active,
                'post-id': $(this).data("post-id"),
            }
        }).success((response) => {
            console.log(response);
        });
    });
});
