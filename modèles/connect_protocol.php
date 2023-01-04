<?php
$Server = "localhost";
$User =  "e191136";
$Pwd = "Fqe741tf";
$db = "e191136";

$Connect = mysqli_connect($Server,$User,$Pwd,$db);

$Query = "SELECT `identifiant`,`mot de passe` FROM `utilisateur` WHERE `identifiant` = ? and `mot de passe` = ?" ;
echo  "un message je crois \n" ;
$Result = $Connect->query ($Query);

while ($Data = mysqli_fetch_array ($Result) ) 
{ 
    echo "<p>Nom d'utilisateur :  $Data[0], Mot de passe : $Data[1] \n</p>"; 
}
?>

