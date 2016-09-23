<?php
require_once("dbConfig.php");
require_once("Category.php");
require_once("Product.php");
require_once("User.php");
require_once("SQLSupport.php");

    /**
    * Entity Class representing the database. 
    * This class is only accessed by a controller class or other entity class. 
    */
    class Database{
        use SQLSupport;
        private $connection;
    
    
        /**
        * Database constructor.
        */
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
    
    
        /**
        * @return a PDO object
        */
        public function getConnection(){
            return $this->connection;
        }
    
    
        /**
        * @return array: all the categories 
        */
        public function getAllCategories(){
            $categories=[];
            foreach(self::executeSelectStatement("Categories not found","select * from category") as $result){
                $categories[]=new Category($result->catId,$result->catTitle);
            }
            return $categories;
        }
    
        /**
        * @return array: all the products 
        */
        public function getAllProducts(){
            $products=[];
            foreach(self::executeSelectStatement("Products not found","select * from product") as $result){
                $products[]=new Product($result->prod_id,$result->title,$result->categoryId,$result->price,$result->long_description,
                    $result->short_description,$result->prod_image,$result->quantity);
            }
            return $products;
        }
    
        /**
        * @return array: all the users
        */
        public function getAllUsers(){
            $users=[];
            foreach(self::executeSelectStatement("Users not found","select * from user") as $result){
                $users[]=new User($result->user_id,$result->first_name,$result->last_name,$result->address1,$result->address2,
                    $result->city,$result->state,$result->zip,$result->username,$result->password,$result->user_group,$result->email);
            }
            return $users;
        }

    }
?>