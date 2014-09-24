$(document).ready(function() {
    $('#Form').ajaxForm({
        dataType: 'json',
        success: processJson
    });
});

function processJson(data) {
    alert(data.message);
    if (typeof data.nextStep !== 'undefined') {
        window.location.href = data.nextStep;
    }
}

$(function() {

    $('a.fbLogin').click(function(e) {

        e.preventDefault();

        parent.$.colorbox({
            iframe: true,
            width: 720,
            height: 480,
            href: $(this).attr('href')

        });

    });
});