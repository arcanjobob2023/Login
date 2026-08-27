<?php

session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado.']);
    exit();
}

require_once 'db.php';

$database = new Database();
$pdo = $database->getPdo();

try {
    $stmt = $pdo->query("SELECT page_name, clicks FROM page_clicks;");
    $results = $stmt->fetchAll(PDO::FETCH_KEY_PAIR); 

    echo json_encode(['success' => true, 'clicks' => $results]);

} catch (PDOException $e) {
    error_log("Error getting clicks: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
