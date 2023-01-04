<?php
    $Titre = $_POST['Nom_livre'];
    $Auteur = $_POST['Auteur'];
    $Date_sortie = $_POST['Date_sortie'];
    $Description = $_POST['description'];

    $Stock = intval($_POST['Stock']);
    $ID = intval($_POST['ID']);

    include('server.php');
    $Connect = mysqli_connect($Server,$User,$Pwd,$db);

    $Query = "SELECT `Number`,`Available` FROM `stock` WHERE `ID_Book` = $ID";
    $Result = $Connect->query ($Query);
    $Data = mysqli_fetch_row ($Result);

    $New_Available = intval($Data[1]) + ($Stock-intval($Data[0]));

    $Query = "UPDATE `stock` SET `Number`= $Stock,`Available`= $New_Available  WHERE `ID_Book` = $ID ";
    $Result = $Connect->query ($Query);

    $Query = "UPDATE `livres` SET `Titre`= '$Titre',`Auteur`='$Auteur',`Date de sortie`='$Date_sortie',`description`= '$Description' WHERE `ID` = $ID ";
    $Result = $Connect->query ($Query);

    header('Location: ./gestion_stock.php');
?>