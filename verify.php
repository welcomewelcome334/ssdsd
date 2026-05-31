<?php
header('Content-Type: application/json');

// Ensure data file exists
$dataFile = __DIR__ . '/data.json';
if (!file_exists($dataFile)) {
    file_put_contents($dataFile, json_encode([]));
}

// Get input
$input = json_decode(file_get_contents('php://input'), true);
$code = $input['code'] ?? '';

$success = false;
$uuid = null;

// Check if code is MA5H
if ($code === 'MA5H') {
    $success = true;
} else {
    // Load stored mappings
    $data = json_decode(file_get_contents($dataFile), true);
    // Check if code matches any stored identity (Roblox user ID)
    foreach ($data as $identity => $info) {
        if ($identity === $code) {
            $success = true;
            $uuid = $info['uuid'] ?? null;
            break;
        }
    }
}

$response = ['success' => $success];
if ($uuid !== null) {
    $response['uuid'] = $uuid;
}

echo json_encode($response);
?>