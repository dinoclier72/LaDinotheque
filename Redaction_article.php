<?php
session_start();
if(isset($_SESSION['ID']) == 0){
    header('Location: ./login.php');
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <link rel="stylesheet" href="Menu_fond.css">
        <link rel="stylesheet" href="info_compte.css">
        <title>La Dinotheque</title>
        <link rel="shortcut icon" type="image/x-icon" href="fichiers/dinosaur_logo.ico" />
    </head>
    <body>
        <div class = "Bar">
            <?php include('menu.php');?>
        </div>
        <div class="corps">
            <div class="contenu">
                <div class="option">
                    <?php include('options_compte.php');?>
                </div>
                <div class = "vl"></div>
                <div class = "infos">
                    <p>Rediger un article pour la page d'actualité</p>
                    <form method = 'post' action='enregistrer_article.php'>
                        <div>
                            <label for='titre'>Titre</label>
                            <input id = 'titre'type = 'text' name='Titre'>
                        </div>
                        <div>
                            <label for='contenu'>Contenu</label>
                            <textarea id = 'contenu' name="contenu"rows="5" cols="30"></textarea>
                        </div>
                        <input type = 'submit'>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>