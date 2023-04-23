/*
    Nav, header, and other elements shared by other JS pages
 */

// Scroll changes for the Navbar
function shrinkNav() {
    if (window.scrollY > 100) {
        console.log(">100");
    } else {
        console.log("<100");
    }
}

window.onscroll = () => {
    shrinkNav();
}