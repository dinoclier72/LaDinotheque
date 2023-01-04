<?php
    var_dump($_POST);
    include('server.php');
    $Connect = mysqli_connect($Server,$User,$Pwd,$db);

    $Titre= $_POST["Titre"];
    $Contenu = $_POST["contenu"];

    $Query = "SELECT Max(`ID`) FROM `articles` WHERE 1";
    $Result = $Connect->query ($Query);
    $Data = mysqli_fetch_row ($Result);

    $ID = $Data[0]+1;

    $Query = "INSERT INTO `articles`(`Titre`, `contenu`, `image`, `ID`) VALUES ('$Titre','$Contenu','0','$ID')";
    $Result = $Connect->query ($Query);
    header('Location: ./mon_compte.php');
?>