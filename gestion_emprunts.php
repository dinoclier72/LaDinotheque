<?php
session_start();
if(isset($_SESSION['ID']) == 0 or $_SESSION['ADMIN']==0){
    header('Location: ./login.php');
}

include('server.php');
$Connect = mysqli_connect($Server,$User,$Pwd,$db);

if(isset($_POST['name'])==0){
$Query = "SELECT * FROM `emprunts` WHERE 1";
$Result = $Connect->query ($Query);

$Table = array();
$Data = mysqli_fetch_row ($Result);

while ($Data != NULL){
    array_push($Table, $Data);
    $Data = mysqli_fetch_row ($Result);
}

$LTable = count($Table);

$i =0;
for($i = 0;$i<$LTable;$i+=1){
    $Query = "SELECT `Titre` FROM `livres` WHERE ID =".$Table[$i][1];
    $Result = $Connect->query ($Query);
    $Data = mysqli_fetch_row ($Result);
    array_push($Table[$i], $Data[0]);
    $Query = "SELECT `prenom`,`Nom` FROM `utilisateur` WHERE ID =".$Table[$i][0];
    $Result = $Connect->query ($Query);
    $Data = mysqli_fetch_row ($Result);
    $Nom = $Data[0]." ".$Data[1];
    array_push($Table[$i], $Nom);
}
}else{
    $Name = $_POST['name'];
    $Title = $_POST['title'];
    
    $ID_Member = array();

    $Query = "SELECT `ID` FROM `utilisateur` WHERE `prenom` LIKE '%$Name%' or `nom` LIKE '%$Name%' ";
    $Result = $Connect->query ($Query);
    $Data = mysqli_fetch_row ($Result);

    while ($Data != NULL){
        array_push($ID_Member,$Data[0]);
        $Data = mysqli_fetch_row ($Result);
    }

    $ID_Book = array();

    $Query = "SELECT `ID` FROM `livres` WHERE `Titre` LIKE '%$Title%'";
    $Result = $Connect->query ($Query);
    $Data = mysqli_fetch_row ($Result);

    while ($Data != NULL){
        array_push($ID_Book,$Data[0]);
        $Data = mysqli_fetch_row ($Result);
    }

    $j = 0;
    $k = 0;

    $Table = array();
    for($j = 0;$j<count($ID_Member);$j += 1){
        for($k = 0;$k<count($ID_Book);$k = $k + 1){
        $Query = "SELECT * FROM `emprunts` WHERE `ID_Member` = $ID_Member[$j] and `ID_Book` = $ID_Book[$k]";
        $Result = $Connect->query ($Query);

        $Data = mysqli_fetch_row ($Result);

        while ($Data != NULL){
            array_push($Table, $Data);
            
            $Data = mysqli_fetch_row ($Result);
            }
        }
    }
    
    $LTable = count($Table);

    $i =0;
    for($i = 0;$i<$LTable;$i+=1){
        $Query = "SELECT `Titre` FROM `livres` WHERE ID =".$Table[$i][1];
        $Result = $Connect->query ($Query);
        $Data = mysqli_fetch_row ($Result);
        array_push($Table[$i], $Data[0]);
        $Query = "SELECT `prenom`,`Nom` FROM `utilisateur` WHERE ID =".$Table[$i][0];
        $Result = $Connect->query ($Query);
        $Data = mysqli_fetch_row ($Result);
        $Nom = $Data[0]." ".$Data[1];
        array_push($Table[$i], $Nom);
    }
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
                            echo "<p>Pas d'emprunts actuels</p>";
                        }else{
                            echo "<p>Voici la liste des emprunts:</p>";
                        }
                        echo "<form action='' method='post'>
                                    <input type='text' placeholder='Nom..' name='name' list = 'Name-list'>
                                    <datalist id = 'Name-list'>";
                            for($i=0;$i<$LTable;$i+=1){
                                $option = $Table[$i][5];
                                echo "<option value = '$option'>";
                            }
                            echo "</datalist>";
                            echo "<input type='text' placeholder='Titre de livre..' name='title' list = 'title-list'>
                                    <datalist id = 'title-list'>";
                            for($i=0;$i<$LTable;$i+=1){
                                $option = $Table[$i][4];
                                echo "<option value = '$option'>";
                            }
                            echo "</datalist>";
                            echo    "<button type='submit'>search</button>
                                  </form>";
                            if(count($Table)>0){
                            echo "<table><thead><th>emprunteur</th><th>Livre</th><th>Date d'emprunt</th><th>Date de rendu</th><th>options</th></thead>";
                            echo "<tbody>";
                            $i = 0;
                            for($i=0;$i<$LTable;$i+=1){
                                echo "<tr>";
                                $membre = $Table[$i][5];
                                echo "<td>$membre</td>";
                                $livre = $Table[$i][4];
                                echo "<td>$livre</td>";
                                $DE = $Table[$i][2];
                                echo "<td>$DE</td>";
                                $DR = $Table[$i][3];
                                echo "<td>$DR</td>";
                                echo "<td>";
                                $User_ID = $Table[$i][0];
                                $Book_ID = $Table[$i][1];
                                echo "<form action='edition_emprunt.php' method='post'>
                                        <input type='hidden' name='ID_Member' value = '$User_ID'/>
                                        <input type='hidden' name='ID_Book' value = '$Book_ID'/>
                                        <input type='submit' name='VALIDER' value = 'modifier'>
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