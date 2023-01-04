<?php
    session_start();
    if(isset($_SESSION['ID']) == 0){
        header('Location: ./login.php');
    }

    include('server.php');

    $Connect = mysqli_connect($Server,$User,$Pwd,$db);  
    if(isset($_POST['ID'])==0){
        $ID = $_SESSION['ID'];
    }else{
        $ID = $_POST['ID'];
    }
    $Query = "SELECT * FROM `carte` WHERE `ID`=".$ID;
    $Result = $Connect->query ($Query);
    $Data = mysqli_fetch_array ($Result);
    var_dump($Data);
    if(isset($Data)){
        $Query = "DELETE FROM `carte` WHERE `ID`=".$ID;
    }else{
        $ID = intval($ID);
        $Date = date("Ymd")+10000;

        $Query = "INSERT INTO `carte`(`ID`, `valide`) VALUES ($ID,$Date)";
        echo "pattae";
    }
    $Result = $Connect->query ($Query);
    if(isset($_POST['ID'])==0){
        header('Location: ./ma_carte.php');
    }else{
        header('Location: ./gestion_utilisateurs.php');
    }
?>

