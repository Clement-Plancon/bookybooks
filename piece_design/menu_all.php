    <header>
        <nav>
            <div class="navbar_container">
                <div class="navbar">
                    <div class="container_top">
                        <img src="images/booky_books.gif" alt="" />
                    </div>
                    <div class="container_text">
                        <div class="container_bottom_left">
                            <a href="accueil.php">Accueil</a>
                            <a href="categorie.php">Catégorie</a>
                        </div>
                        <div class="container_bottom_right">
                            <a href="catalogue.php">Catalogue</a>
                            <?php if (isset($_SESSION['pseudo'])) { ?>
                                <a href="deco.php">Déconnexion</a>
                            <?php
                            } else { ?>
                                <a href="conn2.php">Connexion</a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="container_end_up">
                        <div class="container_end">
                            <?php if (isset($_SESSION['pseudo'])) { ?>
                                <a href="panier.php"><img src="images/shopping_basket.svg" alt="" /></a>
                                <a href="profil.php" id="img_user"><img src="images/user.svg" alt="" id="img_user" /></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <form action="" class="search-bar" methode="POST">
    <input type="search" name="q" pattern=".*\S.*" required>
    <button class="search-btn" type="submit">
        <span>Search</span>
    </button>
</form>