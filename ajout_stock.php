<?php
    $Titre = $_POST['Nom_livre'];
    $Auteur = $_POST['Auteur'];
    $Date_sortie = $_POST['Date_sortie'];
    $Description = $_POST['description'];
    $Stock = intval($_POST['Stock']);
    $ID = intval($_POST['ID']);

    include('server.php');
    $Connect = mysqli_connect($Server,$User,$Pwd,$db);

    $Query = "INSERT INTO `livres` (`Titre`, `ID`, `Auteur`, `Date de sortie`, `description`) VALUES ('".$Titre."','".$ID."','".$Auteur."','".$Date_sortie."','".$Description."')";
    $Result = $Connect->query ($Query);

    $Query = "INSERT INTO `stock`(`ID_Book`, `Number`,`Available`) VALUES ($ID,$Stock,$Stock)";
    $Result = $Connect->query ($Query);

    header('Location: ./gestion_stock.php');
?>