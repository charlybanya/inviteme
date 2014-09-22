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