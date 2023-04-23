/*
    Nav, header, and other elements shared by other JS pages
 */

// Scroll changes for the Navbar
function shrinkNav() {
    if (window.scrollY > 100) {
        document.querySelector("nav").style.height = "13vh";
        document.querySelector("nav").style.backgroundColor = "#0e402d";
        document.querySelector("nav img").style.height = "10vh";
        document.querySelector("nav img").style.bottom = "3vh";
    } else {
        document.querySelector("nav").style.height = "61vh";
        document.querySelector("nav img").style.height = "45vh";
        document.querySelector("nav img").style.bottom = "0";
        document.querySelector("nav").style.backgroundColor = "#0e402dcb";
    }
}

window.onscroll = () => {
    shrinkNav();
}