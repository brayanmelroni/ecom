<?php
    session_start();
    require_once("../controllers/userController.php");
    $status=(new userController())-> deleteUser($_GET["del_user"]);
    if($status==true)
        $_SESSION["message"]="User ".$_GET['del_user']." was successfully deleted";
    else
        $_SESSION["message"]="User could not be deleted";
    
    echo "<script> history.go(-1);</script>";
?>
