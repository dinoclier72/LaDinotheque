<?php
    echo    "<ul class = 'options'>
            <li class = 'options'><a href='mon_compte.php' class = 'options'>Mes infos</a></li>";
    if($_SESSION['View'] == 0){
        echo "<li class = 'options'><a href='ma_carte.php' class = 'options'>Ma carte</a></li>";
        echo "<li class = 'options'><a href='mes_emprunts.php' class= 'options'>Mes emprunts</a></li>";
        echo "<li class = 'options'><a href='mes_reservation.php' class= 'options'>Mes réservations</a></li>";
        echo "<li class = 'options'><a href='mon_historique.php' class= 'options'>Mon historique</a></li>";
    }else{
        echo "<li class = 'options'><a href='Redaction_article.php' class = 'options'>Redaction_article</a></li>";
        echo "<li class = 'options'><a href='gestion_utilisateurs.php' class = 'options'>Gestion des utilisateurs</a></li>";
        echo "<li class = 'options'><a href='gestion_emprunts.php' class = 'options'>Gestion des emprunts</a></li>";
        echo "<li class = 'options'><a href='gestion_stock.php' class = 'options'>Gestion du stock</a></li>";
    }
    echo    "</ul>
            <ul class='optionsA'>";
    if($_SESSION['ADMIN']){
        if($_SESSION['View']){
            echo "<li class = 'optionsA'><a href = 'changeview.php' class = 'optionsA' >Vue UTILISATEUR</a></li>";
        }else{
            echo "<li class = 'optionsA'><a href = 'changeview.php' class = 'optionsA'>Vue ADMIN</a></li>";
        }
    } 
    echo    "<li class = 'optionsA'><a href='disconect.php' class = 'optionsA'>Deconection</a></li>
            <li class = 'optionsA'><a href='disconect.php' class = 'optionsA'>suprimer le compte</a></li>
            </ul>";
?>