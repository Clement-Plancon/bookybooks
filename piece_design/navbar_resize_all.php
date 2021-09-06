<header>
    <nav>
        <div class="navbar_container_resize">
            <div class="navbar_resize">
                <a href="accueil.php"><img src="images/reception.svg" alt="" /></a>
                <a href="categorie.php"><img src="images/list.svg" alt="" /></a>
                <a href="catalogue.php"><img src="images/catalogue.svg" alt="" /></a>
                <?php if (isset($_SESSION['pseudo'])) { ?>
                    <a href="deco.php"><img src="images/arrow.svg" alt="" /></a>
                <?php
                } else { ?>
                    <a href="conn2.php"><img src="images/login.svg" alt="" /></a>
                <?php
                }
                ?>
            </div>
            <div class="container_icon_up">
                <div class="container_icon">
                    <?php if (isset($_SESSION['pseudo'])) { ?>
                        <a href="panier.php"><img src="images/shopping_basket.svg" alt="" /></a>
                        <a href="profil.php" id="img_user"><img src="images/user.svg" alt="" id="img_user" /></a>
                    <?php } ?>
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
</br></br></br></br></br>