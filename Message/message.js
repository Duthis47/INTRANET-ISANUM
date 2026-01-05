

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
    if (!text) return;

    fetch("send_message.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        conversation_id: new URLSearchParams(location.search).get("conv"),
        message: text
      })
    }).then(() => {
      const div = document.createElement("div");
      div.className = "message sent";
      div.textContent = text;
      chatMessages.appendChild(div);
      messageInput.value = "";
    });
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