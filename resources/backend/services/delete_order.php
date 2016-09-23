<?php
    
   
    require_once("../controllers/orderController.php");
    
    /**
    *  This PHP file executes deleteOrder function in orderController class and sets a message in current session.
    *  Then it is redirected to previous script/page. 
    */
    (new orderController())->deleteOrder($_GET["del_order"]);
    $_SESSION["message"]="Order number ".$_GET['del_order']." was successfully deleted";
    echo "<script> history.go(-1);</script>";
?>

