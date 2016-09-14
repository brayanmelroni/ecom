<?php
    require_once("Database.php");
    require_once("SQLSupport.php");
    class Category implements JsonSerializable{
        use SQLSupport;
        private $catId; 
        private $catTitle;

        public function __construct($catId,$catTitle){
            $this->catId=$catId;
            $this->catTitle=$catTitle;
        }
        
        public function getCatId(){
            return $this->catId;
        }
        public function getCatTitle(){
            return $this->catTitle;
        }
        
        public function jsonSerialize() {
            return ["catId" => $this->catId, "catTitle" => $this->catTitle];
        }
        
        public static function getCategoryById($id){
            $result = Category::executeStatement("Category not found","select * from category where catId = :id",[":id"=>$id]);
            return new Category($result[0]->catId,$result[0]->catTitle);
        }
        
        public function save(){
            try{
                (new Database())->getConnection()->exec("insert into category (catTitle) values('{$this->catTitle}')");
                $result = Category::executeStatement("Category not found","select catId from category where catTitle = :title",[":title"=>$this->catTitle]);
                $this->catId=$result[0]->catId;
            }
            catch(PDOException $e){
                echo $e;
                die("Category not saved.");
            }
            return $result[0]->catId;
        }
        
        public static function deleteCategoryWhenIdGiven($catId){
          
            $result = Category::executeStatement("Orders cannot be checked","select distinct p.prod_id from (select prod_id from product where categoryId= :catId) p join orderLine o on p.prod_id=o.prod_id",[":catId"=>$catId]);
            if($result==null){
                try{
                    $connection=(new Database())->getConnection();
                    $connection->exec("delete from product where categoryId='$catId'"); 
                    $connection->exec("delete from category where catId='$catId'");
                }
                catch(PDOException $e){
                    echo $e;
                    die("Category not deleted.");
                }
                return true;
            }
            else
                return false;
        }
    }
    
    
   //var_dump(Category::deleteCategoryWhenIdGiven(3));
   
    //var_dump(Category::getCategoryById(2));
    //var_dump(Category::executeStatement("","select * from category"));
    //$cat=new Category(null,"Entertainment");
    //$cat->save();
    
     /*
                    a=select prod_id from product where categoryId=2; --> product ids under that category
b= select prod_id from orderLine; ---> product ids ordered by customers.


if any of a is contained in b
	echo "There are some orders for products under this category.Please deliver them first";

else
	echo "Category and all the products under that category deleted."
	delete the category.
	delete all products under that category.
	
                
                */
?>