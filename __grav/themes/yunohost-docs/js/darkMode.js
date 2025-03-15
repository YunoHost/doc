
/**
 * Custom dark mode
 */

// Get user preference
const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)").matches;

// Select the theme preference from localStorage
const currentTheme = localStorage.getItem("theme") ? localStorage.getItem("theme") : null;

// If the current theme in localStorage is "dark" or user prefer dark, apply it
if (currentTheme == "dark" || (currentTheme == null && prefersDarkScheme)) {
    document.body.classList.add("dark-mode");
}
else
{
    document.body.classList.add("light-mode");
}

// Get all elements with switch class
const switches = document.querySelectorAll(".dark-mode-switcher");

// Apply event function to each element
for (var i = 0; i < switches.length; i++) {
    switches[i].addEventListener('click', darkModeSwith);
}

function darkModeSwith(event) {
   
    // Prevent href action
    event.preventDefault();

    // Toggle the .dark-theme class
    document.body.classList.toggle("dark-mode");
    document.body.classList.toggle("light-mode");

    // If the body contains the .dark-theme class...
    // Then save the choice in localStorage
    if (document.body.classList.contains("dark-mode")) {
        localStorage.setItem("theme", "dark");
    } else {
        localStorage.setItem("theme", "light");
    }

    // Close mobile menu
    if (toggle = document.querySelector('#toggle'))
        toggle.classList.remove('active');
    if (overlay = document.querySelector('#overlay'))
        overlay.classList.remove('open');
    document.body.classList.remove('mobile-nav-open');
}