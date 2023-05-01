/*
    Nav, header, and other elements shared by other JS pages
 */

// Scroll changes for the Navbar
function shrinkNav() {
    if (window.scrollY > 0) {
        // nav settings
        document.querySelector("nav.transforming").style.height = "13vh";
        // nav image settings
        document.querySelector("nav.transforming img").style.height = "10vh";
        document.querySelector("nav.transforming img").style.bottom = "3vh";
        // header padding
        document.querySelector("header").style.marginTop = "20vh";
    } else {
        // nav settings
        document.querySelector("nav.transforming").style.height = "61vh";
        // nav image settings
        document.querySelector("nav.transforming img").style.height = "45vh";
        document.querySelector("nav.transforming img").style.bottom = "";
        // header padding
        document.querySelector("header").style.marginTop = "10vh";
    }
}

// event handler
window.onscroll = () => {
    if (screen.width > 900) {
        shrinkNav();
    }
}
// transform the mobile drop down menu
function dropMenu() {
    document.querySelector("nav ul").classList.toggle("drop-hamburger");
    document.querySelector(".hamburger #bar1").classList.toggle("rotate-down");
    document.querySelector(".hamburger #bar2").classList.toggle("invisible");
    document.querySelector(".hamburger #bar3").classList.toggle("rotate-up");
}