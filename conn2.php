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
    <!--LE PHP CACA CONNECTION-->
<?php
    if (isset($_POST['formconnexion'])) {
   $mailconnect = htmlspecialchars($_POST['mailconnect']);
   $mdpconnect = sha1($_POST['mdpconnect']);
   if (!empty($mailconnect) and !empty($mdpconnect)) {
      $requser = $bdd->prepare("SELECT * FROM users WHERE mail = ? AND motdepasse = ?");
      $requser->execute(array($mailconnect, $mdpconnect));
      $userexist = $requser->rowCount();
      if ($userexist == 1) {
         $userinfo = $requser->fetch();
         $_SESSION['id'] = $userinfo['id'];
         $_SESSION['pseudo'] = $userinfo['pseudo'];
         $_SESSION['mail'] = $userinfo['mail'];
         header("Location: profil.php");
      } else {
         $erreur = "Mauvais mail ou mot de passe !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>
 <!--LE PHP CACA INSCRIPTION-->
<?php if(isset($_POST['forminscription'])) {
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1($_POST['mdp2']);
    if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
       $pseudolength = strlen($pseudo);
       if($pseudolength <= 255) {
          if($mail == $mail2) {
             if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $reqmail = $bdd->prepare("SELECT * FROM users WHERE mail = ?");
                $reqmail->execute(array($mail));
                $mailexist = $reqmail->rowCount();
                if($mailexist == 0) {
                   if($mdp == $mdp2) {
                      $Null = " ";
                      $insertmbr = $bdd->prepare("INSERT INTO users(pseudo, motdepasse, mail, adresse, Telephone, Ville) VALUES(?, ?, ?, NULL, NULL, NULL)");
                      $insertmbr->execute(array($pseudo, $mdp, $mail));
                      echo $pseudo.$mail.$mdp;
                      $erreur = "Votre compte a bien été créé ! <a href=\"log.php\">Me connecter</a>";
                   } else {
                      $erreur = "Vos mots de passes ne correspondent pas !";
                   }
                } else {
                   $erreur = "Adresse mail déjà utilisée !";
                }
             } else {
                $erreur = "Votre adresse mail n'est pas valide !";
             }
          } else {
             $erreur = "Vos adresses mail ne correspondent pas !";
          }
       } else {
          $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
       }
    } else {
       $erreur = "Tous les champs doivent être complétés !";
    }
 }
 ?>

    <!--FONT CSS-->



    <!--CUSTOM CSS-->
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="style/style_conn2.css">
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
    <div class="container">
        <div class="wrapper">
            <div class="title-text">
                <div class="title login">
                    Connexion</div>
                <div class="title signup">
                    Inscription</div>
            </div>
            <div class="form-container">
                <div class="slide-controls">
                    <input type="radio" name="slide" id="login" checked>
                    <input type="radio" name="slide" id="signup">
                    <label for="login" class="slide login">Connexion</label>
                    <label for="signup" class="slide signup">Inscription</label>
                    <div class="slider-tab">
                    </div>
                </div>
                <div class="form-inner">
                    <form action="" method="POST" class="login">
                        <div class="field">
                            <input type="email" name="mailconnect" placeholder="Adresse Email" required>
                        </div>
                        <div class="field">
                            <input type="password" name="mdpconnect" placeholder="Mot de passe" required>
                        </div>
                        <div class="pass-link">
                            <a href="#">Mot de passe oublié ?</a>
                        </div>
                        <div class="field btn">
                            <div class="btn-layer">
                            </div>
                            <input type="submit" name="formconnexion" value="Login">
                        </div>
                        <div class="signup-link">
                        <?php
                                if(isset($erreur)) {
                                    echo '<font color="red">'.$erreur."</font>";
                                }
                                ?>
                            Vous n'etes pas membre ? <a href="">Inscrivez-vous maintenant</a></div>
                    </form>
                    
                    <!--Inscription -->

                    <form action="" method="POST" class="signup">
                        <div class="field">
                            <input type="text" id="pseudo" name="pseudo" placeholder="Pseudo" required>
                        </div>
                        <div class="field">
                            <input type="email" id="mail" name="mail" placeholder="Adresse Email" required>
                        </div>
                        <div class="field">
                            <input type="email" id="mail2" name="mail2" placeholder="Confirmer l'Adresse Email" required>
                        </div>
                        <div class="field">
                            <input type="password" id="mdp" name="mdp" placeholder="Mot de passe" required>
                        </div>
                        <div class="field">
                            <input type="password" id="mdp2" name="mdp2" placeholder="Confirmer le mot de passe" required>
                        </div>
                        <div class="field btn">
                            <div class="btn-layer">
                            </div>
                            <input type="submit" name="forminscription" value="Signup">
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    <script>
        const loginText = document.querySelector(".title-text .login");
        const loginForm = document.querySelector("form.login");
        const loginBtn = document.querySelector("label.login");
        const signupBtn = document.querySelector("label.signup");
        const signupLink = document.querySelector("form .signup-link a");
        signupBtn.onclick = (() => {
            loginForm.style.marginLeft = "-50%";
            loginText.style.marginLeft = "-50%";
        });
        loginBtn.onclick = (() => {
            loginForm.style.marginLeft = "0%";
            loginText.style.marginLeft = "0%";
        });
        signupLink.onclick = (() => {
            signupBtn.click();
            return false;
        });
    </script>

    <!-- FOOTER-->
    <?php include("piece_design/footer.php"); ?>


    <!-- SECTION 3 -->

    <!-- SECTION 4 -->

</body>

</html>