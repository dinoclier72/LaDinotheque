<?php
session_start();
if(isset($_SESSION['ID']) == 0){
    header('Location: ./login.php');
}

include('server.php');
$Connect = mysqli_connect($Server,$User,$Pwd,$db);

if(isset($_POST['search'])== 0){
    $Query = "SELECT `prenom`,`Nom`,`ID`,`identifiant`,`mail`,`ADMIN` FROM `utilisateur` WHERE 1";
    $Result = $Connect->query ($Query);

    $Table = array();
    $Data = mysqli_fetch_row ($Result);

    while ($Data != NULL){
        $infos = array();
        $nom = $Data[0]." ".$Data[1];
        array_push($infos,$nom);
        $ID = $Data[2];
        array_push($infos,$ID);
        $identifiant = $Data[3];
        array_push($infos,$identifiant); 
        $mail = $Data[4];
        array_push($infos,$mail);
        $ADMIN = $Data[5];
        array_push($infos,$ADMIN);
        
        array_push($Table, $infos);
        $Data = mysqli_fetch_row ($Result);
    }
    $LTable = count($Table);
}else{
    $decom = explode(" ",$_POST['search']);
    
    $i = 0;
    $IDS = array();
    for($i = 0; $i<count($decom);$i +=1){
        $Query = "SELECT `ID` FROM `utilisateur` WHERE `Nom` LIKE '%".$decom[$i]."%' or `prenom` LIKE '%".$decom[$i]."%'";
        $Result = $Connect->query ($Query);

        $Data = mysqli_fetch_row ($Result);

        while($Data != null){
            array_push($IDS,$Data[0]);
            $Data = mysqli_fetch_row ($Result);
        }
    }
    $IDS = array_unique($IDS,SORT_NUMERIC);

    $Table = array();

    for($i=0; $i<count($IDS);$i +=1){
        $Query = "SELECT `prenom`,`Nom`,`ID`,`identifiant`,`mail`,`ADMIN` FROM `utilisateur` WHERE `ID` =".$IDS[$i];
        $Result = $Connect->query ($Query);
               
        $Data = mysqli_fetch_row ($Result);

        $infos = array();
        $nom = $Data[0]." ".$Data[1];
        array_push($infos,$nom);
        $ID = $Data[2];
        array_push($infos,$ID);
        $identifiant = $Data[3];
        array_push($infos,$identifiant); 
        $mail = $Data[4];
        array_push($infos,$mail);
        $ADMIN = $Data[5];
        array_push($infos,$ADMIN);
        
        array_push($Table, $infos);
    }


    $LTable = count($Table);
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
                <form action='' method='post'>
                    <input type='text' placeholder='Search..' name='search' list = 'name-list'>
                        <datalist id = 'name-list'>
                            <?php
                                for($i = 0;$i<$LTable;$i +=1){
                                    $Nom = $Table[$i][0];
                                    echo "<option value = '$Nom'>";
                                }
                            ?>
                        </datalist>
                        <button type='submit'>search</button>
                </form>
                <form action = 'edition_utilisateur.php' method = 'post'>
                    <input type = 'submit' name ="action" value= "AJOUTER">
                </form>
                <?php
                    if($LTable>0){
                        echo "<table>
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>ID</th>
                                <th>Identifiant</th>
                                <th>Mail</th>
                                <th>ADMIN</th>
                                <th>Options</th>
                            </tr>
                        </thead>";
                        echo "<tbody>";
                        $i = 0;
                        for($i=0;$i<$LTable;$i+=1){
                            echo "<tr>";
                            $Nom = $Table[$i][0];
                            echo "<td>$Nom</td>";
                            $ID = $Table[$i][1];
                            echo "<td>$ID</td>";
                            $identifiant = $Table[$i][2];
                            echo "<td>$identifiant</td>";
                            $mail = $Table[$i][3];
                            echo "<td>$mail</td>";
                            $NADMIN = $Table[$i][4];
                            if($NADMIN == 1){
                                $ADMIN = "OUI";
                            }else{
                                $ADMIN = "NON";
                            }
                            echo "<td>$ADMIN</td>";
                            echo "<td>";
                            $User_ID= $Table[$i][1];
                             echo "<form action='edition_utilisateur.php' method='post'>
                                    <input type='hidden' name='ID_Member' value = '$User_ID'/>
                                    <input type='submit' name='VALIDER' value = 'gerer le profil'>
                                    </form>
                                    </td>";
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