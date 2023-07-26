<?php
$publicKey = 'SUA_PUBLIC_KEY';
$privateKey = 'SUA_PRIVATE_KEY';
$baseUrl = 'https://gateway.marvel.com/v1/public/characters';

$timestamp = time();
$hash = md5($timestamp . $privateKey . $publicKey);

$url = "{$baseUrl}?ts={$timestamp}&apikey={$publicKey}&hash={$hash}";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);

// Teste: Verifique o que foi retornado pela API
print_r($data);
?>
