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
    
    public function saveProduct($title,$categoryId,$price,$long_description,$short_description,$prod_image,$quantity){
        if($title !=null && $categoryId!=null && $price !=null && $long_description !=null && $short_description !=null && prod_image !=null
        && quantity!=null){
            return (new Product(null,$title,$categoryId,$price,$long_description,$short_description,$prod_image,$quantity))->save();
        }
        else 
            return null;
    }
    
    public function updateProduct($prod_id,$title,$categoryId,$price,$long_description,$short_description,$prod_image,$quantity){
        
        if($prod_id !=null && $title !=null && $categoryId!=null && $price !=null && $long_description !=null && $short_description !=null && prod_image !=null
        && quantity!=null){
            $product=Product::getProuductById($prod_id);
            $product->setValues($title,$categoryId,$price,$long_description,$short_description,$prod_image,$quantity);
            return $product->update();
        }
    }
    
    
}
    //var_dump((new productController())->saveCategory("a",1,23.89,"Long description","Short description","image",2));
    
    //var_dump((new ProductController())->deleteProductById(4));
    
    //(new ProductController())->findAndSetQuantity(2,12); 
    
    //var_dump((new productController())->updateProduct(12,"Batman",2,5.00,"long descrip","short descrip","product Img",1000));
    
    
?>