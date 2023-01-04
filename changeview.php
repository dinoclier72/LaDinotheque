<?php
session_start();
if($_SESSION['View']){
    $_SESSION['View'] = 0;
}else{
    $_SESSION['View'] = 1;
}
header('Location: ./mon_compte.php');
?>