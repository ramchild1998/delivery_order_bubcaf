<?php

$ch = curl_init();

$searchUrl = 'http://localhost:8000/api/vendors/search';

$searchData = [
    'name' => $_POST['name'],
];

curl_setopt($ch, CURLOPT_URL, $searchUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $searchData);

$response = curl_exec($ch);

if ($response === false) {
    echo 'Error: ' . curl_error($ch);
} else {
    $responseData = json_decode($response, true);
    print_r($responseData);
}

curl_close($ch);