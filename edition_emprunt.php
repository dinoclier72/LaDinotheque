<?php
    session_start();
    if(isset($_POST['VALIDER']) == 0){
        header('Location: ./gestion_emprunts.php');
    }

    include('server.php');

    $ID_Member = intval($_POST['ID_Member']);
    $ID_Book = intval($_POST['ID_Book']);
    $Connect = mysqli_connect($Server,$User,$Pwd,$db);
    $Query = "SELECT * FROM `emprunts` WHERE `ID_Member` = $ID_Member and `ID_Book` = $ID_Book";
    $Result = $Connect->query ($Query);
    $Data = mysqli_fetch_row ($Result);

    $Query = "SELECT `Titre` FROM `livres` WHERE ID =".$Data[1];
    $Result = $Connect->query ($Query);
    $BookT = mysqli_fetch_row ($Result);
    array_push($Data,$BookT[0]);
    $Query = "SELECT `prenom`,`Nom` FROM `utilisateur` WHERE ID =".$Data[0];
    $Result = $Connect->query ($Query);
    $Names = mysqli_fetch_row ($Result);
    $Nom = $Names[0]." ".$Names[1];
    array_push($Data, $Nom);
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
                    <ul>
                        <li>Membre: <?php echo $Data[5]?></li>
                        <li>Livre: <?php echo $Data[4]?></li>
                        <li>Date d'emprunt: <?php echo $Data[2]?></li>
                        <li>Date max de rendu: <?php echo $Data[3]?></li>
                    </ul>
                    <form action='rendu_livre.php' method='post'>
                        <input type= 'hidden' name='ID_Member' value = <?php echo $Data[0]?>>
                        <input type= 'hidden' name='ID_Book' value = <?php echo $Data[1]?>>
                        <input type= 'hidden' name='date' value = <?php echo $Data[2]?>>
                        <input type= 'hidden' name='return_date' value = <?php echo $Data[3]?>>
                        <input type='submit' name='VALIDER' value = 'confirmer le rendu'>
                    </form>
                    <form action='ajout_delai.php' method='post'>
                        <input type= 'hidden' name='ID_Member' value = <?php echo $Data[0]?>>
                        <input type= 'hidden' name='ID_Book' value = <?php echo $Data[1]?>>
                        <input type= 'hidden' name='return_date' value = <?php echo $Data[3]?>>
                        <input type='number' name = "ADDED_TIME" value= 7>
                        <input type='submit' name='VALIDER' value = 'ajouter un délai'>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>