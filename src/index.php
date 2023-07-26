<!DOCTYPE html>
<html>
<head>
    <title>Heróis da Marvel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Meus Heróis Favoritos da Marvel</h1>

    <div class="container">
        <?php
        // Incluindo api.php para obter os dados dos heróis
        $heroes = include 'api.php';

        // Verificando se há heróis disponíveis
        if (count($heroes) > 0) {
            // Exibindo os dados dos heróis e suas histórias
            foreach ($heroes as $hero) {
                $name = $hero['name'];
                $thumbnailUrl = $hero['thumbnail'];

                // Exibindo o nome e a imagem do herói
                echo "<div class='hero-card'>";
                echo "<h2>{$name}</h2>";
                echo "<img src='{$thumbnailUrl}' alt='{$name}'>";

                // Verificando se há histórias associadas ao herói
                if (isset($hero['stories']) && count($hero['stories']) > 0) {
                    echo "<ul>";
                    echo "<h2>5 Histórias presente:</h2>";
                    foreach ($hero['stories'] as $story) {
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
    </div>
</body>
</html>
