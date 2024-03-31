<?php
    $name = $_GET['url'];

    // URL do Embed
    $url = 'https://www.receiteria.com.br/receita/' . $name . '/embed/';

    // Obtém o conteúdo da página
    $html = file_get_contents($url);

    // Expressão regular para extrair o postid
    $pattern = '/postid-(\d+)/';

    // Procura pelo padrão na página
    if (preg_match($pattern, $html, $matches)) {  
    
        // URL do JSON
        $json_url = 'https://www.receiteria.com.br/wp-json/oembed/1.0/embed?url=https://www.receiteria.com.br/receita/' . $name . '/';

        // Obtém o JSON
        $json_data = file_get_contents($json_url);

        // Decodifica o JSON
        $data = json_decode($json_data, true);

        // Verifica se os dados foram decodificados com sucesso
        //if ($data) {
        //    echo '<h1>' . $data['title'] . '</h1>';
        //    echo '<p><strong>Thumbnail URL:</strong> <img src="' . $data['thumbnail_url'] . '" alt="Thumbnail"></p>';
        //    echo '<p><strong>Description:</strong> ' . $data['description'] . '</p>';
        //    echo '<p><strong>Author Name:</strong> ' . $data['author_name'] . '</p>';
        //    echo '<p><strong>Author URL:</strong> ' . $data['author_url'] . '</p>';
        //    echo '<p><strong>Post Id:</strong> ' . $matches[1] . '</p>';
        //    echo '<p><strong>Thumbnail Width:</strong> ' . $data['thumbnail_width'] . '</p>';
        //    echo '<p><strong>Thumbnail Height</strong> ' . $data['thumbnail_height'] . '</p>';
        //} else {
        //    echo 'Erro ao carregar os dados.';
        //}
        // URL da imagem
        $urlImgName = $data['thumbnail_url'];
        
        // Obtém o nome do arquivo da URL
        $imgName = basename($urlImgName);
        // Exibe o nome do arquivo
        //echo '<p><strong>Img Name</strong> ' . $imgName . '</p>';

        // Verifica se $matches está definido antes de usá-lo
        if (isset($matches[1])) {
            // URL da página
            $url = 'https://www.receiteria.com.br/imprimir/?id=' . $matches[1] . '';

            // Obtém o conteúdo da página
            $html = file_get_contents($url);

            // Define o padrão de início e fim
            $pattern_start = '/<p><i class="fa-solid fa-clock">/';
            $pattern_end = '/<hr>/';
            
            // Substitui as ocorrências de 'www.receiteria.com.br' por 'gean.me'
            $html = str_replace('www.receiteria.com.br', 'gean.me', $html);
            $html = str_replace('youtube.com', 'gean.me', $html);
            $html = str_replace('input class="form-check-input" type="checkbox" value ', '', $html);
            $html = str_replace('"><label for="ingrediente-', '', $html);
            $html = str_replace('</label>', '', $html);
            $html = str_replace('fa-solid fa-bread-slice', 'fa-solid fa-utensils', $html);

            // Procura pelo padrão de início
            if (preg_match($pattern_start, $html, $start_match, PREG_OFFSET_CAPTURE)) {
                // Procura pelo padrão de fim
                if (preg_match($pattern_end, $html, $end_match, PREG_OFFSET_CAPTURE, $start_match[0][1])) {
                    // Extrai o conteúdo entre os padrões de início e fim
                    $content = substr($html, $start_match[0][1], $end_match[0][1] - $start_match[0][1]);
                    
                    // Exibe o conteúdo
                    // echo $content;
                //} else {
                    // Se não encontrar o padrão de fim, exibe uma mensagem de erro
                   // echo "Padrão de fim não encontrado.";
                }
            //} else {
                // Se não encontrar o padrão de início, exibe uma mensagem de erro
                //echo "Padrão de início não encontrado.";
            }
        }
    }
?>

<?php
// Obtém a data atual no formato desejado
$DateDia = date("Y-m-d");

