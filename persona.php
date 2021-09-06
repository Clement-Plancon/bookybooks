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
<?php

if (isset($_SESSION['id'])) {
   $requser = $bdd->prepare("SELECT * FROM users WHERE id = ?");
   $requser->execute(array($_SESSION['id']));
   $user = $requser->fetch();
   if (isset($_POST['newpseudo']) and !empty($_POST['newpseudo']) and $_POST['newpseudo'] != $user['pseudo']) {
      $newpseudo = htmlspecialchars($_POST['newpseudo']);
      $insertpseudo = $bdd->prepare("UPDATE users SET pseudo = ? WHERE id = ?");
      $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
      header('Location: profil.php?id=' . $_SESSION['id']);
   }
   if (isset($_POST['newadresse']) and !empty($_POST['newadresse']) and $_POST['newadresse'] != $user['adresse']) {
      $newadresse = htmlspecialchars($_POST['newadresse']);
      $insertpseudo = $bdd->prepare("UPDATE users SET adresse = ? WHERE id = ?");
      $insertpseudo->execute(array($newadresse, $_SESSION['id']));
      header('Location: profil.php');
   }
   if (isset($_POST['newville']) and !empty($_POST['newville']) and $_POST['newville'] != $user['Ville']) {
      $newville = htmlspecialchars($_POST['newville']);
      $insertpseudo = $bdd->prepare("UPDATE users SET Ville = ? WHERE id = ?");
      $insertpseudo->execute(array($newville, $_SESSION['id']));
      header('Location: profil.php');
   }
   if (isset($_POST['newTelephone']) and !empty($_POST['newTelephone']) and $_POST['newTelephone'] != $user['Telephone']) {
      $newTelephone = htmlspecialchars($_POST['newTelephone']);
      $insertpseudo = $bdd->prepare("UPDATE users SET Telephone = ? WHERE id = ?");
      $insertpseudo->execute(array($newTelephone, $_SESSION['id']));
      header('Location: profil.php');
   }
   if (isset($_POST['newmail']) and !empty($_POST['newmail']) and $_POST['newmail'] != $user['mail']) {
      $newmail = htmlspecialchars($_POST['newmail']);
      $insertmail = $bdd->prepare("UPDATE users SET mail = ? WHERE id = ?");
      $insertmail->execute(array($newmail, $_SESSION['id']));
      header('Location: profil.php?id=' . $_SESSION['id']);
   }
   if (isset($_POST['newmdp1']) and !empty($_POST['newmdp1']) and isset($_POST['newmdp2']) and !empty($_POST['newmdp2'])) {
      $mdp1 = sha1($_POST['newmdp1']);
      $mdp2 = sha1($_POST['newmdp2']);
      if ($mdp1 == $mdp2) {
         $insertmdp = $bdd->prepare("UPDATE users SET motdepasse = ? WHERE id = ?");
         $insertmdp->execute(array($mdp1, $_SESSION['id']));
         header('Location: profil.php?id=' . $_SESSION['id']);
      } else {
         $msg = "Vos deux mdp ne correspondent pas !";
      }
   }
?>
   <html>

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
      <link rel="stylesheet" href="style/edition.css">
      <link rel="stylesheet" href="style/navbar_resize.css">

      <!--JS SCRIPT-->

      <script src="script.js"></script>
   </head>

   <body>
      <!-- NAVBAR -->
      <?php include("piece_design/menu.php"); ?>
      <?php include("piece_design/navbar_resize.php"); ?>

      <!--modification de profil-->
      <div class="container">
         <div class="title-text">

            <div class="wrapper">

               <div class="form-container">

                  <h2>Modification du profil de <?php echo $user['pseudo']; ?></h2>
                  <div align="left">
                     <form method="POST" action="" enctype="multipart/form-data">
                        <label>Pseudo :</label><br>
                        <input type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['pseudo']; ?>" /><br />
                        <label>Mail :</label><br>
                        <input type="text" name="newmail" placeholder="Mail" value="<?php echo $user['mail']; ?>" /><br />
                        <label>Mot de passe :</label><br>
                        <input type="password" name="newmdp1" placeholder="Mot de passe" /><br />
                        <label>Confirmation:</label><br>
                        <input type="password" name="newmdp2" placeholder="Confirmation du mot de passe" /><br />
                        <label>Adresse :</label><br>
                        <input type="text" name="newadresse" placeholder="Adresse" value="<?php echo $user['adresse']; ?>" /><br />
                        <label>Ville :</label><br>
                        <input type="text" name="newville" placeholder="Ville" value="<?php echo $user['Ville']; ?>" /><br />
                        <label>Telephone :</label><br>
                        <input type="text" name="newTelephone" placeholder="Telephone" value="<?php echo $user['Telephone']; ?>" /><br /><br />
                        <div class="field btn">
                           <div class="btn-layer">
                           </div>
                           <input type="submit" value="Mettre à jour mon profil !" />
                        </div>
                     </form>
                     <?php if (isset($msg)) {
                        echo $msg;
                     } ?>
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
<?php
} else {
   header("Location: conn2.php");
}
?>