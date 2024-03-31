<?php

// Verificando se o parâmetro ?p= foi passado na URL
if (isset($_GET['p'])) {
    // Obtendo o valor do parâmetro ?p=
    $name = $_GET['p'];
    
    // URL da página com o parâmetro ?p=
    $url = "https://www.receiteria.com.br/receita/" . urlencode($name);

    // Obtendo o conteúdo da página
    $html = file_get_contents($url);

    // Substituindo a URL
    $html = str_replace("www.receiteria.com.br", "gean.me", $html);
    $html = str_replace("-400x220", "", $html);

    // Encontrando a parte do HTML desejada
    preg_match('/<div class="relacionadas">(.*?)<aside class="col-12 col-md-4 sticky">/s', $html, $matches);

    // Verificando se foi encontrado o trecho desejado
    if (isset($matches[1])) {
        $content = $matches[1];

        // Encontrando todas as URLs
        preg_match_all('/<a\s+(?:[^>]*?\s+)?href=([\'"])(.*?)\1/', $content, $urlMatches);
        $urls = $urlMatches[2];

        // Encontrando todas as imagens dentro de <noscript>
        preg_match_all('/<noscript><img\s+(?:[^>]*?\s+)?src=([\'"])(.*?)\1/', $content, $imageMatches);
        $images = $imageMatches[2];

        // Encontrando todas as descrições
        preg_match_all('/<h3>(.*?)<\/h3>/', $content, $descriptionMatches);
        $descriptions = $descriptionMatches[1];

        // Limitando para as 6 primeiras receitas
        $urls = array_slice($urls, 0, 6);
        $images = array_slice($images, 0, 6);
        $descriptions = array_slice($descriptions, 0, 6);

        // Exibindo os resultados
        for ($i = 0; $i < count($urls); $i++) {
            echo "<div class='item features-image col-12 col-md-6 col-lg-4 active'>";
            echo "    <div class='item-wrapper'>";
            echo "        <div class='item-img'>";
            echo "            <a href='" . $urls[$i] . "'>";
			echo "				<img class='hover-img' src='https://images.weserv.nl/?w=320&h=180&output=webp&q=100&t=square&filt=duotone&url=" . $images[$i] . "' alt='" . $descriptions[$i] . " por Gean Ramos' title='" . $descriptions[$i] . " por Gean Ramos'>";
			echo "				<img class='base-img' src='https://images.weserv.nl/?w=760&h=427&output=webp&q=80&t=square&url=" . $images[$i] . "' alt='" . $descriptions[$i] . " por Gean Ramos' title='" . $descriptions[$i] . " por Gean Ramos'>";
			echo "			</a>";
            echo "        </div>";
            echo "    </div>";
            echo "</div>";
        }
    } else {
        echo "Não Temos indicações";
    }
} else {
    echo "OPS! Erro Interno";
}
?>
