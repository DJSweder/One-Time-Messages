<?php
function decrypt($ivHashCiphertext, $password) {
    $ivHashCiphertext = base64_decode($ivHashCiphertext);
    $method = "AES-256-CBC";
    $iv = substr($ivHashCiphertext, 0, 16);
    $hash = substr($ivHashCiphertext, 16, 32);
    $ciphertext = substr($ivHashCiphertext, 48);
    $key = hash('sha256', $password, true);

    if (!hash_equals(hash_hmac('sha256', $ciphertext . $iv, $key, true), $hash)) return null;

    return openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $password = isset($_GET['password']) ? $_GET['password'] : '';
    $filename = 'messages/' . $id . '.txt';
    
    if (file_exists($filename)) {
        $encrypted = file_get_contents($filename);
        $message = decrypt($encrypted, $password);
        unlink($filename);
        echo $message !== null ? $message : 'Neplatný odkaz nebo zpráva již byla zobrazena.';
    } else {
        echo 'Zpráva nebyla nalezena nebo již byla zobrazena.';
    }
}