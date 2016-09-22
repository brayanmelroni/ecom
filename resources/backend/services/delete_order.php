<?php

    require_once("../controllers/orderController.php");
    (new orderController())->deleteOrder($_GET["del_order"]);
    $_SESSION["message"]="Order number ".$_GET['del_order']." was successfully deleted";
    echo "<script> history.go(-1);</script>";
?>

