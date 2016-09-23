<?php
  
    session_start();
    require_once("../controllers/userController.php");
    
    /**
    *  This PHP file executes isLoggedIn function in userController class.
    *  Then the status of whether a user is logged in or not is displayed in an json encoded format. 
    */
    $status=json_encode((new userController())->isLoggedIn());
    echo $status;
?>



    