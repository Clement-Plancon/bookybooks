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
<?php if (isset($_SESSION['id'])) {?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Panier</title>
    <meta name="viewport" content="width-device-widht, initial-scale=1.0" />

    <!--FONT AWESOME-->

    <script src="https://kit.fontawesome.com/0c87a70838.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300i,400" rel="stylesheet">

    <!--FONT CSS-->



    <!--CUSTOM CSS-->
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="style/style_panier.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/navbar_resize.css">

    <!--JS SCRIPT-->

    <script src="js/script.js"></script>

</head>

<body>




<!--validation d'achat-->
<?php if (isset($_POST['Achat'])) { 
        header("Location: panier.php");
        $rose = $bdd->prepare('SELECT * FROM paniers WHERE ID_Users = ?');
        $rose->execute(array($idsess));

        while ($donnees = $rose->fetch()) {
            $IDlivre = intval($donnees['ID_Livre']);
            $titre = htmlspecialchars($donnees['Panier_Titre']);
            $prix = htmlspecialchars($donnees['Prix_livre']);
           
            $insertachat = $bdd->prepare("INSERT INTO factures(Achat_Livre, Achat_Users, facture_titre, facture_prix) VALUES(?, ?, ?, ?)");
            $insertachat->execute(array($IDlivre , $idsess, $titre, $prix));
            
            $supp = $bdd->prepare('DELETE FROM paniers WHERE ID_Users = ?');
            $supp->execute(array($idsess));
        }
    }
    ?>



<?php


if (isset($_POST['AaA'])) {
    header("Location: panier.php");
    $rose = $bdd->prepare('SELECT * FROM paniers WHERE ID_Users = ?');
    $rose->execute(array($idsess));

    while ($donnees = $rose->fetch()) {

        $getIDLIVRE = $donnees['ID_Livre'];
        $Livre = $bdd->prepare('SELECT * FROM livre WHERE ID_Livre = ?');
        $Livre->execute(array($getIDLIVRE));
        $livretitre = $Livre->fetch();

        echo $livretitre['Quantite'];
        $quantite = $livretitre['Quantite'];
        $req = $bdd->prepare('UPDATE livre SET Quantite = :nvqqt WHERE ID_Livre = :nom_jeu');
        $req->execute(array(
            'nvqqt' => $quantite + 1,
            'nom_jeu' => $getIDLIVRE
        ));
    }
    $supp = $bdd->prepare('DELETE FROM paniers WHERE ID_Users = ?');
    $supp->execute(array($idsess));
}
?>

    <!-- NAVBAR -->
    <?php include("piece_design/menu.php"); ?>
    <?php include("piece_design/navbar_resize.php"); ?>

    <!-- SECTION 1 -->

    
    <?php

    $idsess = $_SESSION['id'];
    //debut de la refonte !!!!
    //nombre de produit achté plus la carte
    $prix_total = 0;
    $nouveau_livre = $bdd->prepare('SELECT  distinct ID_Livre FROM paniers where ID_Users = ?');
    $nouveau_livre->execute(array($idsess));

    while ($tableau_livre = $nouveau_livre->fetch()) {
        $nombrelivre = $bdd->prepare('SELECT * FROM paniers where ID_Livre = ? AND ID_Users = ?');
        $nombrelivre->execute(array($tableau_livre['ID_Livre'], $idsess));
        $item_nmb = $nombrelivre->rowcount();
        $Livre = $bdd->prepare('SELECT * FROM livre WHERE ID_Livre = ?');
        $Livre->execute(array($tableau_livre['ID_Livre']));
        $livretitre = $Livre->fetch();

        //la carte broken 
    ?>

        <div class="sec1">
            <div class="container">
                <div class="card_left">
                    <h2>quantité</h2>
                    <div class="title_quantity">
                        <?php echo $item_nmb . "X"; ?>
                    </div>
                </div>
                <div class="card_container">
                    <div class="card">
                        <h3 class="title"><?php echo $livretitre['Titre']; ?></h3>
                        <img class="img" src="<?php echo $livretitre['Image']; ?>" alt="">
                        <a href="PageLivre.php?id=<?php echo $livretitre['ID_Livre']; ?>" class="title_buy">J'achete</a>
                    </div>
                </div>
                <div class="card_right">
                    <h2>total</h2>
                    <div class="title_price">
                        <?php echo $livretitre['Prix'] * $item_nmb . "€"; ?>
                    </div>
                </div>
            </div>
        </div>

    <?php
    }
    //affichage du prix totales des livres
    $reponse = $bdd->prepare('SELECT * FROM paniers WHERE ID_Users = ?');
    $reponse->execute(array($idsess));
    $prixslt = 0;
    while ($donnees = $reponse->fetch()) {
        $prixslt = $donnees['Prix_livre'] + $prixslt;
    }
    ?>

    <div class="sec2">
        <div class="sec2_container">
            <div class="sec2_text">
                <?php echo "Prix total </br> " . $prixslt . "€"; // message du prix du panier 
                ?>
            </div>
        </div>
    </div>


    <?php
    //fin de refonte !!!!!!!!!!!!!!!!!!


    //suppression + remise en stock des item de la bdd.
    if (isset($_POST['AaA'])) {
        header("Location: panier.php");
        $rose = $bdd->prepare('SELECT * FROM paniers WHERE ID_Users = ?');
        $rose->execute(array($idsess));

        while ($donnees = $rose->fetch()) {

            $getIDLIVRE = $donnees['ID_Livre'];
            $Livre = $bdd->prepare('SELECT * FROM livre WHERE ID_Livre = ?');
            $Livre->execute(array($getIDLIVRE));
            $livretitre = $Livre->fetch();

            echo $livretitre['Quantite'];
            $quantite = $livretitre['Quantite'];
            $req = $bdd->prepare('UPDATE livre SET Quantite = :nvqqt WHERE ID_Livre = :nom_jeu');
            $req->execute(array(
                'nvqqt' => $quantite + 1,
                'nom_jeu' => $getIDLIVRE
            ));
        }
        $supp = $bdd->prepare('DELETE FROM paniers WHERE ID_Users = ?');
        $supp->execute(array($idsess));
    }
    ?>

    <!--validation d'achat-->
    <?php if (isset($_POST['Achat'])) {
        header("Location: panier.php");
        $rose = $bdd->prepare('SELECT * FROM paniers WHERE ID_Users = ?');
        $rose->execute(array($idsess));

        while ($donnees = $rose->fetch()) {
            $IDlivre = intval($donnees['ID_Livre']);
            $titre = htmlspecialchars($donnees['Panier_Titre']);
            $prix = htmlspecialchars($donnees['Prix_livre']);
           
            $insertachat = $bdd->prepare("INSERT INTO factures(Achat_Livre, Achat_Users, facture_titre, facture_prix) VALUES(?, ?, ?, ?)");
            $insertachat->execute(array($IDlivre , $idsess, $titre, $prix));
            
            $supp = $bdd->prepare('DELETE FROM paniers WHERE ID_Users = ?');
            $supp->execute(array($idsess));
        }
    }
    ?>

    <div class="container_trash">
        <form method="POST" action="">
            <input type="submit" name="Achat" value="Acheter" class="button_trash" />
            <br />
        </form>
    </div>
    <div class="container_trash">
        <form method="POST" action="panier.php">
            <input type="submit" name="AaA" value="vider le panier" class="button_trash" />
            <br /><br />
        </form>
    </div>

    <!-- FOOTER-->
    <?php include("piece_design/footer.php"); ?>

</body>
<?php
} else {
   header("Location: conn2.php");
}
?>
</html>