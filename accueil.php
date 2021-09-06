<?php
    $host_name = 'db5003396802.hosting-data.io';
    $database = 'dbs2753258';
    $user_name = 'dbu2580113';
    $password = 'Bookybdd123$';
    $dbh = null;

  try {
    $bdd = new PDO("mysql:host=$host_name; dbname=$database;", $user_name, $password);
  } catch (PDOException $e) {
    echo "Erreur!: " . $e->getMessage() . "<br/>";
    die();
  }
session_start(); ?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Index</title>
    <meta name="viewport" content="width-device-widht, initial-scale=1.0" />

    <!--FONT AWESOME-->

    <!--FONT CSS-->



    <!--CUSTOM CSS-->
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="style/style_index.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/navbar_resize.css">
    

    <!--JS SCRIPT-->

    <script src="script.js"></script>

</head>

<body>

    <!-- NAVBAR -->
    <?php include("piece_design/menu.php"); ?>
    <?php include("piece_design/navbar_resize.php"); ?>
    
    <!-- SECTION 1 -->
    <div class="slider">
        <input type="radio" name="slider" title="slide1" checked="checked" class="slider__nav" />
        <input type="radio" name="slider" title="slide2" class="slider__nav" />
        <input type="radio" name="slider" title="slide3" class="slider__nav" />
        <input type="radio" name="slider" title="slide4" class="slider__nav" />
        <div class="slider__inner">
            <div class="slider__contents"><img src="images/3.jpg">
                <h2 class="slider__caption">Découverte</h2>
                <p class="slider__txt">Découvrez de nouveaux livres, de nouvelles séries à des prix attractifs !</p>
            </div>
            <div class="slider__contents"><img src="images/2.jpg">
                <h2 class="slider__caption">Nouveauté</h2>
                <p class="slider__txt">Lorem ipsum dolor sit amet, consectetur adipisicing elit. At cupiditate omnis possimus illo quos, corporis minima!</p>
            </div>
            <div class="slider__contents"><img src="images/4.jpg">
                <h2 class="slider__caption">Numérique</h2>
                <p class="slider__txt">Lorem ipsum dolor sit amet, consectetur adipisicing elit. At cupiditate omnis possimus illo quos, corporis minima!</p>
            </div>
            <div class="slider__contents"><img src="images/6.jpg">
                <h2 class="slider__caption">Qualitatifs</h2>
                <p class="slider__txt">Lorem ipsum dolor sit amet, consectetur adipisicing elit. At cupiditate omnis possimus illo quos, corporis minima!</p>
            </div>
        </div>
    </div>

    <!-- FOOTER-->
    <?php include("piece_design/footer.php"); ?>


    <!-- SECTION 3 -->

    <!-- SECTION 4 -->

</body>

</html>