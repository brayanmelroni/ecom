<?php
require_once("dbConfig.php");
require_once("Category.php");
require_once("Product.php");
require_once("SQLSupport.php");

class Database{
        use SQLSupport;
        private $connection;
        public function __construct(){
            try{
                $this->connection=new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=3306;charset=utf8",DB_USER,DB_PASS
                ,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
                $this->connection->exec("set names utf8");
                $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, TRUE);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e){
                var_dump($e);
                die("DB Connection failed");
            }
        }
        
        public function getConnection(){
            return $this->connection;
        }
        
        public function getAllCategories(){
            $categories=[];
            foreach(self::executeStatement("Categories not found","select * from category") as $result){
                $categories[]=new Category($result->catId,$result->catTitle);
            }
            return $categories;
        }
        
        public function getAllProducts(){
            $products=[];
            foreach(self::executeStatement("Products not found","select * from product") as $result){
                $products[]=new Product($result->prod_id,$result->title,$result->categoryId,$result->price,$result->long_description,
                $result->short_description,$result->prod_image,$result->quantity);
            }
            return $products;
        }
}

    //var_dump((new Database())->getAllCategories());
   /* 
    foreach ((new Database())->getAllProducts() as $product) {
        echo "<hr/>";
        var_dump($product);
        echo "<hr/>";
    }*/
?>
