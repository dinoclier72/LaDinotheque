<?php
    var_dump($_POST);
    $ID_Member = $_POST["ID_Member"];
    $ID_Book = $_POST["ID_Book"];

    include('server.php');
    $Connect = mysqli_connect($Server,$User,$Pwd,$db);

    $Query = "DELETE FROM `reservation` WHERE `ID_Member`=$ID_Member and `ID_Book`=$ID_Book";
    $Result = $Connect->query ($Query);

    $Query = "SELECT `Available` FROM `stock` WHERE `ID_Book` = $ID_Book";
    $Result = $Connect->query ($Query);
    $Data = mysqli_fetch_row ($Result);

    $N_available = $Data[0]+1;

    $Query = "UPDATE `stock` SET `Available`= $N_available WHERE `ID_Book` = $ID_Book";
    $Result = $Connect->query ($Query);

    if(isset($_POST["flag"])==0){
        header('Location: ./gestion_utilisateurs.php');
    }else{
        header('Location: ./mes_reservation.php');
    }
?>