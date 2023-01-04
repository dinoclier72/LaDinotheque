<?php
    session_start();

    include('server.php');
    
    $Connect = mysqli_connect($Server,$User,$Pwd,$db);
    $Query = "SELECT `Titre`,`Auteur`,`Date de sortie`,`description`,`ID` FROM `livres` WHERE 1";
    $Result = $Connect->query ($Query);

    $Table = array();
    $Data = mysqli_fetch_row ($Result);

    while ($Data != NULL){
        array_push($Table, $Data);
        $Data = mysqli_fetch_row ($Result);
    }

    $LTable = count($Table);

    for($i=0;$i<count($Table);$i+=1){
        $Query = "SELECT `Available` FROM `stock` WHERE `ID_Book` =".$Table[$i][4];
        $Result = $Connect->query ($Query);
        $Data = mysqli_fetch_row ($Result);
        array_push($Table[$i], $Data);
    }
    if(isset($_SESSION['ID'])){
    $Query = "SELECT COUNT(*) FROM `emprunts` WHERE `ID_Member`=".$_SESSION['ID'];
    $Result = $Connect->query ($Query);
    $Data = mysqli_fetch_row ($Result);
    $Livres = $Data[0];
    $Query = "SELECT COUNT(*) FROM `reservation` WHERE `ID_Member`=".$_SESSION['ID'];
    $Result = $Connect->query ($Query);
    $Data = mysqli_fetch_row ($Result);
    $Livres += $Data[0];
    }
?>

<DOCTYPE html>
<html lang="fr">
    <head>
        <link rel="stylesheet" href="Menu_fond.css">
        <title>La Dinotheque</title>
        <link rel="shortcut icon" type="image/x-icon" href="fichiers/dinosaur_logo.ico" />
    </head>
    <body>
        <div class = "Bar">
            <?php include('menu.php');?> 
        </div>
        <div class="corps">
            <div class="contenu">
                <?php
                        if(count($Table)==0){
                            echo "<p>Aucun livres :/</p>";
                        }else{
                            echo "<table>
                                    <thead>
                                        <th>Image</th>
                                        <th>Titre</th>
                                        <th>Auteur</th>
                                        <th>Date de sortie</th>
                                        <th>Description</th>";
                            if(isset($_SESSION['ID'])){
                                echo "<th>Reservation</th>";
                            }
                            echo "</thead>";
                            echo "<tbody>";
                            $i = 0;
                            for($i=0;$i<$LTable;$i+=1){
                                echo "<tr>";
                                echo "<td></td>";
                                $membre = $Table[$i][0];
                                echo "<td>$membre</td>";
                                $livre = $Table[$i][1];
                                echo "<td>$livre</td>";
                                $DE = $Table[$i][2];
                                echo "<td>$DE</td>";
                                $DR = $Table[$i][3];
                                echo "<td>$DR</td>";
                                if(isset($_SESSION['ID']) and $Table[$i][5]>0 and $Livres<3){
                                    echo "<td>";
                                    echo "<form method = 'post' action = 'reservation_livre.php'>
                                            <input type = 'hidden' name = 'ID_Book' value =".$Table[$i][4].">
                                            <input type ='submit' value = 'reserver'>
                                          </form>";
                                    echo "</td>";
                                }
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                    }
                    ?>
            </div>
        </div>
    </body>
</html>