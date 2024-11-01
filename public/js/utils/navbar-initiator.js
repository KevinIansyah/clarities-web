window.addEventListener("scroll", function () {
    const navbar = document.querySelector(".navbar");
    const dropdownMenu = document.querySelectorAll(".navbar .dropdown-menu");
    const dropdownItem = document.querySelectorAll(".navbar .dropdown-item");
    if (window.scrollY > 0) {
        navbar.classList.add("shadow", "scrolled");
        dropdownMenu.forEach((link) => link.classList.add("scrolled"));
        dropdownItem.forEach((link) => link.classList.add("scrolled"));
    } else {
        navbar.classList.remove("shadow", "scrolled");
        dropdownMenu.forEach((link) => link.classList.remove("scrolled"));
        dropdownItem.forEach((link) => link.classList.remove("scrolled"));
    }
});
