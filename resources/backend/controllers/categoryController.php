<?php

    require_once(dirname(__FILE__)."/..".DIRECTORY_SEPARATOR."entities/Database.php");
    /**
    * This class handles all the category related operations.
    * Front end views get all category related information via this controller class.
    */
    class categoryController{

        /**
        * @return array:  all category's information in json encoded format
        */
        public function allCategories(){
            $jsonForAllCategories=[];
            $allCategories=(new Database())->getAllCategories();
            foreach ($allCategories as $category) {
                $jsonForAllCategories[]=json_encode($category);
            }
            return $jsonForAllCategories;
        }

        /**
        * @param $catId
        * @return array: information about all the products under a given category id in json encoded format
        */
        public function ProductsUnderCategory($catId){
            $jsonForProducts=[];
            $products=Product::getProductByCategory($catId);
            foreach ($products as $product) {
                $jsonForProducts[]=json_encode($product,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            }
            return $jsonForProducts;
        }

        /**
        * @param $id
        * @return string : title of the Category with given id. 
        */
        public function getCategoryTitle($id){
            return Category::getCategoryById($id)->getCatTitle();
        }

        /**
        * Saving information about a Category
        * @param $catTitle
        * @return mixed|null
        */
        public function saveCategory($catTitle){
            if($catTitle!=null)
                return (new Category(null,$catTitle))->save();
            else
                return null;
        }

        /**
        * Deleting a category with a given category id. 
        * @param $catId
        * @return bool
        */
        public function deleteCategory($catId){
            return Category::deleteCategoryWhenIdGiven($catId);
        }
    }

?>





