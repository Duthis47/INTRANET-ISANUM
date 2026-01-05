document.addEventListener("DOMContentLoaded", () => {
  const searchInput = document.getElementById("searchInput");
  const questions = document.querySelectorAll("#questionList p");

  searchInput.addEventListener("input", function () {
    const query = this.value.toLowerCase();
    questions.forEach(q => {
      const text = q.textContent.toLowerCase();
      q.parentElement.style.display = text.includes(query) ? "" : "none";
    });
  });
});