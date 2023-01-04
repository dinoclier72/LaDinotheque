<?php
session_start();
if(isset($_SESSION['ID']) == 0){
    header('Location: ./login.php');
}
include('server.php');

$Connect = mysqli_connect($Server,$User,$Pwd,$db);
$Query = "SELECT `Nom`,`prenom`,`identifiant`,`mail` FROM `utilisateur` WHERE `ID` = ".$_SESSION['ID'];
$Result = $Connect->query ($Query);
$Data = mysqli_fetch_array ($Result);
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
                    <ul>
                        <li>informations</li>
                        <li>
                            <ul>
                                <li>nom:</li>
                                <li><?php echo "$Data[0] $Data[1]";?></li>
                            </ul>
                        <li>
                            <ul>
                                <li>identifiant:</li>
                                <li><?php echo $Data[2];?></li>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li>e-mail:</li>
                                <li><?php echo $Data[3];?></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </body>
</html>