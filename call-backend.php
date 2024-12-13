<?php
header('Content-Type: text/plain');

// Define the container's address and port
$containerHost = 'ip-app';
$containerPort = 8080;
$endpoint = "http://$containerHost:$containerPort";

try {
    // Use cURL to call the backend service
    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($response === false || $httpCode !== 200) {
        $error = curl_error($ch);
        throw new Exception("Error: Unable to call backend service. HTTP Code: $httpCode, Error: $error");
    }

    curl_close($ch);

    // Return the backend response
    echo $response;
} catch (Exception $e) {
    echo $e->getMessage();
}