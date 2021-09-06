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
    <title>Catalogue</title>
    <meta name="viewport" content="width-device-widht, initial-scale=1.0" />
    <?php
    $articles = $bdd->query('SELECT * FROM livre ORDER BY ID_Livre ASC');
    if (isset($_GET['g']) and !empty($_GET['g'])) {
        $g = htmlspecialchars($_GET['g']);
        $articles = $bdd->query('SELECT * FROM livre WHERE categorie LIKE "%' . $g . '%" ORDER BY ID_Livre ASC');
    }
    $item_id = $articles->rowcount();

    ?>
    <?php
//début barre de recherche ici
    if (isset($_GET['q']) and !empty($_GET['q'])) {
        $q = htmlspecialchars($_GET['q']);
        $articles = $bdd->query('SELECT * FROM livre WHERE Titre LIKE "%' . $q . '%" ORDER BY ID_Livre ASC');

        if ($articles->rowCount() == 0) {
            $articles = $bdd->query('SELECT * FROM Livre WHERE CONCAT(Titre,  Quantite) LIKE "%' . $q . '%" ORDER BY ID_Livre ASC');
        }
    }
    $item_id = $articles->rowcount();
    //fin barre de recherche ici
    ?>
    
    <!--FONT AWESOME-->

    <script src="https://kit.fontawesome.com/0c87a70838.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300i,400" rel="stylesheet">

    <!--FONT CSS-->



    <!--CUSTOM CSS-->
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="style/style_catalogue.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/navbar_resize.css">

    <!--JS SCRIPT-->

    <script src="js/script.js"></script>

</head>

<body>

    <!-- NAVBAR -->
    <?php include("piece_design/menu.php"); ?>
    <?php include("piece_design/navbar_resize.php"); ?>


    <!-- SECTION 1 -->
    <?php
// générer les cellule de 4 cases, (/4 = 3 container + 1 au cas ou si c'est 13 éviter d'avoir un nombre à vergule pour rajouter un contaioner pour la carte qui reste).
// on va sortir de la boucle quand on aura mit les 4 cartes
// fetch permet de mettre les articles dans un tableau (pour donner le titre du livre actuel par exemple si on fait $a['Titre'])
// rowcount permet de compter combien y'a d'article dans la bdd
//
    if ($articles->rowCount() > 0) { ?>
        <?php $xroam = 1;
        while ($xroam <= ($item_id / 4 + 1)) { ?>
            <div class="sec1">
                <div class="container">
                    <?php
                    $Zroam = 0;
                    while (($Zroam < 4) && ($a = $articles->fetch())) { ?>
                        <?php if ($a['Quantite'] > 0) { ?>
                            <div class="card">
                                <h3 class="title"><?php echo $a['Titre']; ?></h3>
                                <a href="PageLivre.php?id=<?php echo $a['ID_Livre']; ?>" class="title_buy"><img class="img" src="<?php echo $a['Image']; ?>" alt=""></a>
                                <a href="PageLivre.php?id=<?php echo $a['ID_Livre']; ?>" class="title_buy">J'achete</a>
                            </div>
                    <?php
                            $Zroam++;
                        }
                    }
                    ?>
                </div>
            </div>
        <?php
            $xroam = $xroam + 1;
        } ?>
    <?php }
    ?>

    <!-- FOOTER-->
    <?php include("piece_design/footer.php"); ?>


    <!-- SECTION 3 -->

    <!-- SECTION 4 -->

</body>

</html>