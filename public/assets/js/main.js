(function () {
  /* ========= sidebar toggle ======== */
  const sidebarNavWrapper = document.querySelector(".sidebar-nav-wrapper");
  const mainWrapper = document.querySelector(".main-wrapper");
  const menuToggleButton = document.querySelector("#menu-toggle");
  const menuToggleButtonIcon = document.querySelector("#menu-toggle i");
  const overlay = document.querySelector(".overlay");

  menuToggleButton.addEventListener("click", () => {
    sidebarNavWrapper.classList.toggle("active");
    overlay.classList.add("active");
    mainWrapper.classList.toggle("active");

    if (document.body.clientWidth > 1200) {
      if (menuToggleButtonIcon.classList.contains("lni-chevron-left")) {
        menuToggleButtonIcon.classList.remove("lni-chevron-left");
        menuToggleButtonIcon.classList.add("lni-menu");
      } else {
        menuToggleButtonIcon.classList.remove("lni-menu");
        menuToggleButtonIcon.classList.add("lni-chevron-left");
      }
    } else {
      if (menuToggleButtonIcon.classList.contains("lni-chevron-left")) {
        menuToggleButtonIcon.classList.remove("lni-chevron-left");
        menuToggleButtonIcon.classList.add("lni-menu");
      }
    }
  });
  overlay.addEventListener("click", () => {
    sidebarNavWrapper.classList.remove("active");
    overlay.classList.remove("active");
    mainWrapper.classList.remove("active");
  });

  // ========== theme switcher ==========
  const optionButton = document.querySelector(".option-btn");
  const optionButtonClose = document.querySelector(".option-btn-close");
  const optionBox = document.querySelector(".option-box");
  const optionOverlay = document.querySelector(".option-overlay");

  optionButton.addEventListener("click", () => {
    optionBox.classList.add("show");
    optionOverlay.classList.add("show");
  });
  optionButtonClose.addEventListener("click", () => {
    optionBox.classList.remove("show");
    optionOverlay.classList.remove("show");
  });
  optionOverlay.addEventListener("click", () => {
    optionOverlay.classList.remove("show");
    optionBox.classList.remove("show");
  });

  // =========== theme change
  const lightThemeButton = document.querySelector(".lightThemeButton");
  const darkThemeButton = document.querySelector(".darkThemeButton");
  const logo = document.querySelector(".navbar-logo img");

  darkThemeButton.addEventListener("click", () => {
    document.body.classList.add("darkTheme");
    sidebarNavWrapper.classList.remove("style-2");
    darkThemeButton.classList.add("active");
    lightThemeButton.classList.remove("active");
    logo.src = "assets/images/logo/logo-white.svg";
  });

  lightThemeButton.addEventListener("click", () => {
    document.body.classList.remove("darkTheme");
    sidebarNavWrapper.classList.remove("style-2");
    lightThemeButton.classList.add("active");
    darkThemeButton.classList.remove("active");
    logo.src = "assets/images/logo/logo.svg";
  });
  

  // Enabling bootstrap tooltips
  const tooltipTriggerList = document.querySelectorAll(
    '[data-bs-toggle="tooltip"]'
  );
  const tooltipList = [...tooltipTriggerList].map(
    (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
  );
})();
