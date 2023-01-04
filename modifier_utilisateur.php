<?php
    //var_dump($_POST);

    include('server.php');
    $Connect = mysqli_connect($Server,$User,$Pwd,$db);

    $identifiant = $_POST["identifiant"];
    $ID = $_POST["ID"];
    $NOMS = explode(" ",$_POST["Nom"]);

    $Prenom = $NOMS[0];
    $Nom = $NOMS[1];
    $Mail = $_POST["Mail"];

    if(isset($_POST["ADMIN"])){
        $ADMIN = 1;
    }else{
        $ADMIN = 0;
    }

    $Query = "UPDATE `utilisateur` SET `identifiant`='$identifiant',`Nom`='$Nom',`prenom`='$Prenom',`mail`='$Mail',`ADMIN`='$ADMIN' WHERE `ID`=$ID";
    var_dump($Query);
    $Result = $Connect->query ($Query);

    header('Location: ./gestion_utilisateurs.php');
?>