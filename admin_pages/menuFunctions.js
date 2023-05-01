/*
    Functions for the nav menu
*/

// transform the mobile drop down menu
function dropMenu() {
    // show/hide pieces of the nav
    document.querySelector("nav").classList.toggle("slide-menu");
    document.querySelector("nav p.login-title").classList.toggle("show-title");
    document.querySelector("nav ul").classList.toggle("show-links");
    // animate the hamburger
    document.querySelector(".hamburger #bar1").classList.toggle("rotate-down");
    document.querySelector(".hamburger #bar2").classList.toggle("invisible");
    document.querySelector(".hamburger #bar3").classList.toggle("rotate-up");
}