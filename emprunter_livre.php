<?php
session_start();
if(isset($_SESSION['ID']) == 0){
    header('Location: ./login.php');
}
//var_dump($_POST);

include('server.php');
$Connect = mysqli_connect($Server,$User,$Pwd,$db);

$Query = "SELECT `ID_Book` FROM `stock` WHERE `Available`>0";
$Result = $Connect->query ($Query);
$Data = mysqli_fetch_row ($Result);
$ID_Books = array();

while($Data != null){
    array_push($ID_Books,$Data[0]);
    $Data = mysqli_fetch_row ($Result);
}

$Livres = array();

for($i=0;$i<count($ID_Books);$i+=1){
    $Query = "SELECT `Titre` FROM `livres` WHERE ID =".$ID_Books[$i];
    $Result = $Connect->query ($Query);
    $Data = mysqli_fetch_row ($Result);

    array_push($Livres,$Data[0]);
}

$ID = $_POST["ID"];
$Nom = $_POST["Nom"]
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
                        echo "Faire un emprunt pour $Nom";
                    ?>
                    <form id = 'emprunt' method= 'post' action='valider_emprunt.php'>
                        <input type= 'hidden' name = 'ID' value ='<?php echo"$ID"?>'>
                        <div>
                        <label for = "livres">livres</label>
                        <select name="livres" id="livres">
                            <?php
                                for($i=0;$i<count($Livres);$i+=1){
                                    echo "<option value = '".$Livres[$i]."'>".$Livres[$i]."</option>";
                                }
                            ?>
                        </select>
                        </div>
                        <div>
                        <label for='jours'>Jours d'emprunt</label>
                        <input type='number' value = 7 id = 'jours' name = 'temps_emprunt'>
                        </div>
                        <input type= 'submit' value = valider>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>