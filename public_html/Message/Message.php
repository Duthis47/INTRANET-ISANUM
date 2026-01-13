<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();


require '../Connexion/laConnexion.php'; 
require '../Connexion/noSQLConnexion.php';

if (!isset($_SESSION['idU'])) {
    header("Location: http://10.3.17.217:8090/Authentification/login.php");
    exit();
}

$currentUser = $_SESSION['idU']; 

$convId = $_GET['conv'] ?? null;
if (!$convId) {
    $firstConv = $mongoDB->conversations->findOne(
        ['participants' => (int)$currentUser],
        ['sort' => ['updated_at' => -1]]
    );

    if ($firstConv) {
        header("Location: Message.php?conv=".$firstConv['_id']);
        exit;
    }
}

$chatUsername = "Aucune conversation";

if (!empty($convId)) {
    try {
        $convObjectId = new MongoDB\BSON\ObjectId($convId);

        $conversation = $mongoDB->conversations->findOne([
            '_id' => $convObjectId,
            'participants' => (int)$currentUser
        ]);

        if ($conversation) {
            $participants = $conversation['participants']->getArrayCopy();

            $otherUserId = ($participants[0] == $currentUser) 
                ? $participants[1]
                : $participants[0];

            $stmt = $pdo->prepare("SELECT prenomU, nomU FROM Utilisateurs WHERE idU = :UnionId");
            $stmt->bindValue(':UnionId', $otherUserId, PDO::PARAM_INT);
            $stmt->execute();

            if ($u = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $chatUsername = $u['prenomU'].' '.$u['nomU'];
            }
        }

    } catch (Exception $e) {
        // identifiant invalide, le nom par default sera utilisé
    }
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ISA NET - Message</title>

  <!-- Début des imports Boostraps-->
  <link href="./../Style/Bootstrap/assets/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="./../Style/css/sidebars.css" rel="stylesheet" />
  
  <script src="./../Style/Bootstrap/assets/js/color-modes.js"></script>
  <script src="./../Style/Bootstrap/assets/dist/js/bootstrap.bundle.min.js"></script>

  <link href="./../Style/css/style.css" rel="stylesheet">
  <!--Fin des imports bootstraps-->
</head>

<body>

<?php 
    include './../main/header.php';
?>

<script>
    const currentUserId = <?php echo $_SESSION['idU']; ?>;
</script>

  <!--Btn discuss resp -->
  <div class="d-lg-none ms-3 mt-4 mb-4">
    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAside"
      aria-controls="offcanvasAside">
      <i class="bi bi-chevron-left"></i>
    </button>
  </div>

  <main class="d-flex">
    <!--Liste de gauche -->
    <aside class="sidebar d-none d-lg-block border-end" style="width:250px;">

      <div class="p-3 border-bottom">
        <h5>Discussions</h5>
      </div>
      <br>
      <form class="d-flex justify-content-center mb-4" role="search" onsubmit="return false;">
        <div class="input-group" style="max-width: 400px;">
          <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
          <input id="searchInput" class="form-control" type="search" placeholder="Rechercher une question..."
            aria-label="Search">
        </div>
      </form>

      <div class="p-3">
        <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#newConvModal">
            + Nouvelle conversation
        </button>
      </div>

        <div class="list-group list-group-flush">
        <?php
        $convs = $mongoDB->conversations->find(
            ['participants' => $currentUser],
            ['sort' => ['updated_at' => -1]]
        );
        foreach ($convs as $conv){
          $participants = $conv['participants']->getArrayCopy();

          if (!in_array($currentUser, $participants)) {
                continue;
            }

            $otherId = ($participants[0] == $currentUser)
                ? $participants[1]
                : $participants[0];
            $stmt = $pdo->prepare("SELECT nomU, prenomU FROM Utilisateurs WHERE idU = :UnionId");
            $stmt->bindValue(':UnionId', $otherId, PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $username = $user 
              ? $user['prenomU'].' '.$user['nomU'] 
              : 'Utilisateur inconnu';
        ?>
        <a href="Message.php?conv=<?= $conv['_id'] ?>"
        class="list-group-item list-group-item-action <?= ($convId == (string)$conv['_id']) ? 'active' : '' ?>">
            <strong><?= htmlspecialchars($username) ?></strong><br>
            <small><?= htmlspecialchars($conv['last_message']) ?></small>
        </a>
        <?php } ?>
        </div>
    </aside>

    <!-- Zone de mess -->
    <section class="chat-container flex-grow-1">
      <div class="chat-header p-3 border-bottom d-flex align-items-center"
        style="background-color:#2c2f33; color:white;">
        <i class="bi bi-person-circle me-2" style="font-size: 1.5rem;"></i>
        <h5 class="mb-0"><?= htmlspecialchars($chatUsername) ?></h5>
      </div>

    <div class="chat-messages flex-grow-1 p-3" id="chatMessages">
    <?php

if ($convObjectId) {
    // Récupérer les messages dans l'ordre décroissant (plus récent en premier)
    $messages = $mongoDB->messages->find(
        ['conversation_id' => $convObjectId],
        ['sort' => ['created_at' => -1]]
    );

        foreach ($messages as $msg){
    ?>
    <div class="message <?= ((int)$msg['sender'] === (int)$currentUser) ? 'sent' : 'received' ?>">
        <?= htmlspecialchars($msg['message']) ?>
    </div>
    <?php }
  } ?>
    </div>

      <div class="chat-input d-flex">
        <input style="background-color: white;" type="text" class="form-control me-2" placeholder="Écrire un message..."
          id="messageInput" />
        <button id="sendBtn" class="btn btn-success">
          <i class="bi bi-send-fill"></i>
        </button>
      </div>
    </section>
  </main>

  <!-- Partie aside plie -->
  <div class="offcanvas offcanvas-start" style="background-color: #2c2f33;" tabindex="-1" id="offcanvasAside"
    aria-labelledby="offcanvasAsideLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAsideLabel">Discussions</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <form class="d-flex justify-content-center mb-4" role="search" onsubmit="return false;">
      <div class="input-group" style="max-width: 400px;">
        <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
        <input id="searchInputMobile" class="form-control" type="search" placeholder="Rechercher une question..."
          aria-label="Search">
      </div>
    </form>
    <div class="p-3">
        <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#newConvModal">
            + Nouvelle conversation
        </button>
      </div>

        <div class="list-group list-group-flush">
        <?php
        $convs = $mongoDB->conversations->find(
            ['participants' => $currentUser],
            ['sort' => ['updated_at' => -1]]
        );
        foreach ($convs as $conv){
          $participants = $conv['participants']->getArrayCopy();

          if (!in_array($currentUser, $participants)) {
                continue;
            }

            $otherId = ($participants[0] == $currentUser)
                ? $participants[1]
                : $participants[0];
            $stmt = $pdo->prepare("SELECT nomU, prenomU FROM Utilisateurs WHERE idU = :UnionId");
            $stmt->bindValue(':UnionId', $otherId, PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $username = $user 
              ? $user['prenomU'].' '.$user['nomU'] 
              : 'Utilisateur inconnu';
        ?>
        <a href="Message.php?conv=<?= $conv['_id'] ?>"
        class="list-group-item list-group-item-action <?= ($convId == (string)$conv['_id']) ? 'active' : '' ?>">
            <strong><?= htmlspecialchars($username) ?></strong><br>
            <small><?= htmlspecialchars($conv['last_message']) ?></small>
        </a>
        <?php } ?>
        </div>
  </div>

<div class="modal fade" id="newConvModal">
  <div class="modal-dialog">
    <form method="POST" action="create_conversation.php" class="modal-content">
      <div class="modal-header">
        <h5>Nouvelle conversation</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <select name="receiver" class="form-select" required>
          <?php
          $stmt = $pdo->prepare("SELECT idU, prenomU, nomU FROM Utilisateurs WHERE idU != :currentUser");
          $stmt->bindValue(':currentUser', $currentUser, PDO::PARAM_INT);
          $stmt->execute();

            while ($u = $stmt->fetch(PDO::FETCH_ASSOC)){
            ?>
              <option value="<?= $u['idU'] ?>">
                <?= htmlspecialchars($u['prenomU'].' '.$u['nomU']) ?>
              </option>
            <?php } ?>
        </select>
      </div>

      <div class="modal-footer">
        <button class="btn btn-success">Démarrer</button>
      </div>
    </form>
  </div>
</div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatMessages = document.getElementById('chatMessages');
        const sendBtn = document.getElementById('sendBtn');
        const messageInput = document.getElementById('messageInput');
        
        let isPolling = false;
        let isFirstLoad = true;
        
        const convId = new URLSearchParams(window.location.search).get('conv');
        
        if (convId && chatMessages) {
            startPolling();
        }
        
        function startPolling() {
            pollMessages();
            setInterval(pollMessages, 1000);
        }
        
        async function pollMessages() {
            if (isPolling || !convId) return;
            
            isPolling = true;
            
            try {
                const response = await fetch(`get_messages.php?conv=${convId}`);
                const data = await response.json();
                
                if (!data.messages) return;
                
                // On clear/update les messages
                chatMessages.innerHTML = '';
                
                data.messages.forEach(message => {
                    const messageDiv = document.createElement('div');
                    messageDiv.className = `message ${message.sender == currentUserId ? 'sent' : 'received'}`;
                    messageDiv.textContent = message.message;
                    
                    chatMessages.appendChild(messageDiv);
                });
                
                
            } catch (error) {
                console.error('Error polling messages:', error);
            } finally {
                isPolling = false;
            }
        }
        
        // Envoi de message
        function sendMessage() {
            const text = messageInput.value.trim();
            if (!text) return;

            fetch("send_message.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    conversation_id: convId,
                    message: text
                })
            }).then(async () => {
                messageInput.value = "";
                await pollMessages();
            }).catch(error => {
                console.error('Error:', error);
                alert('Failed to send message. Please try again.');
            });
        }

        // Click sur le bouton d'envoi
        sendBtn.addEventListener("click", sendMessage);

        // Touche "Entrée"
        messageInput.addEventListener("keypress", (e) => {
            if (e.key === "Enter") {
                e.preventDefault();
                sendMessage();
            }
        });
    });
  </script>

  <script src="./sidebars.js"></script>
  <script src="./searchB.js"></script>

</body>

</html>