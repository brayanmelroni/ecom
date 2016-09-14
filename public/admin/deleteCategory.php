<?php
    session_start();
    require_once(dirname(__FILE__)."/../../resources/backend/controllers/categoryController.php");
    $catController=new categoryController();
    $status=$catController->deleteCategory($_GET["del_cat"]);
    if($status==true)
        $_SESSION["message"]="Column was deleted";
    else
        $_SESSION["message"]="There are some orders for products under this category.Please deliver them first";
    echo "<script>window.location='"."categories.php"."'</script>";

?>