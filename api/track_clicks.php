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

$input = json_decode(file_get_contents('php://input'), true);
$page_name = $input['page'] ?? null;

if (!$page_name) {
    echo json_encode(['success' => false, 'message' => 'Page name is required.']);
    exit();
}

try {
    $pdo->beginTransaction();

    
    $stmt = $pdo->prepare("INSERT INTO page_clicks (page_name, clicks) VALUES (:page_name, 1) ON CONFLICT(page_name) DO UPDATE SET clicks = clicks + 1;");
    $stmt->execute([':page_name' => $page_name]);

    $stmt = $pdo->prepare("SELECT clicks FROM page_clicks WHERE page_name = :page_name;");
    $stmt->execute([':page_name' => $page_name]);
    $result = $stmt->fetch();
    $current_clicks = $result['clicks'] ?? 0;

    $pdo->commit();

    echo json_encode(['success' => true, 'message' => 'Click tracked successfully.', 'clicks' => $current_clicks]);

} catch (PDOException $e) {
    $pdo->rollBack();
    error_log("Error tracking click for page {$page_name}: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
