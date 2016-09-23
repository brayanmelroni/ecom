<?php
require_once("Database.php");

    /**
    * Entity Class representing Product table in the database.
    * This class is only accessed by a controller class or other entity class. 
    */
    class Product implements JsonSerializable{
        private $prod_id;
        private $title;
        private $categoryId;
        private $price;
        public $long_description;
        private $short_description;
        private $prod_image;
        private $quantity;
    
        /**
        * Product constructor.
        * @param $prod_id
        * @param $title
        * @param $categoryId
        * @param $price
        * @param $long_description
        * @param $short_description
        * @param $prod_image
        * @param $quantity
        */
        public function __construct($prod_id, $title, $categoryId, $price, $long_description, $short_description, $prod_image, $quantity){
            $this->prod_id=$prod_id;
            $this->title=addslashes($title);
            $this->categoryId=$categoryId;
            $this->price=$price;
            $this->long_description=addslashes($long_description);
            $this->short_description=addslashes($short_description);
            $this->prod_image=$prod_image;
            $this->quantity=$quantity;
        }
    
    
        /**
        * Setting the properties of a product
        * @param $title
        * @param $categoryId
        * @param $price
        * @param $long_description
        * @param $short_description
        * @param $prod_image
        * @param $quantity
        */
        public function setValues($title, $categoryId, $price, $long_description, $short_description, $prod_image, $quantity){
            $this->title=$title;
            $this->categoryId=$categoryId;
            $this->price=$price;
            $this->long_description=$long_description;
            $this->short_description=$short_description;
            $this->prod_image=$prod_image;
            $this->quantity=$quantity;
        }
    
        /**
        * @return array : representation of a product
        */
        public function jsonSerialize() {
            return ["prod_id" => $this->prod_id, "title" => $this->title,
            "categoryId"=>$this->categoryId, "price"=>$this->price,
            "long_description"=>$this->long_description,"short_description"=>$this->short_description,
            "prod_image"=>$this->prod_image,"quantity"=>$this->quantity];
        }
    
        /**
        * @return mixed : the product id of the product
        */
        public function getProductId(){
            return $this->prod_id;
        }
    
        /**
        * @return string : the title of a product
        */
        public function getTitle(){
            return $this->title;
        }
    
        /**
        * @return mixed : the category Id of a product
        */
        public function getCategoryId(){
            return $this->categoryId;
        }
    
    
        /**
        * @return mixed : the price of a product
        */
        public function getPrice(){
            return $this->price;
        }
    
        /**
        * @return string : the long description about a product
        */
        public function getLongDescription(){
            return $this->long_description;
        }
    
        /**
        * @return string : the short description about a product
        */
        public function getShortDescription(){
            return $this->short_description;
        }
    
        /**
        * @return mixed : the image of a product
        */
        public function getImage(){
            return $this->prod_image;
        }
    
        /**
        * @return mixed : the available quantity for a product.
        */
        public function getQuantity(){
            return $this->quantity;
        }
    
    
        /** Selecting a product based on the product id.
        * @param $prod_id
        * @return Product
        */
        public static function getProuductById($prod_id){
            $result = Database::executeSelectStatement("Product not found","select * from product where prod_id = :id", [":id"=>$prod_id]);
            return new Product($result[0]->prod_id, $result[0]->title, $result[0]->categoryId, $result[0]->price, $result[0]->long_description,
                $result[0]->short_description, $result[0]->prod_image, $result[0]->quantity);
        }
    
        /** Selecting products categorised under a given category Id.
        * @param $catId
        * @return array
        */
        public static function getProductByCategory($catId){
            $results = Database::executeSelectStatement("Product not found","select * from product where categoryId = :id", [":id"=>$catId]);
            $products = [];
            foreach ($results as $result) {
                $products[] = new Product($result->prod_id, $result->title, $result->categoryId, $result->price, $result->long_description,
                    $result->short_description, $result->prod_image, $result->quantity);
            }
            return $products;
        }
    
        /** Changing the quantity of a product
        * @param $quantity
        * @return bool
        */
        public function setQuantity($quantity){
            $this->quantity=$quantity;
            return Database::executeNonSelectStatement("Error in updating products",
                "update product set quantity= :quantity where prod_id= :prod_id",["quantity"=>$quantity,"prod_id"=>$this->prod_id]);
        }
    
        /** Saving information about a product to the database. 
        * @return bool
        */
        public function save(){
            return Database::executeNonSelectStatement("Product not saved","insert into product(title,categoryId, price,long_description,short_description,
                prod_image,quantity) values ('$this->title','$this->categoryId','$this->price','$this->long_description',
                '$this->short_description','$this->prod_image','$this->quantity')");
        }
    
    
        /** Deleting a product with given product id. 
        * @param $prod_id
        * @return int
        */
        public static function deleteProduct($prod_id){
    
            $results = Database::executeSelectStatement("Orders cannot be retreived","select * from orderLine where prod_id = :id", [":id"=>$prod_id]);
            if($results==null){
                $prod_image= Database::executeSelectStatement("Image not found","select prod_image from product where prod_id= :id", [":id"=>$prod_id]);
                unlink($prod_image);
                Database::executeNonSelectStatement("Product not deleted","delete from product where prod_id= :prod_id",[":prod_id"=>$prod_id]);
                return 1;
            }
            else
                return 0;
        }
    
        /** Updating product information. 
        * @return int
        */
        public function update(){
            Database::executeNonSelectStatement("Product not updated","update product set title= :title, categoryId= :categoryId, 
                price = :price, long_description = :long_description, short_description= :short_description, prod_image= :prod_image, 
                quantity = :quantity where prod_id= :prod_id",
                [":title"=>$this->title,":categoryId"=>$this->categoryId,":price"=>$this->price,":long_description"=>$this->long_description,
                    ":short_description"=>$this->short_description,":prod_image"=>$this->prod_image,":quantity"=>$this->quantity,
                    ":prod_id"=>$this->prod_id]);
            return 1;
        }
    }

?>