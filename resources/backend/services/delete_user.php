<?php
    session_start();
    require_once("../controllers/userController.php");
    /**
    *  This PHP file executes deleteUser function in userController class and sets a message in current session based on the 
    *  returned value.
    *  Then it is redirected to previous script/page.  
    */
    $status=(new userController())-> deleteUser($_GET["del_user"]);
    if($status==true)
        $_SESSION["message"]="User ".$_GET['del_user']." was successfully deleted";
    else
        $_SESSION["message"]="User could not be deleted";
    
    echo "<script> history.go(-1);</script>";
?>
