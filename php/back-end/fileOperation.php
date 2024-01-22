<?php

// Path to directory
$directoryPath = '../../countries';

// Check files in directory
$files = scandir($directoryPath);

// If there are no files
if (!$files || count($files) === 0) {
    http_response_code(404);
    die('No files found in the directory');
}

// Pull random file
$randomIndex = mt_rand(2, count($files) - 1);
$randomFile = $files[$randomIndex];
// Remove .png extension in name
$fileNameWithoutExtension = str_replace(".png", "", $randomFile);

// Send to JS code
echo json_encode(['fileNameWithoutExtension' => $fileNameWithoutExtension]);

