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
        
    }
   
    //var_dump(Category::getCategoryById(2));
    //var_dump(Category::executeStatement("","select * from category"));
    
?>