import './bootstrap';
import '../sass/app.scss'


let prevScrollpos = window.pageYOffset;
window.onscroll = function () {
    let currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
        document.getElementById("navbar").style.top = "0";
    } else {
        document.getElementById("navbar").style.top = "-90px";
    }
    prevScrollpos = currentScrollPos;
}

setTimeout(function () {
    $(".alert").fadeTo(2000, 0).slideUp(2000, function () {
        $(this).remove();
    });
}, 10000);
