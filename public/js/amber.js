// Oh hello, too much tuna
jQuery(function($) {
    if(!window.amber_alert) return;

    var text = $('#amber-alert-template').html();

    for(var key in window.amber_alert) {
        text = text.replace('{{' + key + '}}', window.amber_alert[key], 'g');
    }

    $('body').prepend(text);
});