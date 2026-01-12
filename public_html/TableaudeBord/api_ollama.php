<?php
/**
 * API Proxy pour Ollama EVA (version sans cURL)
 */

ini_set('display_errors', 0);
error_reporting(0);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Méthode non autorisée']);
    exit();
}

try {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (!$data || !isset($data['model']) || !isset($data['prompt'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Données invalides (model et prompt requis)']);
        exit();
    }

    $ollamaUrl = 'http://chat-eva.univ-pau.fr:11434/api/generate';

    $ollamaData = [
        'model' => $data['model'],
        'prompt' => $data['prompt'],
        'stream' => false
    ];

    $options = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/json',
            'content' => json_encode($ollamaData),
            'timeout' => 120,
            'ignore_errors' => true
        ]
    ];
    
    $context = stream_context_create($options);
    $response = @file_get_contents($ollamaUrl, false, $context);

    if ($response === false) {
        http_response_code(500);
        echo json_encode([
            'error' => 'Impossible de contacter Ollama EVA',
            'details' => 'Vérifiez la connexion réseau et l\'URL'
        ]);
        exit();
    }

    // Vérifier le code HTTP de la réponse
    $statusLine = $http_response_header[0] ?? '';
    preg_match('{HTTP/\d\.\d\s+(\d+)}', $statusLine, $match);
    $httpCode = isset($match[1]) ? (int)$match[1] : 500;

    if ($httpCode !== 200) {
        http_response_code(500);
        echo json_encode([
            'error' => "Ollama a retourné une erreur (HTTP $httpCode)",
            'details' => substr($response, 0, 200)
        ]);
        exit();
    }

    $decoded = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(500);
        echo json_encode([
            'error' => 'Réponse Ollama invalide',
            'details' => 'La réponse n\'est pas du JSON valide'
        ]);
        exit();
    }

    echo $response;

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Erreur serveur',
        'details' => $e->getMessage()
    ]);
}
?>