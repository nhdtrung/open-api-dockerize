require(['jquery'],function () {
    jQuery(document).ready(function () {
        setInterval(fetchPrice, 3000);
    });
});

function fetchPrice()
{
    let apiUrl = jQuery("#api-url").text();
    jQuery.ajax({
        url: apiUrl,
        success: function (data) {
            let items = jQuery.parseJSON(data)['bpi'];
            jQuery.each(items, function (item, value) {
                jQuery("." + item + '-val').text(value['rate']);
            });
        }
    });
}
