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
session_start();


            $getid = intval($_SESSION['id']);
            $requser = $bdd->prepare('DELETE FROM factures WHERE Achat_Users = ?');
            $requser->execute(array($getid));
            header("Location: profil.php");
?>

