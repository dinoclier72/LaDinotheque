<?php
session_start();
if(isset($_SESSION['ID']) == 0){
    header('Location: ./login.php');
}

include('server.php');
$Connect = mysqli_connect($Server,$User,$Pwd,$db);

$Nom = "";
$ID = "";
$identifiant = "";
$Mail = "";
$Admin = 0;

$Sortie = "";

$ajout = 0;

if(isset($_POST["VALIDER"])){
    $Query = "SELECT `prenom`,`Nom`,`ID`,`identifiant`,`mail`,`ADMIN` FROM `utilisateur` WHERE `ID`=".$_POST["ID_Member"];
    $Result = $Connect->query ($Query);

    $Data = mysqli_fetch_row ($Result);

    $Nom = $Data[0]." ".$Data[1];
    $ID = $Data[2];
    $identifiant = $Data[3];
    $Mail = $Data[4];
    $Admin = $Data[5];

    $Sortie = "modifier_utilisateur.php";
}else{
    $Query = "SELECT max(`ID`) FROM `utilisateur` WHERE 1";
    $Result = $Connect->query ($Query);

    $Data = mysqli_fetch_row ($Result);

    $ID = $Data[0]+1;

    $Sortie = "ajout_utilisateur.php";

    $ajout = 1;
}

