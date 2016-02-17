// document ready function
$(document).ready(function () {
    $('.angka').on('keypress', function (evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        // Validasi hanya tombol angka, kecuali titik dan minus
        if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 45 && charCode != 46)
            return false;
        return true;
    });
    $('.angka').on('focus', function () {
        if ($(this).val() == 0) {
            $(this).val("");
        }
    });
    $('.angka').on('blur', function () {
        if ($(this).val() == "") {
            $(this).val(0);
        }
    });

    //prevent font flickering in some browsers 
    (function () {
        //if firefox 3.5+, hide content till load (or 3 seconds) to prevent FOUT
        var d = document, e = d.documentElement, s = d.createElement('style');
        if (e.style.MozTransform === '') { // gecko 1.9.1 inference
            s.textContent = 'body{visibility:hidden}';
            e.firstChild.appendChild(s);
            function f() {
                s.parentNode && s.parentNode.removeChild(s);
            }
            addEventListener('load', f, false);
            setTimeout(f, 3000);
        }
    })();

    //remove loadstate class from body and show the page
    setTimeout('$("html").removeClass("loadstate")', 500);

    //ajax loader
    $("#loader")
            .hide()
            .ajaxStart(function () {
                $(this).show();
            })
            .ajaxStop(function () {
                $(this).hide();
            });

});
