<?php

// Definir a URL da imagem padrão
define('URL_IMAGEM_PADRAO', 'https://images.weserv.nl/?url=' . $htmlSocial . '&w=600&h=338&output=jpeg&q=80&t=square');

// Obter a URL da imagem da query string
$urlImagem = isset($_GET['img']) ? $_GET['img'] : URL_IMAGEM_PADRAO;

// Validar a URL da imagem
if (!filter_var($urlImagem, FILTER_VALIDATE_URL)) {
    die('OPS!');
}

// Carregar a imagem
try {
    $imageData = file_get_contents($urlImagem);
} catch (Exception $e) {
    die('OPS!');
}

// Converter a imagem em Base64
$base64Image = base64_encode($imageData);

// Exibir a imagem em Base64
// echo "<img src=\"data:image/jpeg;base64,$base64Image\">";

?>
