<header>
<link rel="stylesheet" href="alert.css">
    <nav>
        <div class="navbar_container_resize">
            <div class="navbar_resize">
                <a href="accueil.php"><img src="images/reception.svg" alt="" /></a>
                <a href="categorie.php"><img src="images/list.svg" alt="" /></a>
                <a href="catalogue.php"><img src="images/catalogue.svg" alt="" /></a>
                <?php if (isset($_SESSION['pseudo'])) { ?>
                    <a href="#" onclick="alert('');"><img src="images/arrow.svg" alt="" /></a>
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
            <form action="catalogue.php" class="search-bar_resize" methode="POST">
                <input type="search" name="q" pattern=".*\S.*" required>
                <button class="search-btn" type="submit">
                    <span>Search</span>
                </button>
            </form>
        </div>
    </nav>
</header>
<script>
var ALERT_TITLE = "Voulez vous vous deconneter ?";
var ALERT_BUTTON_TEXT = "annuler";
var ALERT2_BUTTON_TEXT = "Se deconnecter";

if(document.getElementById) {
    window.alert = function(txt) {
        createCustomAlert(txt);
    }
}

function createCustomAlert(txt) {
    d = document;

    if(d.getElementById("modalContainer")) return;

    mObj = d.getElementsByTagName("body")[0].appendChild(d.createElement("div"));
    mObj.id = "modalContainer";
    mObj.style.height = d.documentElement.scrollHeight + "px";

    alertObj = mObj.appendChild(d.createElement("div"));
    alertObj.id = "alertBox";
    if(d.all && !window.opera) alertObj.style.top = document.documentElement.scrollTop + "px";
    alertObj.style.left = (d.documentElement.scrollWidth - alertObj.offsetWidth)/2 + "px";
    alertObj.style.visiblity="visible";

    hz = alertObj.appendChild(d.createElement("hz"));
    hz.appendChild(d.createTextNode(ALERT_TITLE));

    msg = alertObj.appendChild(d.createElement("p"));
    //msg.appendChild(d.createTextNode(txt));
    msg.innerHTML = txt;
    btn2 = alertObj.appendChild(d.createElement("a"));
    btn2.id = "closeBtn";
    btn2.appendChild(d.createTextNode(ALERT2_BUTTON_TEXT));
    btn2.href = "#";
    btn2.focus();
    btn2.onclick = function() { window.location.href="deco.php"; }
    btn = alertObj.appendChild(d.createElement("a"));
    btn.id = "closeBtn";
    btn.appendChild(d.createTextNode(ALERT_BUTTON_TEXT));
    btn.href = "#";
    btn.focus();
    btn.onclick = function() { removeCustomAlert();return false; }
    
    alertObj.style.display = "block";

}

function removeCustomAlert() {
    document.getElementsByTagName("body")[0].removeChild(document.getElementById("modalContainer"));
}
</script>