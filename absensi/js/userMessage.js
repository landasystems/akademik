$(document).ready(function() {

    function calcMessage(str) {
        var msg;
        msg = Math.ceil(str.length / 160);
        return "<b>" + str.length + "</b> Character, <b>" + msg + "</b> Message";
    }

    $("#message").bind('keyup change', function() {
        $("#infoMess").html(calcMessage($(this).val()));
    });


})