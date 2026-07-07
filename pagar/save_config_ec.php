<?php
// API для сохранения конфигурации админкой
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-Admin-Password');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Проверка пароля администратора
$adminPassword = 'DipDip1029'; // Измените на свой надёжный пароль!
$headers = getallheaders();
$providedPassword = isset($headers['X-Admin-Password']) ? $headers['X-Admin-Password'] : '';

if ($providedPassword !== $adminPassword) {
    http_response_code(403);
    echo json_encode(['success' => false, 'error' => 'Acceso denegado. Contraseña incorrecta.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
    exit;
}

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Datos JSON inválidos']);
    exit;
}

$configFile = __DIR__ . '/config_ec.json';

// Валидация структуры данных
if (!isset($data['banks']) || !is_array($data['banks'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Estructura de datos inválida: se requiere "banks"']);
    exit;
}

// Сохраняем с красивым форматированием
$result = file_put_contents($configFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

if ($result === false) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'No se pudo guardar el archivo de configuración']);
    exit;
}

echo json_encode(['success' => true, 'message' => 'Configuración guardada correctamente']);
?>
