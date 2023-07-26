<?php
$publicKey = '57d0121bf03abe102f19923088ea530f';
$privateKey = 'bfb635effc262315cd77187c4f21637999cb2968';
$baseUrl = 'https://gateway.marvel.com/v1/public/characters';

// IDs dos heróis específicos (Homem-Aranha, Storm e Tocha Humana)
$heroIds = array(1009610, 1009629, 1009351); // Esses IDs são específicos para Homem-Aranha, Storm e Tocha Humana

// Criando o timestamp (ts) atual
$timestamp = time();

// Construindo o hash usando o timestamp, a private key e a public key
$hash = md5($timestamp . $privateKey . $publicKey);

// Variável para armazenar os dados dos heróis
$heroesData = array();

foreach ($heroIds as $heroId) {
    // Montando a URL completa com os parâmetros de autenticação e o ID do herói
    $url = "{$baseUrl}/{$heroId}?ts={$timestamp}&apikey={$publicKey}&hash={$hash}";

    // Realizando a requisição à API usando cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Decodificando a resposta JSON
    $data = json_decode($response, true);

    // Verificando se há dados na resposta da API
    if (isset($data['data']['results'][0])) {
        $heroesData[] = $data['data']['results'][0];
    }
}

// Retornando os dados dos heróis para serem exibidos no index.php
return $heroesData;
?>
