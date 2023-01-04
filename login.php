<?php
include('server.php');

$Wrong = 0;

session_start();
if(isset($_SESSION['ID'])){
    header('Location: ./mon_compte.php');
}


if(isset($_POST['CONECT'])){
    $Connect = mysqli_connect($Server,$User,$Pwd,$db);
    $Query = "SELECT `ID`,`ADMIN` FROM `utilisateur` WHERE `identifiant` = '";
    $Query .= $_POST['ID'] . "' and  `mot de passe` = '" . $_POST['PW'] ."'";

    $Result = $Connect->query ($Query);

    $Data = mysqli_fetch_array ($Result);
    if($Data != null){
        $_SESSION['ID'] = $Data[0];
        $_SESSION['ADMIN'] = $Data[1];
        $_SESSION['View'] = $_SESSION["ADMIN"];
        var_dump($_POST);
        header('Location: ./mon_compte.php');
    }else{
        $Wrong = 1;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>La Dinothèque</title>
        <link rel="stylesheet" href="Menu_fond.css">
        <link rel="stylesheet" href="login.css">
        <link rel="shortcut icon" type="image/x-icon" href="fichiers/dinosaur_logo.ico" />
    </head>
    <body>
        <div class = "Bar">
            <?php include('menu.php');?> 
        </div>
        <div class="corps">
            <div class="contenu">
                <!-- <form action = "connect_protocol.php" method = "post" > -->
                <form action = "" method = "post" >
                    <p>
                        <label>Se connecter</label>
                    </p>
                    <?php
                    if($Wrong){
                        echo "<p>Mauvais identifiant ou mot de passe</p>";
                    }
                    ?>
                    <p>
                        <label>identifiant</label>
                    </p>
                    </p>
                        <input type="text" name="ID" id="ID">
                    </p>
                    <p>
                        <label>mot de passe</label>
                    </p>
                    <p>
                        <input type="text" name="PW" id="PW">
                    </p>
                    <p>
                        <input type="submit" name="CONECT" value="Se connecter">
                    </p>
                </form>
            </div>
        </div>
    </body>
</html>