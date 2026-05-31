<?php
header('Content-Type: application/json');

$dataFile = __DIR__ . '/data.json';
if (!file_exists($dataFile)) {
    file_put_contents($dataFile, json_encode([]));
}

$input = json_decode(file_get_contents('php://input'), true);
$identity = $input['identity'] ?? '';

// Generate UUID (version 4)
function generateUuid() {
    // Generate random bytes
    $data = random_bytes(16);
    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set variant to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    // Format as UUID
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

$uuid = generateUuid();

// Load existing data
$data = json_decode(file_get_contents($dataFile), true);
// Store mapping
$data[$identity] = ['uuid' => $uuid, 'created_at' => time()];
// Save
file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));

// Return response
echo json_encode([
    'valid' => true,
    'name' => $identity,
    'token' => $uuid
]);
?>