<?php 
    require_once(dirname(__FILE__)."/../backend/controllers/categoryController.php"); 
    $products=(new categoryController())->ProductsUnderCategory($_GET["catId"]);
    
    foreach ($products as $product) {
            $stdProduct=json_decode($product);
            $product=<<<"PRODUCT"
<div class="col-md-3 col-sm-6 hero-feature">
    <div class="thumbnail">
        <img src="{$stdProduct->prod_image}" alt=""> <!--http://placehold.it/800x500"-->
                    <div class="caption">
                        <h3>{$stdProduct->title}</h3>
                        <p>{$stdProduct->short_description}</p>
                        <p>
                            <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?prod_id={$stdProduct->prod_id}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
    </div>
</div>
PRODUCT;
    echo $product;
    }        
?>