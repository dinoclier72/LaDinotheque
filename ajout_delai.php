<?php
    if(isset($_POST['VALIDER']) == 0){
        header('Location: ./gestion_emprunts.php');
    }
    $ID_membre = intval($_POST['ID_Member']);
    $ID_livre = intval($_POST['ID_Book']);
    $return_date = intval($_POST['return_date']) + intval($_POST['ADDED_TIME']);
    var_dump($ID_membre);
    var_dump($ID_livre);
    var_dump($return_date);

    include('server.php');
    $Connect = mysqli_connect($Server,$User,$Pwd,$db);

    $Query = "UPDATE `emprunts` SET `Return_date`= $return_date WHERE `ID_Book` = $ID_livre and `ID_Member` = $ID_membre";

    $Result = $Connect->query ($Query);

    header('Location: ./gestion_emprunts.php');
?>