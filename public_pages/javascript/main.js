/*
    Nav, header, and other elements shared by other JS pages
 */

// Scroll changes for the Navbar
function shrinkNav() {
    if (window.scrollY > 0) {
        // nav settings
        document.querySelector("nav").style.height = "13vh";
        // nav image settings
        document.querySelector("nav img").style.height = "10vh";
        document.querySelector("nav img").style.bottom = "3vh";
    } else {
        // nav settings
        document.querySelector("nav").style.height = "61vh";
        // nav image settings
        document.querySelector("nav img").style.height = "45vh";
        document.querySelector("nav img").style.bottom = "0";

    }
}

window.onscroll = () => {
    shrinkNav();
}