<?php

    require_once(dirname(__FILE__)."/..".DIRECTORY_SEPARATOR."entities/Database.php");
    class categoryController{
        
        public function allCategories(){
            $jsonForAllCategories=[];
            $allCategories=(new Database())->getAllCategories();
            foreach ($allCategories as $category) {
                $jsonForAllCategories[]=json_encode($category);
            }
            return $jsonForAllCategories;
        }
        
        public function ProductsUnderCategory($catId){
            $jsonForProducts=[];
            $products=Product::getProductByCategory($catId);
            foreach ($products as $product) {
                $jsonForProducts[]=json_encode($product,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            }
            return $jsonForProducts;
        }
        
        public function getCategoryTitle($id){
          return Category::getCategoryById($id)->getCatTitle();
        }
       
        public function saveCategory($catTitle){
            if($catTitle!=null)
                return (new Category(null,$catTitle))->save();
            else
                return null;
        }
        
        public function deleteCategory($catId){
            return Category::deleteCategoryWhenIdGiven($catId);
        }
    }
    
?>




