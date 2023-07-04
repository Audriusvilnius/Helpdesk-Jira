import './bootstrap';
import '../sass/app.scss'
// import '../sass/style.scss'


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

let delay = 0;
let myTimeline = anime.timeline();

let textWrapper0 = document.querySelector('.ml0');

textWrapper0.innerHTML = textWrapper0.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

myTimeline
    .add({
        targets: '.ml0 .letter',
        translateX: [40, 0],
        translateZ: 0,
        opacity: [0, 1],
        easing: "easeOutExpo",
        duration: 300,
        delay: (el, i) => delay + 30 * i
    });

