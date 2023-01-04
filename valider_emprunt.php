<?php
    var_dump($_POST);
    $Date = date("Ymd");
    $Date_rendu = $Date + $_POST["temps_emprunt"];
    
    $ID_Member = $_POST["ID"];

    include('server.php');
    $Connect = mysqli_connect($Server,$User,$Pwd,$db);

    $Query = "SELECT `ID` FROM `livres` WHERE `Titre` = '".$_POST["livres"]."'";
    $Result = $Connect->query ($Query);
    $Data = mysqli_fetch_row ($Result);

    $ID_Book = $Data[0];

    $Query = "INSERT INTO `emprunts`(`ID_Member`, `ID_Book`, `Date`, `Return_date`) VALUES ($ID_Member,$ID_Book,$Date,$Date_rendu)";
    $Result = $Connect->query ($Query);

    $Query = "SELECT `Available` FROM `stock` WHERE `ID_Book` = $ID_Book";
    $Result = $Connect->query ($Query);
    $Data = mysqli_fetch_row ($Result);

    $Nombre = $Data[0] - 1;
    var_dump($Nombre);

    $Query = "UPDATE `stock` SET `Available`='$Nombre' WHERE `ID_Book`=$ID_Book";
    $Result = $Connect->query ($Query);
    if(isset($_POST['reservation'])){
        $Query = "DELETE FROM `reservation` WHERE `ID_Member`=$ID_Member and `ID_Book`=$ID_Book";
        $Result = $Connect->query ($Query);
    }
    header('Location: ./gestion_utilisateurs.php');
?>