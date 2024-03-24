<!DOCTYPE html>
<!--
Desenvolvido por Gean Ramos
WebSite: https://geanramos.com
WebSite: https://gean.me
Twitter: https://x.com/geanramos
Instagram: https://instagr.am/geanramus
Facebook: https://fb.com/geanramus
-->
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria YouTube</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }
        .gallery-item {
            border-radius: 5px;
            overflow: hidden;
            position: relative; /* Added for hover effect */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .gallery-item img {
            width: 100%;
            height: auto;
            display: block;
        }
        .gallery-item a {
            text-decoration: none;
            color: #333;
            display: block;
            padding: 10px;
            background-color: #fff;
            text-align: center;
        }
        .gallery-item a:hover {
            background-color: #f9f9f9;
        }
        /* New CSS for hover effect */
        .gallery-item .hover-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }
        .gallery-item:hover .hover-image {
            opacity: 1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Galeria de Imagens</h1>
        <div class="gallery">
<?php
// URL do canal do YouTube
// https://www.youtube.com/@Prizza/videos
// https://www.youtube.com/channel/UC43nsQHUiTT2na67yM796HQ/videos
$url = "https://raw.githubusercontent.com/geanramos/files/master/yt2.html";

// Obtendo o conteúdo da página
$html = file_get_contents($url);

// Inicializando uma string para armazenar as URLs das imagens
$image_urls = "";

// Encontrando todas as URLs das imagens na página usando expressões regulares
preg_match_all('/https:\/\/i\.ytimg\.com\/an_webp\/([^\/]+)\/mqdefault_6s\.webp\?du=3000\\\\u0026sqp=([^\\\\]+)\\\\u0026rs=([^_]+)([^"]+)([^"]+)([^"]+)/', $html, $matches);

// Exibindo as URLs das imagens
foreach ($matches[0] as $url) {
    // Corrigindo a formatação das URLs substituindo '\u0026' por '&'
    $url = str_replace('\\u0026', '&', $url);

    // Separando as partes da URL
    $url_parts = explode(',', $url);

    // Obtendo a url da imagem
    $url_img = $url_parts[0];

    // Extraindo o ID da imagem
    $start = strpos($url_img, 'an_webp/') + strlen('an_webp/');
    $end = strpos($url_img, '/mqdefault_6s.webp');
    $id_img = substr($url_img, $start, $end - $start);

    // Exibindo a imagem na galeria com o ID
    echo '<div class="gallery-item">';
    echo '<a href="https://gean.me/watch?v=' . $id_img . '">';
    echo '<img src="https://img.youtube.com/vi/' . $id_img . '/mqdefault.jpg" alt="Imagem estática">';
    echo '<img src="' . $url_img . '" alt="Imagem hover" class="hover-image">';
    echo '</div>';
}
?>

        </div>
    </div>
</body>
</html>
