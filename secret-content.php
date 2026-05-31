<?php
header('Content-Type: text/html');

$input = json_decode(file_get_contents('php://input'), true);
$valid = $input['validIdentity'] ?? false;
$name = $input['name'] ?? '';
$token = $input['token'] ?? '';

if (!$valid) {
    echo '<div style="padding:20px; color:red;">Invalid identity</div>';
    return;
}

echo <<<HTML
<div id="secretOverlay" class="show"><div class="secret-page">
  <h1>WELCOME.</h1>
  <p>
    THE LOST SIBLING HAS BEEN FOUND.
  </p>
</div>
<div class="token-section">
  <h2>ACCESS TOKEN</h2>
  <div class="token">$token</div>
  <a href="https://www.roblox.com/games/4947755371/" target="_blank">
    ENTER EXPERIENCE
  </a>
</div>
</div>
HTML;
?>