<?php
function encrypt($plaintext, $password) {
    $method = "AES-256-CBC";
    $key = hash('sha256', $password, true);
    $iv = openssl_random_pseudo_bytes(16);

    $ciphertext = openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv);
    $hash = hash_hmac('sha256', $ciphertext . $iv, $key, true);

    return base64_encode($iv . $hash . $ciphertext);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];
    $id = bin2hex(random_bytes(16)); // Použijeme delší, náhodnější ID
    $password = bin2hex(random_bytes(16));
    $encrypted = encrypt($message, $password);
    $filename = 'messages/' . $id . '.txt';
    
    if (!file_exists('messages')) {
        mkdir('messages', 0777, true);
    }
    
    file_put_contents($filename, $encrypted);
    echo json_encode(['id' => $id, 'password' => $password]);
}