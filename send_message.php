<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    date_default_timezone_set('Asia/Jakarta'); // Indonesian time
    $message = trim($_POST['message']);
    $timestamp = date('H:i');

    $entry = json_encode([
        'text' => $message,
        'time' => $timestamp
    ]) . PHP_EOL;

    file_put_contents('messages.txt', $entry, FILE_APPEND);
}
