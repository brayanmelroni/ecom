<?php 
    require_once(dirname(__FILE__)."/../../backend/controllers/categoryController.php"); 
    /**
    *  Information regarding products under a given category is retreived from categoryController class in json encoded format.
    *  It is decoded and a heredoc containing product information is created for each product. 
    *  Then it is displayed to the user. 
    */
    $products=(new categoryController())->ProductsUnderCategory($_GET["catId"]);
    
    foreach ($products as $product) {
            $stdProduct=json_decode($product);
            $product=<<<"PRODUCT"
<div class="col-md-3 col-sm-6 hero-feature">
    <div class="thumbnail">
        <img src="{$stdProduct->prod_image}" alt="" width="800" height="500">
                    <div class="caption">
                        <h3>{$stdProduct->title}</h3>
                        <p>{$stdProduct->short_description}</p>
                        <p>
                            <a href="item.php?prod_id={$stdProduct->prod_id}" class="btn btn-info">More Info</a>
                        </p>
                    </div>
    </div>
</div>
PRODUCT;
    echo $product;
    }        
?>