<?php
session_start();
require_once 'ApiClient.php';

if (isset($_GET['ajax'])) {
    $api = new ApiClient();
    $url = 'https://bigdatacloud.net';
    
    $apiData = $api->request($url);

    if (!isset($apiData['error'])) {
        $_SESSION['api_data'] = $apiData;
        file_put_contents('api_cache.json', json_encode($apiData, JSON_UNESCAPED_UNICODE));
    }
    
    header('Content-Type: application/json');
    echo json_encode($apiData);
    exit();
}

$name = htmlspecialchars($_POST['user_name'] ?? '');

if (empty($name)) {
    $_SESSION['errors'] = ["Введите имя для заказа такси"];
    header("Location: index.php");
    exit();
}

$api = new ApiClient();
$url = 'https://bigdatacloud.net';

// штрафное задание
$cacheFile = 'api_cache.json';
$cacheTtl = 300; 

if (file_exists($cacheFile) && (time() - filemtime($cacheFile) < $cacheTtl)) {
    $apiData = json_decode(file_get_contents($cacheFile), true);
} else {
    $apiData = $api->request($url);
    if (!isset($apiData['error'])) {
        file_put_contents($cacheFile, json_encode($apiData, JSON_UNESCAPED_UNICODE));
    }
}

$_SESSION['user_name'] = $name;
$_SESSION['api_data'] = $apiData;

setcookie("last_submission", date('Y-m-d H:i:s'), time() + 3600, "/");

header("Location: index.php");
exit();
