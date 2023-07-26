<?php
$publicKey = '57d0121bf03abe102f19923088ea530f';
$privateKey = 'bfb635effc262315cd77187c4f21637999cb2968';
$baseUrl = 'https://gateway.marvel.com/v1/public/characters';

// Criando o timestamp (ts) atual
$timestamp = time();

// Construindo o hash usando o timestamp, a private key e a public key
$hash = md5($timestamp . $privateKey . $publicKey);

// Montando a URL completa com os parâmetros de autenticação
$url = "{$baseUrl}?ts={$timestamp}&apikey={$publicKey}&hash={$hash}";

// Realizando a requisição à API usando cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Decodificando a resposta JSON
$data = json_decode($response, true);

// Teste: Verifique o que foi retornado pela API
// print_r($data);

?>
