<?php
session_start();
if(isset($_SESSION['ID']) == 0){
    header('Location: ./login.php');
}

include('server.php');

$Connect = mysqli_connect($Server,$User,$Pwd,$db);
$Query = "SELECT `ID_book`,`Return_date` FROM `emprunts` WHERE `ID_Member` = ".$_SESSION['ID'];
$Result = $Connect->query ($Query);

$Table = array();
$Data = mysqli_fetch_row ($Result);

while ($Data != NULL){
    array_push($Table, $Data);
    $Data = mysqli_fetch_row ($Result);
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
                    <?php
                    if(count($Table)==0){
                        echo "<p>vous n'avez pas d'emprunts actuellement</p>";
                    }else{
                        echo "<p>Voici la liste de vos emprunts:</p>";
                        echo "<table><thead><tr><th>Livre</th><th>Date de rendu</th></thead>";
                        echo "<tbody>";
                            $i = 0;
                            for($i=0;$i<count($Table);$i+=1){
                                echo "<tr>";
                                $Query = "SELECT `Titre` FROM `livres` WHERE `ID` = ".$Table[$i][0];
                                $Result = $Connect->query ($Query);
                                $livre = mysqli_fetch_row($Result);
                                echo "<td>$livre[0]</td>";
                                $RDate = ($Table[$i][1]);
                                echo "<td>$RDate</td>";
                                echo "</tr>";
                            }
                        echo "</tbody>";
                        echo "</table>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>