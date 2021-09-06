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
    <meta charset="utf-8">
    <title>Index</title>
    <meta name="viewport" content="width-device-widht, initial-scale=1.0" />

    <!--FONT AWESOME-->

    <!--FONT CSS-->


    <!--CUSTOM CSS-->
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="style/footer.css">
    <link rel="stylesheet" href="style/navbar_resize.css">
    <link rel="stylesheet" href="Note.css">


    <!--JS SCRIPT-->

    <script src="script.js"></script>

    <!-- le php-->
    <?php $cherche = $bdd->prepare("SELECT users.pseudo,note.Etoile,note.Com,livre.Titre FROM users Inner JOIN note on users.id =note.ID_Users Inner JOIN livre on livre.ID_Livre =note.ID_Livre where livre.ID_Livre= ? ");
    $cherche->execute(array($_SESSION['ID_Livre']));






    ?>
    <?php if (isset($_POST['formnote'])) {


        if (isset($_SESSION['pseudo'])) {
            $note = htmlspecialchars($_POST['select']);
            $text = htmlspecialchars($_POST['aa']);
            $id_Users = $_SESSION['id'];
            $id_Livre = $_SESSION['ID_Livre'];

            if (($note != null) && ($text != null) && ($id_Users != null) && ($id_Livre != null)) {
                $insertavi = $bdd->prepare("INSERT INTO note(ID_Livre, ID_Users, Etoile, Com) VALUES(?, ?, ?, ?)");
                $insertavi->execute(array($id_Livre, $id_Users, $note, $text));
                header('Location: Note.php');
            }
        } else {
            header('Location: conn2.php');
        }
    }
    ?>
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
                    <h2> Donner votre avis :</h2><br>
                    <form method="POST" action="">
                        <h3> note : <select name="select">
                                <option value="1">1/5</option>
                                <option value="2">2/5</option>
                                <option value="3">3/5</option>
                                <option value="4">4/5</option>
                                <option value="5" selected>5/5</option>
                            </select></h3>
                        <textarea type="text" placeholder="texte" name="aa"></textarea>

                        <input class="jvl" type="submit" name="formnote" value="Donner son avis" />
                    </form>
                </div>
                
                <div class="container_right_com">
                
                    <div class="container_com">
                    <h2> Avis des lecteurs:</h2>
                        <?php
                        while ($a = $cherche->fetch()) {

                        ?>
                            <div class="container_commentary_all">
                                <div class="container_com_note">
                                    <div class="com_block">
                                        <?php

                                        echo "commentaire de " . $a['pseudo'];
                                        ?>
                                    </div>
                                    <div class="etoile_block">
                                        <?php
                                        echo "note: " . $a['Etoile'];
                                        ?>

                                    </div>
                                </div>
                                <div class="container_corps">
                                    <?php
                                    echo $a['Com'];
                                    ?>
                                </div>
                            </div>

                        <?php
                        }
                        ?>
                    </div>

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