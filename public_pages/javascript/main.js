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
    } else {
        // nav settings
        document.querySelector("nav.transforming").style.height = "61vh";
        // nav image settings
        document.querySelector("nav.transforming img").style.height = "45vh";
        document.querySelector("nav.transforming img").style.bottom = "";

    }
}

window.onscroll = () => {
    shrinkNav();
}