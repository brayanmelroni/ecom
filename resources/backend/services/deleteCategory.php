<?php
    session_start();
    require_once("../controllers/categoryController.php");
    
    $status=(new categoryController())->deleteCategory($_GET["del_cat"]);
    if($status==true)
        $_SESSION["message"]="Column was deleted";
    else
        $_SESSION["message"]="There are some orders for products under this category.Please deliver them first";
    echo "<script> history.go(-1);</script>";

?>