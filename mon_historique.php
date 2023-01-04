<?php
session_start();
if(isset($_SESSION['ID']) == 0){
    header('Location: ./login.php');
}

include('server.php');
$Connect = mysqli_connect($Server,$User,$Pwd,$db);

$Query = "SELECT `ID_Book`, `Date`, `Return_date` FROM `historique` WHERE `ID_Member`=".$_SESSION['ID'];
$Result = $Connect->query ($Query);
$Data = mysqli_fetch_row ($Result);

$Table = array();

while($Data != null){
    array_push($Table,$Data);
    $Data = mysqli_fetch_row ($Result);
}
for($i=0;$i<count($Table);$i+=1){
    $Query = "SELECT `Titre` FROM `livres` WHERE `ID`=".$Table[$i][0];
    $Result = $Connect->query ($Query);
    $Data = mysqli_fetch_row ($Result);
    array_push($Table[$i],$Data[0]);
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
                        echo "<p>Vous n'avez pas encore rendu de livre</p>";
                    }else{
                        echo "<p>Voici l'historique de vos emprunts:</p>";
                        echo "<table>
                                <thead>
                                    <th>Livre</th>
                                    <th>Date d'emprunt</th>
                                    <th>Date de rendu</th>
                                </thead>";
                        echo "<tbody>";
                            $i = 0;
                            for($i=0;$i<count($Table);$i+=1){
                                echo "<tr>";
                                $Titre = $Table[$i][3];
                                echo "<td>$Titre</td>";
                                $Date = $Table[$i][1];
                                echo "<td>$Date</td>";
                                $Date_Rendu = $Table[$i][1];
                                echo "<td>$Date_Rendu</td>";
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