<?php
session_start();
if(isset($_SESSION['ID']) == 0){
    header('Location: ./login.php');
}

include('server.php');

$Connect = mysqli_connect($Server,$User,$Pwd,$db);
$Query = "SELECT `valide` FROM `carte` WHERE `ID` = ".$_SESSION['ID'];
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
                    <?php
                        if($Data == null){
                            echo "<p>vous n'avez pas de carte actuellement</p>";
                            echo "<a href='carte_gestion.php'>Demander une carte</a>";
                        }else{
                            echo "<p>votre carte expire le $Data[0]</p>";
                            echo "<a href='carte_gestion.php'>verouiller la carte</a>";
                        }
                    ?>
                    
                </div>
            </div>
        </div>
    </body>
</html>