<?php

    require_once(dirname(__FILE__)."/../backend/controllers/productController.php"); 
    $products=(new ProductController())->allProducts();
    foreach ($products as $product) {
        $stdProduct=json_decode($product);
        
        $productThumbnail=<<<"PRODUCT"
<div class="col-sm-4 col-lg-4 col-md-4">
    <div class="thumbnail">
        <a href="item.php?prod_id={$stdProduct->prod_id}"><img src="{$stdProduct->prod_image}" alt=""></a>
        <div class="caption">
            <h4 class="pull-right">&#163;{$stdProduct->price}</h4>
            <h4><a href="item.php?prod_id={$stdProduct->prod_id}">{$stdProduct->title}</a></h4>
            <p>{$stdProduct->short_description}</p>
            <a class="btn btn-primary" href="/resources/backend/controllers/proxyCartController.php?add={$stdProduct->prod_id}">Add to cart</a>
        </div>
    </div>
</div>
PRODUCT;
        echo $productThumbnail;
    }        
?>
