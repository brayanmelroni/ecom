<?php
require_once(dirname(__FILE__)."/..".DIRECTORY_SEPARATOR."entities/Database.php");
class productController{
    
    public function allProducts(){
        $allProducts=(new Database())->getAllProducts();
        $productDescriptions=[];
        foreach ($allProducts as $product) {
            $productDescriptions[]=json_encode($product);
        }
        return $productDescriptions; 
    }
     
    public function getProduct($id){
          return json_encode(Product::getProuductById($id));
    }
     
    public function getProductQuantity($id){
         return Product::getProuductById($id)->getQuantity();
    }
    
    public function getProductTitle($id){
        return Product::getProuductById($id)->getTitle();
    }
    
    public function getProductCategory($id){
        return Product::getProuductById($id)->getCategoryId();
    }
    
    public function findAndSetQuantity($id,$newQuantity){
        return Product::getProuductById($id)->setQuantity($newQuantity);
    }
    
    public function deleteProductById($prod_id){
        return Product::deleteProduct($prod_id);
    }
}
    //var_dump((new ProductController())->deleteProductById(4));
    
    //(new ProductController())->findAndSetQuantity(2,12); 
    
?>