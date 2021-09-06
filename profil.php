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

<head>
<?php if (isset($_SESSION['id'])) {?>
    <meta charset="utf-8">
    <title>Index</title>
    <meta name="viewport" content="width-device-widht, initial-scale=1.0" />

    <!--FONT AWESOME-->

    <!--FONT CSS-->

    <!--LE PHP CACA--->


        <?php

        $getid = intval($_SESSION['id']);
        $requser = $bdd->prepare('SELECT * FROM users WHERE id = ?');
        $requser->execute(array($getid));
        $userinfo = $requser->fetch();

        if (isset($_POST['supp'])) {
            header("Location: profil.php");
            $getid = intval($_SESSION['id']);
            $requser = $bdd->prepare('DELETE FROM factures WHERE Achat_Users = ?');
            $requser->execute(array($getid));
        }


        ?>

        <!--CUSTOM CSS-->
        <link rel="stylesheet" href="style/navbar.css">
        <link rel="stylesheet" href="style/profil.css">
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
    <div class="sec1">
        <div class="container">
            <div class="card">
                <div class="container_left_up">
                    <div class="form_container">
                        <?php
                        if (isset($_SESSION['id']) and $userinfo['id'] == $_SESSION['id']) {
                        ?>
                            <a href="index.php">menu principale</a></br>
                            <a href="persona.php">Editer mon profil</a></br>
                            <a href="deco.php">Se déconnecter</a>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="container_left">
                        <h2>Profil de <?php echo $userinfo['pseudo']; ?></h2>
                        <br /><br />
                        Pseudo = <?php echo $userinfo['pseudo']; ?>
                        <br /><br>

                        Email : <?php echo $userinfo['mail']; ?>
                        <br /><br>
                        Adresse :
                        <?php if ($userinfo['adresse'] == NULL) {
                            echo "Aucune adresse enregistré";
                        } else {
                            echo $userinfo['adresse'] . " " . $userinfo['Ville'];
                        } ?>
                        <br><br>
                        Ville :
                        <?php if ($userinfo['Ville'] == NULL) {
                            echo "Aucun pays enregistré";
                        } else {
                            echo $userinfo['Ville'];
                        } ?>
                        <br><br>
                        Numero de téléphone :<br>
                        <?php if ($userinfo['Telephone'] == NULL) {
                            echo "Aucun numero de telephone enregistré";
                        } else {
                            echo $userinfo['Telephone'];
                        } ?>
                        <br><br><br><br><br><br>

                    </div>

                </div>
                <div class="container_right">
                    <h2>historique des achats :</h2>
                    <div class="div1">

                        <div class="div2">

                            <p class="texte0">

                                <?php $reponse = $bdd->prepare('SELECT * FROM factures WHERE Achat_Users = ?');
                                $reponse->execute(array($_SESSION['id']));
                                while ($donnees = $reponse->fetch()) {
                                    echo $donnees['facture_titre'] . " : " . $donnees['facture_prix'] . "€"; ?>
                                    <br>
                                <?php
                                } ?>

                        </div>

                    </div>
                    <form method="POST" action="">
                     <input type="submit" name=supp value="supprimer L'historique" />
                  </form>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER-->
    <div class=espace></div>



    <!-- SECTION 3 -->

    <!-- SECTION 4 -->

</body>
<?php
} else {
   header("Location: conn2.php");
}
?>
</html>