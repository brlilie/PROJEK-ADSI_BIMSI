<?php
$messages = [];

if (file_exists('messages.txt')) {
    $lines = file('messages.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $messages[] = json_decode($line, true);
    }
}

header('Content-Type: application/json');
echo json_encode($messages);