// Exibe a data atual
// echo $DateDia;
?><!DOCTYPE html>
<html lang="pt-br">
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <title><?php echo $data['title']; ?> - Gean Ramos</title>
  <meta name="description" content="<?php echo $data['title']; ?> - <?php echo $data['description']; ?>">
  <!-- : Saboroso, nutritivo e fácil de fazer! Experimente essa receita rápida e perfeita para o dia a dia -->

    <!--inicio dos cards-->
    <link rel="canonical" href="https://gean.me/receita/<?php echo $name; ?>/" />
    <meta property="og:locale" content="pt_BR" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?php echo $data['title']; ?> | Gean Ramos" />
    <meta property="og:description" content="<?php echo $data['description']; ?>" />
    <meta property="og:url" content="https://gean.me/receita/<?php echo $name; ?>/" />
    <meta property="og:site_name" content="GeanRamos" />
	<meta property="article:published_time" content="<?php echo $DateDia; ?>T00:10:34+00:00" />
	<meta property="article:modified_time" content="<?php echo $DateDia; ?>T02:35:49+00:00" />
    <meta property="og:image" content="https://i3.wp.com/www.receiteria.com.br/wp-content/uploads/<?php echo $imgName; ?>?resize=760,427" />
    <meta property="og:image:width" content="760" />
    <meta property="og:image:height" content="427" />
    <meta property="fb:pages" content="312914505389872">
	
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="<?php echo $data['title']; ?> | Gean Ramos" />
    <meta name="twitter:description" content="<?php echo $data['description']; ?>" />
    <meta name="twitter:image" content="https://i3.wp.com/www.receiteria.com.br/wp-content/uploads/<?php echo $imgName; ?>?resize=760,427" />
    <meta name="twitter:site" content="@geanramos">
    <!--fim dos card-->

	    <script type="application/ld+json">
	{
		"@context": "http://schema.org/",
		"@type": "Recipe",
		"name": "<?php echo $data['title']; ?> | Gean Ramos",
		"url": "https://gean.me/receita/<?php echo $name; ?>/",
		"image": {
			"@context": "http://schema.org",
			"@type": "ImageObject",
			"url": "https://i3.wp.com/www.receiteria.com.br/wp-content/uploads/<?php echo $imgName; ?>?resize=760,427"
			},
		"author": {
			"@context": "http://schema.org",
			"@type": "Organization",
			"name": "Gean Ramos"
			},
		"datePublished": "<?php echo $DateDia; ?>T00:10:34+00:00",
		"description": "<?php echo $data['description']; ?>",
		"aggregateRating":{
			"@type": "AggregateRating",
			"reviewCount": "105",
			"ratingValue": "4.9",
			"ratingCount": "489",
			"bestRating": 5,
			"worstRating": 1
			},
			"keywords": "<?php echo $data['title']; ?>",
			"totalTime": "PT57M",
	}
	</script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/geanramos/files/receita.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
</head>
<body>
 <section data-bs-version="5.1" class="menu menu4 cid-u7Yn178pEI" once="menu" id="menu04-0">
  <nav class="navbar navbar-dropdown navbar-expand-lg">
   <div class="container">
    <div class="navbar-brand">
     <span class="navbar-logo">
      <a href="../../receita.html">
       <img src="https://cdn.jsdelivr.net/gh/geanramos/files/Qt9Ceky.png" alt="Fogo na Cozinha" style="height: 4.1rem;" />
      </a>
     </span>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-toggle="collapse" data-target="#navbarSupportedContent" data-bs-target="#navbarSupportedContent" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation" > <div class="hamburger"> <span></span> <span></span> <span></span> <span></span> </div> </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
      <li class="nav-item">
       <a class="nav-link link text-black display-4" href="#gallery06-b">Sobre</a>
      </li>
      <li class="nav-item">
       <a class="nav-link link text-black show display-4" href="../../receita.html" aria-expanded="false">Receitas</a>
      </li>
      <li class="nav-item">
       <a class="nav-link link text-black display-4" href="https://pay.hotmart.com/W91098666M?checkoutMode=10&sck=gean|receita|navlink|<?php echo $matches[1]; ?>">E-books</a>
      </li>
     </ul>

     <div class="navbar-buttons mbr-section-btn">
      <a class="btn btn-primary display-4" href="https://pay.hotmart.com/W91098666M?checkoutMode=10&sck=gean|receita|navbarbuttons|<?php echo $matches[1]; ?>">E-book Grátis <i class="fa-solid fa-angles-right"></i></a>
     </div>
    </div>
   </div>
  </nav>
 </section>

 <section data-bs-version="5.1" class="header12 cid-u7Ynn6iEAG" id="header12-2">
  <div class="text-center container">
   <div class="row mb-4 justify-content-center">
    <div class="col-12 col-md-8">
     <img class="w-100" src="https://images.weserv.nl/?w=760&h=427&output=webp&q=80&t=square&url=https://gean.me/wp-content/uploads/<?php echo $imgName; ?>" alt="<?php echo $data['title']; ?>" />
    </div>
   </div>
   <div class="row justify-content-center">
    <div class="col-md-12 content-head">
     <h1 class="mbr-section-title mbr-fonts-style mb-4 display-1">
      <strong><?php echo $data['title']; ?></strong>
     </h1>
     <p class="mbr-text mbr-fonts-style mb-4 display-7">
      <?php echo $data['description']; ?>
     </p>
    </div>
   </div>
  </div>
 </section>

 <section data-bs-version="5.1" class="news09 startm5 cid-u7Yo6xv10c" id="news09-6">
  <div class="container-fluid">
   <div class="row justify-content-center">
    <div class="col-12 col-lg-8">
     <div class="item features-without-image col-12 active">
      <div class="item-wrapper">
       <div id="content-24-03-31" align="left">
        <?php echo $content; ?>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
 </section>

 <section data-bs-version="5.1" class="gallery06 cid-u89qxzz3kk" id="gallery06-b">
  <div class="container">
   <div class="row justify-content-center">
    <div class="col-12 content-head">
     <div class="mbr-section-head mb-5">
      <h4 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2"><strong>Outras receitas</strong></h4>
     </div>
    </div>
   </div>
   <div class="row">
    <?php

