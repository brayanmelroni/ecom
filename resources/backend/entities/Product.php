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
        
        public function save(){
            try{
                return (new Database())->getConnection()->exec("insert into product(title,categoryId, price,long_description,short_description,
                prod_image,quantity) values('{$this->title}','{$this->categoryId}','$this->price','$this->long_description',
                '$this->short_description','$this->prod_image','$this->quantity')");
            }
            catch(PDOException $e){
                echo $e;
                die("Category not saved.");
            }
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
                    $prod_image= Product::executeStatement("Image not found","select prod_image from product where prod_id= :id", [":id"=>$prod_id]);
                    unlink($prod_image);
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
        
        public function update(){
            try{
                return (new Database())->getConnection()->exec("update product set title='$this->title',categoryId='$this->categoryId',price='$this->price',long_description='$this->long_description',
                short_description='$this->short_description',prod_image='$this->prod_image', quantity='$this->quantity' where prod_id='$this->prod_id';");
            }
            catch(PDOException $e){
                echo $e;
                die("Product not updated.");
            }
        }
        
        
    }
 
     //unlink("resources/uploads/text.png"); 
    
  //  $product=new Product(20,"Laravel",2,44.99,"The most famous MVC framework","Laravel PHP","this image",5);
//    $product->save();
  //  Product::deleteProduct(20);
    
  /*  $product=new Product(14,"Laravel",2,44.99,"The most famous MVC framework","Laravel PHP","this image",5);
    $product->hack();
    var_dump($product->update());
    
    public function hack(){
            $this->title="Hacked1";
            $this->categoryId=1;
            $this->price="22.36";
            $this->long_description="Hacked2";
            $this->short_description="Hacked3";
            $this->prod_image="Hacked4";
            $this->quantity=3000;
        }
/*   
    
    var_dump(Product::getProuductById(3));
   
    
   foreach (Product::getProductByCategory(1) as $product) {
        echo "<hr/>";
        var_dump($product);
        echo "<hr/>";
    };*/
    
     //Product::getProuductById(3)->setQuantity(28);


/*
       
        
                // 2 thiyena product eke hoya ganna. Eka setup karanna. update call karanna. 
                //update product set title='Dummy',categoryId='2',price='34.45',long_description='long description',
short_description='short_description',prod_image='prod_image', quantity='789' where prod_id=13; 

*/
?>
