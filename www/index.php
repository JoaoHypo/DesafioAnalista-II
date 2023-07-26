<!DOCTYPE html>
<html>
<head>
    <title>Heróis da Marvel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    
    <h1>Meus Heróis Favoritos da Marvel</h1>

    <?php
    // Incluindo api.php para obter os dados dos heróis
    $heroes = include 'api.php';

    // Verificando se há heróis disponíveis
    if (count($heroes) > 0) {
        // Exibindo os dados dos heróis e suas histórias
        foreach ($heroes as $hero) {
            $name = $hero['name'];
            $thumbnailUrl = "{$hero['thumbnail']['path']}.{$hero['thumbnail']['extension']}";

            // Exibindo o nome e a imagem do herói
            echo "<div class='hero-card'>";
            echo "<h2>{$name}</h2>";
            echo "<img src='{$thumbnailUrl}' alt='{$name}'>";

            // Obtendo as histórias do herói
            $characterId = $hero['id'];
            $storiesUrl = "https://gateway.marvel.com/v1/public/characters/{$characterId}/stories?ts={$timestamp}&apikey={$publicKey}&hash={$hash}";

            $ch_stories = curl_init();
            curl_setopt($ch_stories, CURLOPT_URL, $storiesUrl);
            curl_setopt($ch_stories, CURLOPT_RETURNTRANSFER, true);
            $response_stories = curl_exec($ch_stories);
            curl_close($ch_stories);

            $data_stories = json_decode($response_stories, true);

            // Verificando se há histórias associadas ao herói
            if (isset($data_stories['data']['results']) && count($data_stories['data']['results']) > 0) {
                echo "<ul>";
                $stories = array_slice($data_stories['data']['results'], 0, 5); // Exibir apenas as 5 primeiras histórias
                foreach ($stories as $story) {
                    $storyTitle = $story['title'];
                    echo "<li>{$storyTitle}</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>Nenhuma história encontrada para este herói.</p>";
            }

            echo "</div>";
        }
    } else {
        echo "<p>Nenhum herói encontrado.</p>";
    }
    ?>

    <?php include 'footer.php'; ?>
</body>
</html>
