<?php
session_start();
if(isset($_SESSION['ID']) == 0 or $_SESSION['ADMIN']==0){
    header('Location: ./login.php');
}

include('server.php');
$Connect = mysqli_connect($Server,$User,$Pwd,$db);

if(isset($_POST['search'])== 0){

$Query = "SELECT * FROM `stock` WHERE 1";
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
    $Query = "SELECT `Titre` FROM `livres` WHERE ID =".$Table[$i][0];
    $Result = $Connect->query ($Query);
    $Data = mysqli_fetch_row ($Result);
    array_push($Table[$i], $Data[0]);
}
}else{
    $search = $_POST['search'];
    $Query = "SELECT `ID`,`Titre` FROM `livres` WHERE `Titre` LIKE '%$search%'";
    $Result = $Connect->query ($Query);

    $Table = array();
    $Titres = array();

    $Data = mysqli_fetch_row ($Result);

    while($Data != null){
        $list = array();
        array_push($list,$Data[0]);
        array_push($Table,$list);
        array_push($Titres,$Data[1]);
        $Data = mysqli_fetch_row ($Result);
    }

    $LTable = count($Table);
    $i =0;
    for($i = 0;$i<$LTable;$i+=1){
        $Query = "SELECT `Number`,`Available` FROM `stock` WHERE ID_Book =".$Table[$i][0];
        $Result = $Connect->query ($Query);
        $Data = mysqli_fetch_row ($Result);
        array_push($Table[$i], $Data[0]);
        array_push($Table[$i], $Data[1]);
        array_push($Table[$i], $Titres[$i]);
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
                            echo "<p>Le stock est vide</p>";
                        }else{
                            echo "<p>Voici ce que l'on a en stock:</p>";
                        }
                            echo "<form action='' method='post'>
                                    <input type='text' placeholder='Search..' name='search' list = 'title-list'>
                                    <datalist id = 'title-list'>";
                            for($i=0;$i<$LTable;$i+=1){
                                $option = $Table[$i][3];
                                echo "<option value = '$option'>";
                            }
                            echo "</datalist>";
                            echo    "<button type='submit'>Submit</button>
                                  </form>";?>
                    <form action = 'edition_stock.php' method = 'post'>
                        <input type='submit' name='VALIDER' value = 'Ajouter'>
                    </form>
                    <?php
                        if(count($Table)>0){
                            echo "<table><thead><tr><th>Livre</th><th>Nombre total</th><th>Nombre disponible</th><th>options</th></thead>";
                            echo "<tbody>";
                            $i = 0;
                            for($i=0;$i<$LTable;$i+=1){
                                echo "<tr>";
                                $livre = $Table[$i][3];
                                echo "<td>$livre</td>";
                                $stock = $Table[$i][1];
                                echo "<td>$stock</td>";
                                $available = $Table[$i][2];
                                echo "<td>$available</td>";
                                echo "<td>";
                                $Book_ID= $Table[$i][0];
                                echo "<form action='edition_stock.php' method='post'>
                                        <input type='hidden' name='ID_Book' value = '$Book_ID'/>
                                        <input type='submit' name='VALIDER' value = 'modifier'>
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