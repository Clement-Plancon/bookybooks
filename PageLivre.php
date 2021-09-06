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
<link rel="stylesheet" href="toastB.css">

<?php

if(isset($_SESSION['pseudo'])) {
    ?>
<div id="toast"></div>
<?php

}
?>
<script>


function showToast(text){
  var x=document.getElementById("toast");
  x.classList.add("show");
  x.innerHTML=text;
  setTimeout(function(){
    x.classList.remove("show");
  },3000);
}

</script>
<head>
    <meta charset="utf-8">
    <title>Index</title>
    <meta name="viewport" content="width-device-widht, initial-scale=1.0" />

    <!--FONT AWESOME-->

    <!--FONT CSS-->

    <!--LE PHP CACA--->
    <?php
//On compte les notes par rapport aux nombre d'avis
    $cacao = "";
    $moyen = $bdd->prepare('SELECT Etoile FROM note WHERE ID_Livre = ?');
    $moyen->execute(array($_GET['id']));
    $nombrenote = $moyen->rowcount();
    $addition = 0;
    while ($z = $moyen->fetch()) {
        $addition = $addition + $z['Etoile'];
    }
    if ($nombrenote != 0 && $nombrenote != null) {
        $Karthus = $addition / $nombrenote;
    }
//ici on vérifie qu'il y a un id dans la barre de recherche renvoyé par la méthode GET sinon on renvoi sur la page catalogue (pour éviter de rentrer n'importe quoi)
    if (isset($_GET['id']) and $_GET['id'] > 0) {

        $Livre = $bdd->prepare('SELECT * FROM livre WHERE ID_Livre = ?');
        $Livre->execute(array($_GET['id']));
        $check = $Livre->fetch();
        if ($check['Titre'] == null) {
            header('Location: catalogue.php');
        }

        $getid = intval($_GET['id']);
    } else {
        header('Location: catalogue.php');
    }
    $_SESSION['ID_Livre'] = $_GET['id'];
    $getIDLIVRE = $getid;
    $Livre = $bdd->prepare('SELECT * FROM livre WHERE ID_Livre = ?');
    $Livre->execute(array($getIDLIVRE));
    $livretitre = $Livre->fetch();
//Ici c'est le formulaire, on renvoi "AA" grace à la méthode POST et on va vérifier si la quantité est suffisante, si la personne n'est pas connecté, on va renvoyer vers la page connexion
    if (isset($_POST['AA'])) {
        if (isset($_SESSION['pseudo'])) {
            
            if ($_POST['nombre'] <= $livretitre['Quantite']) {
                
                
                $nombre = htmlspecialchars($_POST['nombre']);
                $idlivre = $livretitre['ID_Livre'];
                $prix = $livretitre['Prix'];
                $titre = $livretitre['Titre'];
                $quantite = $livretitre['Quantite'];
                $iduser = $_SESSION['id'];
                $req = $bdd->prepare('UPDATE livre SET Quantite = :nvqqt WHERE ID_Livre = :nom_jeu');
                $req->execute(array(
                    'nvqqt' => $quantite - $nombre,
                    'nom_jeu' => $idlivre

                ));
                $Variable = 1;
                while ($Variable <= $nombre) {
                    $insertmbr = $bdd->prepare("INSERT INTO paniers(ID_Livre, ID_Users, Prix_livre, Panier_Titre) VALUES(?, ?, ?, ?)");
                    $insertmbr->execute(array($idlivre, $iduser, $prix, $titre));
                    $Variable = $Variable + 1;  
                }
                sleep(1.5);
                header('Location: catalogue.php');
            } else {
                $cacao = " Pas de quantité disponible !";
            }
        } else {
            header('Location: conn2.php');
        }
    } ?>

    <!--CUSTOM CSS-->
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="style/style_pagelivre.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/navbar_resize.css">
    <link rel="stylesheet" href="toastB.css">

    <!--JS SCRIPT-->
    <script src="toat.js"></script>
    <script src="script.js"></script>

</head>

<body>

    <!-- NAVBAR -->
    <?php include("piece_design/menu.php"); ?>
    <?php include("piece_design/navbar_resize.php"); ?>

    <!-- SECTION 1 -->
    <div class="sec1">
        <div class="container">
            <div class="card">
                <div class="container_left_up">
                    <div class="form_container">
                        <form method="POST" onsubmit="showToast('Ajouté au panier')" action="">
                            <label for="tentacles" class="quantity">Quantité:</label>
                            <input type="number" id="nombre" name="nombre" value="1" min="1" max="10" >
                            <br /><br />
                            <input type="submit" name="AA"  value="Ajouter au paniex  !" />
                            <br /><br />
                        </form>
                    </div>
                    <div class="container_left">
                        <h2 class="title"><?php echo $livretitre['Titre']; ?></h2>
                        <div class="container_info">
                            <h2 class="title_info">Quantité disponible : <?php echo $livretitre['Quantite']; ?></h2>
                            <img class="img" src="<?php echo $livretitre['Image']; ?>" alt="">
                            <h2 class="title_info">Prix : <?php echo $livretitre['Prix']; ?></h2>
                        </div>
                        <?php if ($cacao != "") {
                            echo  $cacao;
                        }
                        ?>
                    </div>
                </div>
                       
                <div class="container_right">
                    <?php if ($nombrenote != 0 && $nombrenote != null) { ?>
                        <p> Note des utilisateurs : <?php echo number_format($Karthus, 1, ',', ' '); ?>/5 <a href="Note.php">voir les avis</a></p>
                    <?php
                    } else { ?>
                        <p><a href="Note.php">ajouter un avis</a></p>
                    <?php } ?>
                    <br>
                    <p> Description : </br> <?php echo $livretitre['Resumer'] ?> </p>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER-->

    <?php include("piece_design/footer.php"); ?>



    <!-- SECTION 3 -->

    <!-- SECTION 4 -->

</body>

</html>