// Verificando se o parâmetro ?url= foi passado na URL
if (isset($_GET['url'])) {
    // Obtendo o valor do parâmetro ?url=
    $url = $_GET['url'];
    
    // URL da página com o parâmetro ?url=
    $url = "https://gean.me/code/relacionadas.php?p=" . urlencode($url);

    // Obtendo o conteúdo da página
    $html = file_get_contents($url);

    // Exibindo o conteúdo
    echo $html;
} else {
    echo "OPS!";
}

?>
   </div>
  </div>
 </section>

 <section data-bs-version="5.1" class="footer3 cid-u7Yn8v9uzV" once="footers" id="footer03-1">
  <div class="container">
   <div class="row">
    <div class="row-links">
     <ul class="header-menu">
      <li class="header-menu-item mbr-fonts-style display-5"><a href="#top" class="text-primary">Sobre</a></li>
      <li class="header-menu-item mbr-fonts-style display-5"><a href="../../receita.html" class="text-primary">Receitas</a></li>
      <li class="header-menu-item mbr-fonts-style display-5"><a href="https://pay.hotmart.com/W91098666M?checkoutMode=10&sck=gean|receita|headermenu|<?php echo $matches[1]; ?>" class="text-primary">E-books</a></li>
     </ul>
    </div>

    <div class="col-12 mt-4">
     <div class="social-row">
      <div class="soc-item">
       <a href="https://www.facebook.com/sharer/sharer.php?u=https://gean.me/receita/<?php echo $name; ?>/?utm_source=facebook&linkname=<?php echo $data['title']; ?>&linknote=<?php echo $data['description']; ?>" target="_blank">
        <span class="mbr-iconfont socicon"><i class="fa-brands fa-facebook-f"></i></span>
       </a>
      </div>
      <div class="soc-item">
       <a href="https://twitter.com/intent/tweet?url=https://gean.me/receita/<?php echo $name; ?>/?utm_source=twitter&via=geanramos&text=<?php echo $data['description']; ?>" target="_blank">
        <span class="mbr-iconfont socicon"><i class="fa-brands fa-twitter"></i></span>
       </a>
      </div>
      <div class="soc-item">
       <a
        href="https://pinterest.com/pin/create/button/?url=https://gean.me/receita/<?php echo $name; ?>/?utm_source=pinterest&description=<?php echo $data['description']; ?>&media=https://i1.wp.com/www.receiteria.com.br/wp-content/uploads/<?php echo $imgName; ?>?resize=1000,1500"
        target="_blank"
       >
        <span class="mbr-iconfont socicon"><i class="fa-brands fa-pinterest-p"></i></span>
       </a>
      </div>
      <div class="soc-item">
       <a href="https://api.whatsapp.com/send?text=<?php echo $data['description']; ?> https://gean.me/receita/<?php echo $name; ?>/?utm_source=whatsapp" target="_blank">
        <span class="mbr-iconfont socicon"><i class="fa-brands fa-whatsapp"></i></span>
       </a>
      </div>
     </div>
    </div>
    <div class="col-12 mt-5">
     <p class="mbr-fonts-style copyright display-7">
      ©&nbsp; 2004 - 2024 - Gean Ramos
     </p>
    </div>
   </div>
  </div>
 </section>
 <script src="https://geanramos.com/file/bootstrap/js/bootstrap.bundle.min.js?v=24-03-26-1815"></script>
 <script src="https://geanramos.com/file/smoothscroll/smooth-scroll.js?v=24-03-26-1815"></script>
 <script src="https://geanramos.com/file/ytplayer/index.js?v=24-03-26-1815"></script>
 <script src="https://geanramos.com/file/dropdown/js/navbar-dropdown.js?v=24-03-26-1815"></script>
 <script src="https://geanramos.com/file/theme/js/script.js?v=24-03-26-1815"></script>
 <script src="https://cdn.jsdelivr.net/gh/geanramos/files/home-assets/puritym/js/page.js"></script>
 <input name="animation" type="hidden" />
 <!-- AddToAny BEGIN -->
 <div class="a2a_kit a2a_kit_size_32 a2a_floating_style a2a_vertical_style" style="right: 20px; top: 120px;">
  <!--<a class="a2a_dd" href="https://www.addtoany.com/share"></a> | //static.addtoany.com/menu/page.js-->
  <a class="a2a_button_whatsapp"></a>
  <a class="a2a_button_facebook"></a>
  <a class="a2a_button_twitter"></a>
  <a class="a2a_button_pinterest"></a>
 </div>
 <!-- AddToAny END -->
</body>
</html>
