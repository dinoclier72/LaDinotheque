<?php
    include('server.php');
    $Connect = mysqli_connect($Server,$User,$Pwd,$db);

    //var_dump($_POST);

    $identifiant = $_POST["identifiant"];
    $ID = $_POST["ID"];
    $NOMS = explode(" ",$_POST["Nom"]);

    $Prenom = $NOMS[0];
    $Nom = $NOMS[1];
    $Mail = $_POST["Mail"];

    $MDP = $_POST["MDP"];

    if(isset($_POST["ADMIN"])){
        $ADMIN = 1;
    }else{
        $ADMIN = 0;
    }

    $Query = "INSERT INTO `utilisateur`(`identifiant`, `ID`, `Nom`, `prenom`, `mail`, `mot de passe`, `ADMIN`) VALUES ('$identifiant',$ID,'$Nom','$Prenom','$Mail','$MDP',$ADMIN)";
    var_dump($Query);
    $Result = $Connect->query ($Query);

    header('Location: ./gestion_utilisateurs.php');
?>