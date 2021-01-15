<!DOCTYPE html>
<html>
    <!-- en-tête de la page -->
    <title>MapAnime</title>
    <head>

        <meta charset="UTF-8" />
        <link rel="icon" type="image/jpg" href="./images/icone.jpg"/>
        <link href="site.css" rel="stylesheet" type="text/css">
    </head>
    
    <!-- corps de la page -->
    <body>
        <header>
            <a href="index.php"><img src="./images/icone.jpg"/ width = 110px></a>
        </header>
            <nav>
                <div class="gauche">
                    <a href="index.php?module=Recherche&action=anime">Anime</a>
                    <a href="index.php?module=Recherche&action=club">Club</a>
                    <?php
                    if (isset($_SESSION['idUtilisateur'])) {
                        echo "<a href=\"index.php?module=Utilisateur&action=afficheProfil\" class=\"col-auto\">Profil</a>";
                    }
                    ?>
                </div>
                
                <div class="droite">
                    <a href="index.php?module=Recherche&action=recherche"><input type="button" value = "Search Anime..." class="add"/></a>
                    <?php
                    if (isset($_SESSION['idUtilisateur'])) {
                        echo "<a href=\"index.php?module=Connexion&action=deconnexion\"><input type=\"button\" name=\"deconnecter\" value=\"Logout\" class=\"log\"/></a>";
                    }
                    else{
                        echo "<a href=\"index.php?module=Connexion&action=form\"><input type=\"button\" name=\"connecter\" value=\"Login\" class=\"log\"/></a>";
                        echo "<a href=\"index.php?module=Connexion&action=formInscription\"><input type=\"button\" name=\"connecter\" value=\"Sign Up\" class=\"log\"/></a>";
                    }
                    ?>
                </div>
            </nav>
        
        <!-- Corps de la page -->
        <main>
            <div class="container">
                <?= $module ?>
            </div>
        </main>

        <footer>           
            <input type="button" value = "Contact" />
            <input type="button" value = "FAQ" />
            <input type="button" value = "Conditions d'utilisation" />
            <input type="button" value = "Cookies" >
            <input type="button" value = "Vie privée" />

            <p>Tout droits réservés,  SIVASANKAR Ganeche, MONTES Nicolas, RENARDET Martin</p>
        </footer>

    </body>

</html>