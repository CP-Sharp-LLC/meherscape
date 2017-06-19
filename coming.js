/* global jQuery */
var validateButton;
var $ = jQuery;
$(document).ready(function() {
    validateButton = $(".validation");
});

function validate() {
    validateButton.fadeOut(80).removeClass("success");
    var store = $('input[type="text"]').val();
    if (store == "" || store == undefined) {
        validateButton.html("Please enter your e-mail").slideDown(800);
    }
    else {
        validateButton.html("Thanks! You'll hear back from us shortly.").addClass("success").slideDown(400);
        $.post('sendmail.php', { email: store});
    }
}
