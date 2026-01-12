document.addEventListener("DOMContentLoaded", () => {
  const searchInput = document.getElementById("searchInputMobile");
  const questions = document.querySelectorAll(".list-group a strong");

  searchInput.addEventListener("input", function () {
    const query = this.value.toLowerCase();
    questions.forEach(q => {
      const text = q.textContent.toLowerCase();
      const item = q.closest("a");
      item.style.display = text.includes(query) ? "" : "none";
    });
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const searchInput = document.getElementById("searchInput");
  const questions = document.querySelectorAll(".list-group-item strong");

  searchInput.addEventListener("input", function () {
    const query = this.value.toLowerCase();
    questions.forEach(q => {
      const text = q.textContent.toLowerCase();
      const item = q.closest("a");
      item.style.display = text.includes(query) ? "" : "none";
    });
  });
});
