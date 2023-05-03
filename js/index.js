function highlightActiveNavItem() {
  // Get the nav link that was clicked.
  var activeNavLink = event.target;

  // Add the `active` class to the nav link.
  activeNavLink.classList.add("active");
}

// Add an event listener to the nav links to highlight them when they are clicked.
document
  .querySelectorAll("a.nav-link.active")
  .forEach((navLink) =>
    navLink.addEventListener("click", highlightActiveNavItem)
  );
