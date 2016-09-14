<?php
    require_once("Database.php");
    require_once("SQLSupport.php");
    
    class Product implements JsonSerializable{
        use SQLSupport;
        
        private $prod_id;
        private $title;
        private $categoryId;
        private $price;
        public $long_description;
        private $short_description;
        private $prod_image;
        private $quantity;
        
        public function jsonSerialize() {
            return ["prod_id" => $this->prod_id, "title" => $this->title,
            "categoryId"=>$this->categoryId, "price"=>$this->price,
            "long_description"=>$this->long_description,"short_description"=>$this->short_description,
            "prod_image"=>$this->prod_image,"quantity"=>$this->quantity];
        }
        
        public function __construct($prod_id,$title,$categoryId,$price,$long_description,$short_description,$prod_image,$quantity){
            $this->prod_id=$prod_id;
            $this->title=$title;
            $this->categoryId=$categoryId;
            $this->price=$price;
            $this->long_description=$long_description;
            $this->short_description=$short_description;
            $this->prod_image=$prod_image;
            $this->quantity=$quantity;
        }
        
        public static function getProuductById($prod_id){
            
            $result = Product::executeStatement("Product not found","select * from product where prod_id = :id", [":id"=>$prod_id]);
            return new Product($result[0]->prod_id, $result[0]->title, $result[0]->categoryId, $result[0]->price, $result[0]->long_description,
            $result[0]->short_description, $result[0]->prod_image, $result[0]->quantity);
        }

        public static function getProductByCategory($catId){
            
            $results = Product::executeStatement("Product not found","select * from product where categoryId = :id", [":id"=>$catId]);
            $products = [];
            foreach ($results as $result) {
                $products[] = new Product($result->prod_id, $result->title, $result->categoryId, $result->price, $result->long_description,
                $result->short_description, $result->prod_image, $result->quantity);
            }
            return $products;
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
        
        public function setQuantity($quantity){
            $this->quantity=$quantity;
            try{
                return (new Database())->getConnection()->exec("update product set quantity={$quantity} where prod_id={$this->prod_id}");
            }
            catch(PDOException $e){
                echo $e;
                die("Error in updating products");
            }
        }
        
        public static function deleteProduct($prod_id){
            try{
                $results = Product::executeStatement("Orders cannot be retreived","select * from orderLine where prod_id = :id", [":id"=>$prod_id]);
                if($results==null){
                    $connection=(new Database())->getConnection();
                    return $connection->exec("delete from product where prod_id='$prod_id'");
                }
                else{
                    return 0; 
                }
            }
            catch(PDOException $e){
                echo $e;
                die("Product not deleted.");
            }
        }
    }
    
/*   
    
    var_dump(Product::getProuductById(3));
   
    
   foreach (Product::getProductByCategory(1) as $product) {
        echo "<hr/>";
        var_dump($product);
        echo "<hr/>";
    };*/
    
     //Product::getProuductById(3)->setQuantity(28);

?>
