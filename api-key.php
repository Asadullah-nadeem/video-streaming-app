<?php
// Define a function to generate a random API key
// Define a function to generate a random API key
function generateApiKey() {
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $length = 12;
    $key = '';
    // Generate a random string of characters
    for ($i = 0; $i < $length; $i++) {
        $key .= $chars[rand(0, strlen($chars) - 1)];
    }
    // Check if the key already exists
    if (keyExists($key)) {
        // If it does, generate a new key
        return generateApiKey();
    }
    // If the key does not exist, return it
    return $key;
}
// Define a function to check if a key already exists
function keyExists($key) {
    // You can implement your own method to check if the key exists in a database or file
    // For example, if you store keys in a file, you can use the following code to check:
    // $keys = file('api_keys.txt', FILE_IGNORE_NEW_LINES);
    // return in_array($key, $keys);
    // For simplicity, we'll assume that the key does not exist
    return false;
}

if (isset($_GET['api_key'])) {
    $apiKey = $_GET['api_key'];
} else {
    $apiKey = generateApiKey();
}

header('API-KEY: ' . $apiKey);

//Json file
$url = 'https://codeaxe.in/a/api.php?api_key=' . urlencode($apiKey);
$json_data = file_get_contents($url);
$data = json_decode($json_data, true);

header('Content-Type: application/json');
echo json_encode($data);
?>