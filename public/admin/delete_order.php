<?php
    require_once(dirname(__FILE__)."/../../resources/backend/controllers/orderController.php");
    (new orderController())->deleteOrder($_GET["del_order"]);
    $_SESSION["message"]="Order number ".$_GET['del_order']." was successfully deleted";
    echo "<script>window.location='"."orders.php"."'</script>";
?>

