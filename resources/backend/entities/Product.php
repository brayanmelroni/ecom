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
        
        public function jsonSerialize() {
            return ["prod_id" => $this->prod_id, "title" => $this->title,
            "categoryId"=>$this->categoryId, "price"=>$this->price,
            "long_description"=>$this->long_description,"short_description"=>$this->short_description,
            "prod_image"=>$this->prod_image];
        }
        
        public function __construct($prod_id,$title,$categoryId,$price,$long_description,$short_description,$prod_image){
            $this->prod_id=$prod_id;
            $this->title=$title;
            $this->categoryId=$categoryId;
            $this->price=$price;
            $this->long_description=$long_description;
            $this->short_description=$short_description;
            $this->prod_image=$prod_image;
        }
        
        public static function getProuductById($prod_id){
            try{
                $statement=(new Database())->getConnection()->prepare("select * from product where prod_id = :id");
                $statement->setFetchMode(PDO::FETCH_OBJ);
                $statement->bindParam(":id", $prod_id);
                $statement->execute();
                $result = $statement->fetchAll();
                return new Product($result[0]->prod_id,$result[0]->title,$result[0]->categoryId,$result[0]->price,$result[0]->long_description,
                $result[0]->short_description,$result[0]->prod_image);
            }
            catch(PDOException $e){
                var_dump($e);
                die("Product not found");
            }
        }
        
        public static function getProductByCategory($catId){
                $products=[];
                try{
                $statement=(new Database())->getConnection()->prepare("select * from product where categoryId = :id");
                $statement->setFetchMode(PDO::FETCH_OBJ);
                $statement->bindParam(":id", $catId);
                $statement->execute();
                $results = $statement->fetchAll();
                foreach($results as $result){
                        $products[]=new Product($result->prod_id,$result->title,$result->categoryId,$result->price,$result->long_description,
                        $result->short_description,$result->prod_image);
                }
                return $products;
            }
            catch(PDOException $e){
                var_dump($e);
                die("Product not found");
            }
            
        }
        
        
        public function getProductId(){
            return $this->prod_id;
        }
        
        public function getProductTitle(){
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
    }
    
?>