if($ajout == 0){
    $Query = "SELECT * FROM `emprunts` WHERE `ID_Member`=".$_POST["ID_Member"];
    $Result = $Connect->query ($Query);
    $Data = mysqli_fetch_row ($Result);

    $Table1 = array();

    while($Data != null){
        array_push($Table1,$Data);
        $Data = mysqli_fetch_row ($Result);
    }
    for($i=0;$i<count($Table1);$i+=1){
        $Query = "SELECT `Titre` FROM `livres` WHERE `ID`=".$Table1[$i][1];
        $Result = $Connect->query ($Query);

        $Data = mysqli_fetch_row ($Result);

        array_push($Table1[$i],$Data[0]);
    }

    $Query = "SELECT * FROM `carte` WHERE `ID`=".$_POST["ID_Member"];
    $Result = $Connect->query ($Query);
    $Data = mysqli_fetch_row ($Result);

    if($Data != null){
        $Carte = 1;
        $Valide = $Data[1];
    }else{
        $Carte = 0;
    }
    $Query = "SELECT `ID_Book`,`Date`,`Return_date` FROM `historique` WHERE `ID_Member`=".$_POST["ID_Member"];
    $Result = $Connect->query ($Query);
    $Data = mysqli_fetch_row ($Result);

    $Table2 = array();
    while($Data != null){
        array_push($Table2,$Data);
        $Data = mysqli_fetch_row ($Result);
    }
    for($i=0;$i<count($Table2);$i+=1){
        $Query = "SELECT `Titre` FROM `livres` WHERE `ID`=".$Table2[$i][0];
        $Result = $Connect->query ($Query);

        $Data = mysqli_fetch_row ($Result);

        array_push($Table2[$i],$Data[0]);
    }
    //var_dump($Table2);
    $Query = "SELECT `ID_Book` FROM `reservation` WHERE `ID_Member`=".$_POST["ID_Member"];
    $Result = $Connect->query ($Query);
    $Data = mysqli_fetch_row ($Result);
    $Table3 = array();
    while($Data != null){
        array_push($Table3,$Data);
        $Data = mysqli_fetch_row ($Result);
    }
    for($i=0;$i<count($Table3);$i+=1){
        $Query = "SELECT `Titre` FROM `livres` WHERE `ID`=".$Table3[$i][0];
        $Result = $Connect->query ($Query);

        $Data = mysqli_fetch_row ($Result);

        array_push($Table3[$i],$Data[0]);
    }
    //var_dump($Table3);
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
                    <div>
                    <form method='post' action = '<?php echo "$Sortie";?>'>
                        <div>
                        <label for = "Nom">Nom</label>
                        <input type = "text" id = "Nom" name = "Nom" value = "<?php echo "$Nom";?>">
                        </div>
                        <div>
                        <input type = "hidden" id = "ID" name = "ID" value = "<?php echo "$ID";?>">
                        </div>
                        <div>
                        <label for = "identifiant">identifiant</label>
                        <input type = "text" id = "identifiant" name = "identifiant" value = "<?php echo "$identifiant";?>">
                        </div>
                        <?php
                        if($ajout==1){
                        echo"<div>
                            <label for 'MDP'>Mot de passe</label>
                            <input type = 'text' id = 'MDP' name = 'MDP' value = ''>
                            </div>";
                        }
                        ?>
                        <div>
                        <label for = "Mail">Mail</label>
                        <input type = "text" id = "Mail" name = "Mail" value = "<?php echo "$Mail";?>">
                        </div>
                        <div>
                        <label for = "ADMIN">ADMIN</label>
                        <input type = "checkbox" id = "ADMIN" name = "ADMIN" <?php if($Admin ==1){echo 'checked';}?>>
                        </div>
                        <input type = "submit" name = "modifier" value = "modifier">
                    </form>
                    </div>
                    <div>
                        <?php
                            if($ajout == 0){
                                if($Carte == 1){
                                    echo "<p>Carte de $Nom valide jusqu'au $Valide</p>";
                                    echo "<form action = 'carte_gestion.php' method = 'post'>
                                            <input type='hidden' name= 'ID' value = '$ID'>
                                            <input type = 'submit' name ='action' value= 'verouiller la carte'>
                                         </form>";
                                }else{
                                    echo "<p>$Nom n'a pas de carte actuellement</p>";
                                    echo "<form action = 'carte_gestion.php' method = 'post'>
                                            <input type='hidden' name= 'ID' value = '$ID'>
                                            <input type = 'submit' name ='action' value= 'Ajouter une carte'>
                                         </form>";
                                }
                                if(count($Table1) == 0){
                                    echo"<p>$Nom n'a pas d'emprunts en cours</p>";
                                }else{
                                    echo "<p>Voici les emprunts de $Nom";
                                }
                                if(count($Table1)+count($Table3) <3 and $Carte == 1){
                                echo "<form action = 'emprunter_livre.php' method = 'post'>
                                        <input type='hidden' name= 'ID' value = '$ID'>
                                        <input type='hidden' name= 'Nom' value = '$Nom'>
                                        <input type = 'submit' name ='action' value= 'Nouvel_Emprunt'>
                                     </form>";
                                }
                                if(count($Table1)>0){
                                    echo "<table>";
                                    echo "<thead>
                                            <th>Livre</th>
                                            <th>Date d'emprunt</th>
                                            <th>Date de rendu</th>
                                            <th>options</th>
                                          </thead>";
                                    echo "<tbody>";
                                    for($i=0;$i<count($Table1);$i+=1){
                                        echo "<tr>";
                                        echo "<td>".$Table1[$i][4]."</td>";
                                        echo "<td>".$Table1[$i][2]."</td>";
                                        echo "<td>".$Table1[$i][3]."</td>";
                                        echo "<td>
                                                <form action='edition_emprunt.php' method='post'>
                                                    <input type='hidden' name='ID_Member' value = '$ID'/>
                                                    <input type='hidden' name='ID_Book' value = '".$Table1[$i][1]."'/>
                                                    <input type='submit' name='VALIDER' value = 'modifier'>
                                                </form>
                                                </td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                }
                                if(count($Table3) == 0){
                                    echo "<p>pas de réservation pour $Nom</p>";
                                }else{
                                    echo "<p>Voici les réservation de $Nom</p>";
                                }
                                if(count($Table3)>0){
                                    echo"<table>";
                                    echo "<thead>
                                            <th>Livre</th>
                                            <th>Emprunter</th>
                                            <th>Suprimer</th>
                                          </thead>";
                                          echo "<tbody>";
                                          for($i=0;$i<count($Table3);$i+=1){
                                              echo "<tr>";
                                              echo "<td>".$Table3[$i][1]."</td>";
                                              echo "<td>";
                                              echo "<form method = 'post' action = 'valider_emprunt.php'>
                                                        <input type='hidden' name = 'ID' value = '".$ID."'>
                                                        <input type='hidden' name = 'livres' value = '".$Table3[$i][1]."'>
                                                        <input type = 'hidden' name = 'temps_emprunt' value = '7'>
                                                        <input type='hidden' name = 'reservation' value = '1'>
                                                        <input type='submit' name = 'VALIDER' value = 'emprunter'>
                                                    </form>";
                                              echo "</td>";
                                              echo "<td>";
                                              echo "<form method = 'post' action = 'suprimer_reservation.php'>
                                                        <input type='hidden' name = 'ID_Member' value = '".$ID."'>
                                                        <input type='hidden' name = 'ID_Book' value = '".$Table3[$i][0]."'>
                                                        <input type='submit' name = 'VALIDER' value = 'suprimer'>
                                                    </form>";
                                              echo "</td>";
                                              echo "</tr>";
                                          }
                                          echo "</tbody>";
                                    echo"</table>";
                                }
                                if(count($Table2) == 0){
                                    echo "<p>$Nom n'as pas encore rendu un emprunt</p>";
                                }else{
                                    echo "<p>Voici l'historique des emprunts de $Nom</p>";
                                }
                                if(count($Table2)>0){
                                    echo"<table>";
                                    echo "<thead>
                                            <th>Livre</th>
                                            <th>Date d'emprunt</th>
                                            <th>Date de rendu</th>
                                          </thead>";
                                          echo "<tbody>";
                                          for($i=0;$i<count($Table2);$i+=1){
                                              echo "<tr>";
                                              echo "<td>".$Table2[$i][3]."</td>";
                                              echo "<td>".$Table2[$i][1]."</td>";
                                              echo "<td>".$Table2[$i][2]."</td>";
                                              echo "</tr>";
                                          }
                                          echo "</tbody>";
                                    echo"</table>";
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>