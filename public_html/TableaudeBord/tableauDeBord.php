<?php
session_start();
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <title>ISA NET - Tableau de bord</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <script src="./../Style/Bootstrap/assets/js/color-modes.js"></script>
    <script src="./../Style/Bootstrap/assets/dist/js/bootstrap.bundle.min.js"></script>
    <link href="./../Style/Bootstrap/assets/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./../Style/css/style.css" rel="stylesheet" />

    <style>
        .ai-header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .ai-icon {
            width: 30px;
            height: 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 0.85em;
            margin-right: 8px;
        }

        .btn-generate-ai {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 8px;
            font-size: 0.9em;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-generate-ai:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .btn-generate-ai:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .ai-model-selector {
            margin-bottom: 12px;
            font-size: 0.85em;
        }

        .ai-model-selector select {
            padding: 5px 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-left: 8px;
        }

        .ai-summary {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px;
            border-radius: 6px;
            line-height: 1.6;
            color: #2c3e50;
            white-space: pre-wrap;
            animation: fadeIn 0.5s ease;
            margin-top: 12px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .ai-loading {
            text-align: center;
            padding: 20px;
            color: #667eea;
        }

        .ai-loading-spinner {
            display: inline-block;
            width: 25px;
            height: 25px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 8px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .ai-error {
            background: #f8d7da;
            color: #721c24;
            padding: 12px 15px;
            border-radius: 6px;
            border-left: 4px solid #721c24;
            font-size: 0.9em;
            margin-top: 12px;
        }

        .ai-info {
            background: #e3f2fd;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 0.85em;
            color: #1565c0;
            margin-bottom: 12px;
        }
    </style>
</head>

<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../Connexion/laConnexion.php'; 
require '../Connexion/noSQLConnexion.php';

if (!isset($_SESSION['idU'])) {
    header("Location: /Authentification/login.php");
    exit();
}

$conversations = $mongoDB->conversations;
$messages = $mongoDB->messages;
$coursCollection = $mongoDB->cours;

$messagesNonLus = 0;
$idUser = $_SESSION['idU'];

$cursor = $conversations->find([
    'participants' => $idUser
]);

foreach ($cursor as $conv) {
    $lastMsg = $messages->findOne(
        ['conversation_id' => $conv['_id']],
        ['sort' => ['created_at' => -1]]
    );

    if ($lastMsg && $lastMsg['sender'] != $idUser) {
        $messagesNonLus++;
    }
}

$dernierCours = $coursCollection->findOne([], 
    [
        'sort' => ['date' => -1]
    ]
);

$today = date('Y-m-d');

$sqlNext = "SELECT idE, titreE, descriptionE, numImage, dateE, DateF FROM Evenements WHERE dateE >= :today ORDER BY dateE ASC LIMIT 1";

$stmt = $pdo->prepare($sqlNext);
$stmt->bindValue(':today', $today, PDO::PARAM_STR);
$stmt->execute();
$event = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<body>

    <?php 
    include './../main/header.php';
    ?>

    <main class="container">
        <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
            <div class="col-lg-6 px-0">
                <h1 class="display-4 fst-italic">
                    Tableau de bord
                </h1>
                <p class="lead my-3">
                    Ici retrouvez l'intégralité de vos informations.
                    Utilisez ces informations afin de booster votre productivité.
                </p>
            </div>
        </div>
        <div class="row mb-2">
            <!--Derniers cours-->
            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 color-bleu-system">Mes derniers cours</strong>
                        <br>
                        <p class="card-text mb-auto fst-italic">
                            Retrouvez l'ensemble des supports de cours, TD, CCB, CC...
                        </p>
                        <p class="card-text mb-3 fst-italic">
                            Téléchargez les ressources essentielles pour vos révisions
                        </p>
                        <p class="card-text mb-auto">
                           dernier cours : <?php if ($dernierCours): ?>
                                <?= htmlspecialchars($dernierCours['type']) ?> —
                                <?= htmlspecialchars($dernierCours['titre']) ?>
                            <?php else: ?>
                                Aucun cours disponible
                            <?php endif; ?>
                        </p>
                        <br>
                        <a href="/Cours/cours.php?anneeFormation=<?php echo $_SESSION['idF']?>" class="icon-link gap-1 icon-link-hover stretched-link">
                            Voir les autres cours
                        </a>
                    </div>
                    <div class="col-auto d-none d-lg-block"></div>
                </div>
            </div>

            <!--Evenements-->
            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative gradende-bleu">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 color-bleu-system">Évènements</strong>
                        <?php if ($event): ?>
                            <h3 class="mb-0"><?= htmlspecialchars($event['titreE']) ?></h3>
                            <br>
                            <p class="mb-auto">
                                <?= htmlspecialchars($event['descriptionE']) ?>
                            </p>
                            <a href="/Evenements/Evenements.php?idE=<?= $event['idE'] ?>"
                                class="icon-link gap-1 icon-link-hover stretched-link">
                                Voir l'évènement
                            </a>
                        <?php else: ?>
                            <h3 class="mb-0">Aucun évènement</h3>
                            <br>
                            <p class="mb-auto">
                                Aucun évènement prévu prochainement.
                            </p>
                        <?php endif; ?>
                        <svg class="bi" aria-hidden="true">
                            <use xlink:href="#chevron-right"></use>
                        </svg>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <div style="width:200px; height:250px; overflow:hidden; border-radius:0 .375rem .375rem 0;">
                            <img src="./../img/img.jpg.avif" alt="Événement"
                                style="width:100%; height:100%; object-fit:cover; object-position:center;">
                        </div>
                    </div>
                </div>
            </div>


            <!--Assistant IA-->
            <div class="col-md-7">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm position-relative gradende-bleu">
                    <div class="col p-4 d-flex flex-column position-static">
                        <div class="ai-header-section">
                            <strong class="d-inline-block mb-2 color-bleu-system">
                                <span class="ai-icon">AI</span>
                                Assistant IA
                            </strong>
                            <button class="btn-generate-ai" id="generateBtn" onclick="genererResume()">
                                <i class="bi bi-stars"></i>
                                Générer
                            </button>
                        </div>

                        <div class="ai-info">
                            <i class="bi bi-info-circle"></i>
                            Connecté à Ollama EVA • <strong id="currentModel">mistral:7b</strong>
                        </div>

                        <div class="ai-model-selector">
                            <label for="modelSelect"><strong>Modèle:</strong></label>
                            <select id="modelSelect" onchange="updateModelDisplay()">
                                <option value="mistral:7b">Mistral 7B</option>
                                <option value="llama2:latest">Llama 2</option>
                                <option value="gemma:7b">Gemma 7B</option>
                                <option value="codellama:7b">CodeLlama 7B</option>
                                <option value="deepseek-r1:1.5b">DeepSeek R1</option>
                            </select>
                        </div>

                        <div id="summaryContainer">
                            <p class="card-text mb-auto text-muted" style="font-style: italic;">
                                Cliquez sur "Générer" pour obtenir un résumé intelligent de votre tableau de bord.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!--Messages non lus-->
            <div class="col-md-5">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <strong class="color-bleu-system">Mes messages</strong>
                            <i class="bi bi-eye fs-4 text-primary rounded-circle"></i>
                        </div>

                        <div class="mb-1">Nouveaux messages</div>
                        <p class="mb-auto">
                            <br>
                            Vous avez reçu<strong> <?php echo $messagesNonLus; ?></strong> message(s) non lu(s)
                        </p>
                        <a href="/Message/Message.php" class="icon-link gap-1 icon-link-hover stretched-link">
                            Voir plus
                            <svg class="bi" aria-hidden="true">
                                <use xlink:href="#chevron-right"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>


        </div>
    </main>

    <?php
    include './../main/footer.php';
    ?>

    <script>
        // Données du tableau de bord (injectées depuis PHP)
        const dashboardData = {
            messages: {
                nouveaux: <?php echo $messagesNonLus; ?>,
                total: <?php echo $messagesNonLus; ?>
            },
            cours: {
                dernier: "<?php echo $dernierCours ? htmlspecialchars($dernierCours['type']) . ' - ' . htmlspecialchars($dernierCours['titre']) : 'Aucun cours'; ?>"
            },
            evenement: {
                prochain: "<?php echo $event ? htmlspecialchars($event['titreE']) : 'Aucun événement'; ?>",
                description: "<?php echo $event ? htmlspecialchars($event['descriptionE']) : ''; ?>"
            }
        };

        function updateModelDisplay() {
            const select = document.getElementById('modelSelect');
            document.getElementById('currentModel').textContent = select.value;
        }

        async function genererResume() {
            const btn = document.getElementById('generateBtn');
            const container = document.getElementById('summaryContainer');
            const modelSelect = document.getElementById('modelSelect');
            const selectedModel = modelSelect.value;

            btn.disabled = true;
            container.innerHTML = `
                <div class="ai-loading">
                    <div class="ai-loading-spinner"></div>
                    <div>Génération du résumé en cours...</div>
                    <small style="color: #999; margin-top: 8px; display: block;">
                        ⚠️ L'API de test peut être lente (jusqu'à 2 minutes)
                    </small>
                </div>
            `;

            try {
                const prompt = `Tu es un assistant intelligent intégré à un hub pour étudiants en informatique (Computer Science).

Analyse les informations suivantes du tableau de bord étudiant :

📧 Messages : ${dashboardData.messages.nouveaux} nouveau(x) message(s) non lu(s)
📚 Dernier cours : ${dashboardData.cours.dernier}
🎉 Prochain événement : ${dashboardData.evenement.prochain}
${dashboardData.evenement.description ? '   Description : ' + dashboardData.evenement.description : ''}

Fournis un résumé TRÈS COURT (maximum 3-4 phrases) avec :
1. Les points clés à retenir
2. Ce qui nécessite une attention immédiate
3. Une recommandation motivante et constructive

Réponds en français avec un ton clair, pédagogique et motivant. Sois concis et direct.`;

                // MODIFICATION : Appel à l'API PHP locale au lieu d'Ollama directement
                const response = await fetch('./api_ollama.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        model: selectedModel,
                        prompt: prompt
                    })
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.error || `Erreur HTTP: ${response.status}`);
                }

                const data = await response.json();

                if (data.response) {
                    container.innerHTML = `<div class="ai-summary">${data.response}</div>`;
                } else {
                    throw new Error("Aucune réponse reçue du modèle");
                }

            } catch (error) {
                console.error('Erreur:', error);
                container.innerHTML = `
                    <div class="ai-error">
                        <strong><i class="bi bi-exclamation-triangle"></i> Erreur</strong><br>
                        ${error.message}
                        <br><br>
                        <strong>Vérifiez que :</strong>
                        <ul style="margin: 10px 0 0 15px; font-size: 0.9em;">
                            <li>Le fichier api_ollama.php existe dans le même dossier</li>
                            <li>Le serveur peut accéder à chat-eva.univ-pau.fr</li>
                            <li>Le modèle sélectionné est chargé sur Ollama</li>
                        </ul>
                    </div>
                `;
            } finally {
                btn.disabled = false;
            }
        }
    </script>

</body>

</html>