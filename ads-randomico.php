{
"GCRads": [
{
"titulo": "Imagem 1",
"imagem": "https://via.placeholder.com/400x200?text=Animal+1",
"link": "https://www.example.com/1"
},
{
"titulo": "Imagem 2",
"imagem": "https://via.placeholder.com/400x200?text=Animal+2",
"link": "https://www.example.com/2"
},
{
"titulo": "Imagem 3",
"imagem": "https://via.placeholder.com/400x200?text=Animal+3",
"link": "https://www.example.com/3"
},
{
"titulo": "Imagem 4",
"imagem": "https://via.placeholder.com/400x200?text=Animal+4",
"link": "https://www.example.com/4"
},
{
"titulo": "Imagem 5",
"imagem": "https://via.placeholder.com/400x200?text=Animal+5",
"link": "https://www.example.com/5"
},
{
"titulo": "Imagem 6",
"imagem": "https://via.placeholder.com/400x200?text=Animal+6",
"link": "https://www.example.com/6"
},
{
"titulo": "Imagem 7",
"imagem": "https://via.placeholder.com/400x200?text=Animal+7",
"link": "https://www.example.com/7"
},
{
"titulo": "Imagem 8",
"imagem": "https://via.placeholder.com/400x200?text=Animal+8",
"link": "https://www.example.com/8"
},
{
"titulo": "Imagem 9",
"imagem": "https://via.placeholder.com/400x200?text=Animal+9",
"link": "https://www.example.com/9"
},
{
"titulo": "Imagem 10",
"imagem": "https://via.placeholder.com/400x200?text=Animal+10",
"link": "https://www.example.com/10"
}
]
}

<?php
// Carrega o conteúdo do arquivo JSON
$json_data = file_get_contents('https://raw.githubusercontent.com/geanramos/files/master/GCRads.json?g=547569');

// Decodifica o conteúdo JSON para um array associativo
$data = json_decode($json_data, true);

// Obtém um índice aleatório entre 0 e o número total de GCRads
$index = rand(0, count($data['GCRads']) - 1);

// Obtém os dados da imagem correspondente ao índice aleatório
$ads = $data['GCRads'][$index];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banner: <?php echo $ads['titulo']; ?></title>
</head>

<body>
    <h1>Banner: <?php echo $ads['titulo']; ?></h1>
    <a href="<?php echo $ads['link']; ?>" target="_blank">
        <img src="<?php echo $ads['imagem']; ?>" alt="<?php echo $ads['titulo']; ?>">
    </a>
</body>

</html>
