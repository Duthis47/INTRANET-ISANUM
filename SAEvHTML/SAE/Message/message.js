

const barBands = document.querySelectorAll('.list-group-item');


function LightBandMessage() {
  barBands.forEach(element => {
    element.addEventListener("click", () => {
      barBands.forEach(b => b.classList.remove("active"));
      element.classList.add("active");
    });
  });
}


LightBandMessage();


// A REVOIR
function initChat() {
  const sendBtn = document.getElementById("sendBtn");
  const messageInput = document.getElementById("messageInput");
  const chatMessages = document.querySelector(".chat-messages");

  function sendMessage() {
    const text = messageInput.value.trim();
    if (text === "") return;

    // Crée un élément message
    const msgDiv = document.createElement("div");
    msgDiv.classList.add("message", "sent");
    msgDiv.textContent = text;

    // Ajoute le message à la zone de chat
    chatMessages.appendChild(msgDiv);
    chatMessages.scrollTop = chatMessages.scrollHeight;

    // Réinitialise le champ
    messageInput.value = "";
  }

  // Click sur le bouton d’envoi
  sendBtn.addEventListener("click", sendMessage);

  // Touche "Entrée"
  messageInput.addEventListener("keypress", (e) => {
    if (e.key === "Enter") {
      e.preventDefault();
      sendMessage();
    }
  });
}


document.addEventListener("DOMContentLoaded", () => {
  LightBandMessage();
  initChat();
});