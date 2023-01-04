<?php
if(isset($_POST['VALIDER']) == 0){
    header('Location: ./gestion_stock.php');
}
var_dump($_POST);
$ID_livre = intval($_POST['ID']);

include('server.php');
$Connect = mysqli_connect($Server,$User,$Pwd,$db);

$Query = "DELETE FROM `livres` WHERE `ID` = $ID_livre";
$Result = $Connect->query ($Query);

$Query = "DELETE FROM `stock` WHERE `ID_Book` = $ID_livre";
$Result = $Connect->query ($Query);

header('Location: ./gestion_stock.php');

?>