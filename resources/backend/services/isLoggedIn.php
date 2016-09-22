<?php
    
    /*
     * A service to check whether a user is Logged In
     */
     
    session_start();
    require_once("../controllers/userController.php");
    $userController=new userController();
    $status=json_encode($userController->isLoggedIn());
    echo $status;
?>



    