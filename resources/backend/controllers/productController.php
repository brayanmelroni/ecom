<?php
require_once(dirname(__FILE__)."/..".DIRECTORY_SEPARATOR."entities/Database.php");
class productController{
    
    public function allProducts(){
        $productDescriptions=[];
        foreach ((new Database())->getAllProducts() as $product) {
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
    
    public function saveProduct($title,$categoryId,$price,$long_description,$short_description,$prod_image,$quantity){
        if($this->hasNullValues([$title,$categoryId,$price,$long_description,$short_description,$prod_image,$quantity])==false){
            return (new Product(null,$title,$categoryId,$price,$long_description,$short_description,$prod_image,$quantity))->save();
        }
        else 
            return null;
    }
    
    public function updateProduct($prod_id,$title,$categoryId,$price,$long_description,$short_description,$prod_image,$quantity){
       
        if($this->hasNullValues([$prod_id,$title,$categoryId,$price,$long_description,$short_description,$prod_image,$quantity])==false){
            $product=Product::getProuductById($prod_id);
            $product->setValues($title,$categoryId,$price,$long_description,$short_description,$prod_image,$quantity);
            return $product->update();
        }
    }
    
    private function hasNullValues(array $values){
        $hasNull=false;
        foreach ($values as $value) {
            if($value==null){
                $hasNull=true;
                break;
            }
        }
        return $hasNull;
    }
    
}

?>