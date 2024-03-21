<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cópia de Imagem para Local Host</title>
</head>
<body>
<?php
// URL da imagem a ser copiada
$image_url1 = "https://images.weserv.nl/?w=600&h=338&output=jpeg&q=80&t=square&url=$htmlSocial";

// Lê o conteúdo da imagem
$image_data = file_get_contents($image_url1);

if ($image_data !== false) {
    // Obtém o nome do arquivo da URL
    $file_name = basename($image_url1);

    // Caminho completo para a pasta cache
    $cache_folder = '../cdn/';

    // Verifica se a pasta cache existe, se não, cria-a
    if (!is_dir($cache_folder)) {
        mkdir($cache_folder);
    }

    // Caminho completo para salvar a imagem na pasta cache
    $file_path = $cache_folder . $file_name;

    // Salva o conteúdo da imagem em um novo arquivo
    $savedLocal = file_put_contents($file_path, $image_data);

    if ($savedLocal !== false) {
        echo "<img src='https://gean.me/cdn/$file_name' alt='Imagem copiada para o Local Host'>";
    } else {
        // Erro ao salvar a imagem.
        echo "<img src='https://cdn.jsdelivr.net/gh/geanramos/files/404.webp' alt='Erro ao salvar a imagem'>";
    }
} else {
    // Erro ao obter a imagem.
    echo "<img src='https://cdn.jsdelivr.net/gh/geanramos/files/404.webp' alt='Erro ao obter a imagem'>";
}
?>
</body>
</html>
