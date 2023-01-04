<?php
    if(isset($_POST['VALIDER']) == 0){
        header('Location: ./gestion_emprunts.php');
    }
    $ID_membre = intval($_POST['ID_Member']);
    $ID_livre = intval($_POST['ID_Book']);
    var_dump($ID_membre);
    var_dump($ID_livre);

    $Date = intval($_POST['date']);
    $Return_Date = date("Ymd");

    include('server.php');
    $Connect = mysqli_connect($Server,$User,$Pwd,$db);

    $Query = "DELETE FROM `emprunts` WHERE `ID_Member` = $ID_membre and `ID_Book` = $ID_livre";
    $Result = $Connect->query ($Query);

    $Query = "SELECT `Available` FROM `stock` WHERE `ID_Book` = $ID_livre";
    $Result = $Connect->query ($Query);
    $Data = mysqli_fetch_row ($Result);

    $New_stock = intval($Data[0])+1;

    $Query = "UPDATE `stock` SET `Available`= $New_stock WHERE `ID_Book` = $ID_livre";
    $Result = $Connect->query ($Query);

    $Query = "INSERT INTO `historique`(`ID_Member`, `ID_Book`, `Date`, `Return_date`) VALUES ($ID_membre,$ID_livre,$Date,$Return_Date)";
    $Result = $Connect->query ($Query);

    header('Location: ./gestion_emprunts.php');
?>