<?php
    require_once(dirname(__FILE__)."/..".DIRECTORY_SEPARATOR."entities/Database.php");

    /**
    * This class handles all the product related operations.
    * Front end views get all product related information via this controller class.
    */
    class productController{

        /**
        * @return array : all products' information in json encoded format
        */
        public function allProducts(){
            $productDescriptions=[];
            foreach ((new Database())->getAllProducts() as $product) {
                $productDescriptions[]=json_encode($product);
            }
            return $productDescriptions;
        }

        /**
        * @param $id
        * @return string : information about the product with given id in json encoded format
        */
        public function getProduct($id){
            return json_encode(Product::getProuductById($id));
        }

        /**
        * Finding the available quantity of a product with given id.
        * @param $id
        * @return mixed
        */
        public function getProductQuantity($id){
            return Product::getProuductById($id)->getQuantity();
        }

        /**
        * @param $id
        * @return string : title of the product with given id.
        */
        public function getProductTitle($id){
            return Product::getProuductById($id)->getTitle();
        }

        /**
        * getting the id of the category a product with given id belongs to.
        * @param $id
        * @return mixed
        */
        public function getProductCategory($id){
            return Product::getProuductById($id)->getCategoryId();
        }

        /**
        * changing the available quantity of a product
        * @param $id
        * @param $newQuantity
        * @return bool
        */
        public function findAndSetQuantity($id, $newQuantity){
            return Product::getProuductById($id)->setQuantity($newQuantity);
        }

        /**
        * deleting the product with given id
        * @param $prod_id
        * @return int
        */
        public function deleteProductById($prod_id){
            return Product::deleteProduct($prod_id);
        }

        /**
        * saving the product details
        * @param $title
        * @param $categoryId
        * @param $price
        * @param $long_description
        * @param $short_description
        * @param $prod_image
        * @param $quantity
        * @return bool|null
        */
        public function saveProduct($title, $categoryId, $price, $long_description, $short_description, $prod_image, $quantity){
            if($this->hasNullValues([$title,$categoryId,$price,$long_description,$short_description,$prod_image,$quantity])==false){
                return (new Product(null,$title,$categoryId,$price,$long_description,$short_description,$prod_image,$quantity))->save();
            }
            else
                return null;
        }

        /**
        * Updating the product details
        * @param $prod_id
        * @param $title
        * @param $categoryId
        * @param $price
        * @param $long_description
        * @param $short_description
        * @param $prod_image
        * @param $quantity
        * @return int
        */
        public function updateProduct($prod_id, $title, $categoryId, $price, $long_description, $short_description, $prod_image, $quantity){

            if($this->hasNullValues([$prod_id,$title,$categoryId,$price,$long_description,$short_description,$prod_image,$quantity])==false){
                $product=Product::getProuductById($prod_id);
                $product->setValues($title,$categoryId,$price,$long_description,$short_description,$prod_image,$quantity);
                return $product->update();
            }
        }

        /**
        * Helper function checking whether an array contains null values.
        * @param array $values
        * @return bool
        */
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
