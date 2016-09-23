<?php
    session_start();
    require_once("../controllers/productController.php");
   
    /**
    *  This PHP file executes deleteProductById function in productController class and sets a message in current session based on
    *  the returned value. 
    *  Then it is redirected to previous script/page.  
    */
    $status=(new productController())-> deleteProductById($_GET["del_product"]);
    if($status!=0)
        $_SESSION["message"]="Product number ".$_GET['del_product']." was successfully deleted";
    else
        $_SESSION["message"]="There are existing orders for the product: ".$_GET['del_product'].". Please deliver the order before deleting the product.";
    
    echo "<script> history.go(-1);</script>";
    
?>
