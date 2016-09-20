<?php
    session_start();
    require_once(dirname(__FILE__)."/../../resources/backend/controllers/productController.php");
    $status=(new productController())-> deleteProductById($_GET["del_product"]);
    if($status!=0){
        $_SESSION["message"]="Product number ".$_GET['del_product']." was successfully deleted";
    }
    else{
        $_SESSION["message"]="There are existing orders for the product: ".$_GET['del_product'].". Please deliver the order before deleting the 
        product.";
    }
    echo "<script>window.location='"."products.php"."'</script>";
    
?>
