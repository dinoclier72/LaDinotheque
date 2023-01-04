<?php
    include('server.php');
    $Connect = mysqli_connect($Server,$User,$Pwd,$db);

    
    $Query = "SELECT * FROM `articles` WHERE 1 ORDER BY `ID` DESC";
    $Result = $Connect->query ($Query);

    $Table = array();
    $Data = mysqli_fetch_row ($Result);

    while ($Data != NULL){
        array_push($Table, $Data);
        $Data = mysqli_fetch_row ($Result);
    }
?>
<DOCTYPE html>
<html lang="fr">
    <head>
        <link rel="stylesheet" href="Menu_fond.css">
        <title>La Dinotheque</title>
        <link rel="shortcut icon" type="image/x-icon" href="fichiers/dinosaur_logo.ico" />
    </head>
    <body>
        <div class = "Bar">
            <?php include('menu.php');?> 
        </div>
        <div class="corps">
            <div class="contenu">
                <?php
                    echo "<table>
                            <thead>
                                <th>photo</th>
                                <th>Titre</th>
                                <th>contenu</th>
                            </thead>";
                    echo "<tbody>";
                    $i = 0;
                    for($i=0;$i<count($Table);$i+=1){
                        echo "<tr>";
                        echo "<td></td>";
                        $Titre = $Table[$i][0];
                        echo "<td>$Titre</td>";
                        $Contenu=$Table[$i][1];
                        echo "<td>$Contenu</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                ?>
            </div>
        </div>
    </body>
</html>