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
            <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
            <a class="btn btn-primary" target="_blank" href="">Add to cart</a>
        </div>
    </div>
</div>
PRODUCT;
        echo $productThumbnail;
    }        
?>
 