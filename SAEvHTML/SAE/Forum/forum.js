document.addEventListener("DOMContentLoaded", () => {

    const sendBtn = document.getElementById("sendForumBtn");
    const messageInput = document.getElementById("forumMessage");
    const content = document.getElementById("content");
    const inputSection = document.querySelector(".forum-input");

    function createArticle() {
        const text = messageInput.value.trim();
        if (text === "") return;

        // Crée un élément article
        const article = document.createElement("article");

        // Pseudo de l'utilisateur (à remplacer plus tard si besoin)
        const username = "Moi";

        // Date au format français
        const dateStr = new Intl.DateTimeFormat(["fr-FR"], {
            day: "numeric",
            month: "short",
            year: "numeric",
            localeMatcher: "lookup"
        }).format(new Date());

        // Contenu HTML de l'article
        article.innerHTML = `
      <h2>${username}</h2>
      <p>${text}</p>
      <p>le ${dateStr}</p>
    `;

        // Animation d’apparition
        article.classList.add("message-slide");

        // Ajoute l’article avant la section d’entrée
        content.insertBefore(article, inputSection);

        // Vide le champ
        messageInput.value = "";
    }

    // Bouton "Envoyer"
    sendBtn.addEventListener("click", createArticle);

    // Appui sur la touche Entrée
    messageInput.addEventListener("keypress", (e) => {
        if (e.key === "Enter") {
            e.preventDefault();
            createArticle();
        }
    });

});