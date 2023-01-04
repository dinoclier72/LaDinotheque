<?php
    session_start();
    var_dump($_POST);
    $ID_Member = $_SESSION['ID'];
    $ID_Book = $_POST["ID_Book"];

    include('server.php');
    $Connect = mysqli_connect($Server,$User,$Pwd,$db);

    $Query = "INSERT INTO `reservation`(`ID_Member`, `ID_Book`) VALUES ($ID_Member,$ID_Book)";
    $Result = $Connect->query ($Query);

    $Query = "SELECT `Available` FROM `stock` WHERE `ID_Book` = $ID_Book";
    $Result = $Connect->query ($Query);
    $Data = mysqli_fetch_row ($Result);

    $N_available = $Data[0]-1;

    $Query = "UPDATE `stock` SET `Available`= $N_available WHERE `ID_Book` = $ID_Book";
    $Result = $Connect->query ($Query);

    header('Location: ./les_livres.php');
?>