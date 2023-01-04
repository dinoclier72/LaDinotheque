<?php
session_start();
if(isset($_SESSION['ID']) == 0){
    header('Location: ./login.php');
}

include('server.php');
$Connect = mysqli_connect($Server,$User,$Pwd,$db);

if($_POST['VALIDER'] == 'modifier'){
$ID_Book = intval($_POST['ID_Book']);

$Query = "SELECT `Titre`,`Auteur`,`Date de sortie`,`description` FROM `livres` WHERE ID = $ID_Book";
$Result = $Connect->query ($Query);
$Data = mysqli_fetch_row ($Result);

$Titre = $Data[0];
$Auteur = $Data[1];
$Date_sortie= $Data[2];
$Description= $Data[3];

$Query = "SELECT `Number` FROM `stock` WHERE ID_Book = $ID_Book";
$Result = $Connect->query ($Query);
$Data = mysqli_fetch_row ($Result);

$Stock = $Data[0];
}else{
    $Query = "SELECT MAX(`ID`) FROM `livres` WHERE 1";
    $Result = $Connect->query ($Query);
    $Data = mysqli_fetch_row ($Result);

    $ID_Book = $Data[0] + 1;
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
                    <form action='<?php if($_POST['VALIDER'] == 'modifier'){ echo "modifier_stock.php";}else{echo "ajout_stock.php";}?>' method='post'>
                    </p>
                        <label>livre</label>
                        <input type="text" name="Nom_livre" value = "<?php if($_POST['VALIDER'] == 'modifier'){echo $Titre;}?>">
                    </p>  
                    <p>
                        <label>Auteur</label>
                        <input type="text" name="Auteur" value = "<?php if($_POST['VALIDER'] == 'modifier'){echo $Auteur;}?>">
                    </p>
                    <p>
                        <label>Date de sortie</label>
                        <input type="text" name="Date_sortie" value = "<?php if($_POST['VALIDER'] == 'modifier'){echo $Date_sortie;}else{echo "YYYY-MM-DD";}?>">
                    </p>
                    <p>
                        <label>Description</label>
                        <input type="text" name="description" value = "<?php if($_POST['VALIDER'] == 'modifier'){echo $Description;}?>">
                    </p>
                        
                    <p>
                        <label>stock total</label>
                        <input type="text" name="Stock" value = "<?php if($_POST['VALIDER'] == 'modifier'){echo $Stock;}else{echo "5";}?>">
                    </p>
                        <input type = 'hidden' name = "ID" value ="<?php echo $ID_Book;?>">
                        <input type="submit" name="VALIDER" value="VALIDER">
                    </form>
                    <?php
                        if($_POST['VALIDER'] == 'modifier'){
                            echo    "<form action = 'supression_livre.php' method = 'post'>
                                        <input type = hidden name = 'ID' value = $ID_Book>
                                        <input type = 'submit' name = 'VALIDER' value = 'suprimer'>
                                     </form>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>