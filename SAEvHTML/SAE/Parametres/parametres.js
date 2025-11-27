  document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.querySelector('[data-bs-target="#offcanvasAside"]');
    const offcanvasEl = document.getElementById("offcanvasAside");

    if (toggleBtn && offcanvasEl) {
      // Quand le menu s'ouvre → cacher le bouton
      offcanvasEl.addEventListener("show.bs.offcanvas", () => {
        toggleBtn.style.display = "none";
      });

      // Quand le menu se ferme → réafficher le bouton
      offcanvasEl.addEventListener("hidden.bs.offcanvas", () => {
        toggleBtn.style.display = "block";
      });
    }
  });