<?php
$publicKey = '57d0121bf03abe102f19923088ea530f';
$privateKey = 'bfb635effc262315cd77187c4f21637999cb2968';
$baseUrl = 'https://gateway.marvel.com/v1/public/characters';

// Função para buscar um herói pelo nome e retornar suas informações
function getHeroByName($name)
{
    global $publicKey, $privateKey, $baseUrl;

    // Criando o timestamp (ts) atual
    $timestamp = time();

    // Construindo o hash usando o timestamp, a private key e a public key
    $hash = md5($timestamp . $privateKey . $publicKey);

    // Montando a URL completa com os parâmetros de autenticação e o nome do herói
    $url = "{$baseUrl}?name={$name}&ts={$timestamp}&apikey={$publicKey}&hash={$hash}";

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
        return $data['data']['results'][0];
    } else {
        return null;
    }
}

// Função para obter as histórias de um herói pelo ID
function getHeroStories($heroId)
{
    global $publicKey, $privateKey, $baseUrl;

    // Criando o timestamp (ts) atual
    $timestamp = time();

    // Construindo o hash usando o timestamp, a private key e a public key
    $hash = md5($timestamp . $privateKey . $publicKey);

    // Montando a URL completa com os parâmetros de autenticação e o ID do herói
    $url = "{$baseUrl}/{$heroId}/stories?ts={$timestamp}&apikey={$publicKey}&hash={$hash}";

    // Realizando a requisição à API usando cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Decodificando a resposta JSON
    $data = json_decode($response, true);

    // Verificando se há dados na resposta da API
    if (isset($data['data']['results'])) {
        // Embaralhar as histórias para selecionar 5 aleatórias
        shuffle($data['data']['results']);
        $selectedStories = array_slice($data['data']['results'], 0, 5);
        return $selectedStories;
    } else {
        return [];
    }
}

// Obtendo os heróis da Marvel pelos nomes listados
$heroesNames = array('Hulk', 'Storm', 'Daredevil');
$selectedHeroesData = array();

foreach ($heroesNames as $heroName) {
    $hero = getHeroByName($heroName);

    if ($hero !== null) {
        $heroId = $hero['id'];
        $selectedHeroesData[] = [
            'name' => $hero['name'],
            'thumbnail' => "{$hero['thumbnail']['path']}.{$hero['thumbnail']['extension']}",
            'stories' => getHeroStories($heroId)
        ];
    }
}

return $selectedHeroesData;
?>