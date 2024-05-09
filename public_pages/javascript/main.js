/*
    Nav, header, and other elements shared by other JS pages
 */

// transform the mobile drop down menu
function dropMenu() {
    document.querySelector("nav ul").classList.toggle("drop-hamburger");
    document.querySelector(".hamburger #bar1").classList.toggle("rotate-down");
    document.querySelector(".hamburger #bar2").classList.toggle("invisible");
    document.querySelector(".hamburger #bar3").classList.toggle("rotate-up");
}