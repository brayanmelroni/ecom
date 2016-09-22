<?php
    require_once("Database.php");

    class Product implements JsonSerializable{
        private $prod_id;
        private $title;
        private $categoryId;
        private $price;
        public $long_description;
        private $short_description;
        private $prod_image;
        private $quantity;
        
        public function setValues($title,$categoryId,$price,$long_description,$short_description,$prod_image,$quantity){
            $this->title=$title;
            $this->categoryId=$categoryId;
            $this->price=$price;
            $this->long_description=$long_description;
            $this->short_description=$short_description;
            $this->prod_image=$prod_image;
            $this->quantity=$quantity;
        }
        
        public function jsonSerialize() {
            return ["prod_id" => $this->prod_id, "title" => $this->title,
            "categoryId"=>$this->categoryId, "price"=>$this->price,
            "long_description"=>$this->long_description,"short_description"=>$this->short_description,
            "prod_image"=>$this->prod_image,"quantity"=>$this->quantity];
        }
        
        public function __construct($prod_id,$title,$categoryId,$price,$long_description,$short_description,$prod_image,$quantity){
            $this->prod_id=$prod_id;
            $this->title=addslashes($title);
            $this->categoryId=$categoryId;
            $this->price=$price;
            $this->long_description=addslashes($long_description);
            $this->short_description=addslashes($short_description);
            $this->prod_image=$prod_image;
            $this->quantity=$quantity;
        }
        
        public function getProductId(){
            return $this->prod_id;
        }
        
        public function getTitle(){
            return $this->title;
        }
        
        public function getCategoryId(){
            return $this->categoryId;
        }
        
        public function getPrice(){
            return $this->price;
        }
        
        public function getLongDescription(){
            return $this->long_description;
        }
        
        public function getShortDescription(){
            return $this->short_description;
        }
        
        public function getImage(){
            return $this->prod_image;
        }
        
        public function getQuantity(){
            return $this->quantity;
        }
        
        public static function getProuductById($prod_id){
            $result = Database::executeSelectStatement("Product not found","select * from product where prod_id = :id", [":id"=>$prod_id]);
            return new Product($result[0]->prod_id, $result[0]->title, $result[0]->categoryId, $result[0]->price, $result[0]->long_description,
            $result[0]->short_description, $result[0]->prod_image, $result[0]->quantity);
        }

        public static function getProductByCategory($catId){
            $results = Database::executeSelectStatement("Product not found","select * from product where categoryId = :id", [":id"=>$catId]);
            $products = [];
            foreach ($results as $result) {
                $products[] = new Product($result->prod_id, $result->title, $result->categoryId, $result->price, $result->long_description,
                $result->short_description, $result->prod_image, $result->quantity);
            }
            return $products;
        }
        
        public function setQuantity($quantity){
            $this->quantity=$quantity;
            return Database::executeNonSelectStatement("Error in updating products",
            "update product set quantity= :quantity where prod_id= :prod_id",["quantity"=>$quantity,"prod_id"=>$this->prod_id]);
        }
        
        public function save(){
            return Database::executeNonSelectStatement("Product not saved","insert into product(title,categoryId, price,long_description,short_description,
            prod_image,quantity) values ('$this->title','$this->categoryId','$this->price','$this->long_description',
            '$this->short_description','$this->prod_image','$this->quantity')"); 
        }
        
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

