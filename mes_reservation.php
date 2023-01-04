<?php
session_start();
if(isset($_SESSION['ID']) == 0){
    header('Location: ./login.php');
}

include('server.php');
$Connect = mysqli_connect($Server,$User,$Pwd,$db);

$Query = "SELECT `ID_Book` FROM `reservation` WHERE `ID_Member`=".$_SESSION['ID'];
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
                        echo "<p>Vous n'avez pas de réservation en cours</p>";
                    }else{
                        echo "<p>Voici vos réservations:</p>";
                        echo "<table>
                                <thead>
                                    <th>Livre</th>
                                    <th>Suprimer la réservation</th>
                                </thead>";
                        echo "<tbody>";
                            $i = 0;
                            for($i=0;$i<count($Table);$i+=1){
                                echo "<tr>";
                                $titre = $Table[$i][1]; 
                                echo "<td>$titre</td>";
                                echo "<td>";
                                $ID_Book = $Table[$i][0];
                                $ID_Member = $_SESSION["ID"];
                                echo "<form method = 'post' action = 'suprimer_reservation.php'>
                                        <input type = 'hidden' name = 'ID_Member' value = $ID_Member>
                                        <input type = 'hidden' name ='ID_Book' value=$ID_Book>
                                        <input type = 'hidden' name ='flag' value='user'>
                                        <input type='submit' value='Suprimer'>
                                      </form>";
                                echo "</td>";
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