<?php
    require_once("Database.php");
    /**
    * Entity Class representing Category table in the database. 
    * This class is only accessed by a controller class or other entity class. 
    */
    class Category implements JsonSerializable{
        private $catId;
        private $catTitle;
    
        /**
        * Category constructor.
        * @param $catId
        * @param $catTitle
        */
        public function __construct($catId, $catTitle){
            $this->catId=addslashes($catId);
            $this->catTitle=addslashes($catTitle);
        }
    
        /** retrieving the id of a category
        * @return string
        */
        public function getCatId(){
            return $this->catId;
        }
    
        /**
        * retrieving the title of a category
        * @return string
        */
        public function getCatTitle(){
            return $this->catTitle;
        }
    
    
        /**
        * @return array: representation of a Category
        */
        public function jsonSerialize() {
            return ["catId" => $this->catId, "catTitle" => $this->catTitle];
        }
    
        /**
        * finding a category using category id
        * @param $id
        * @return Category
        */
        public static function getCategoryById($id){
            $result = Database::executeSelectStatement("Category not found","select * from category where catId = :id",[":id"=>$id]);
            return new Category($result[0]->catId,$result[0]->catTitle);
        }
    
    
        /**
        * Saving a category into the database. 
        * @return mixed
        */
        public function save(){
            $status=Database::executeNonSelectStatement("category cannot be inserted","insert into category (catTitle) values('{$this->catTitle}')");
            $result = Database::executeSelectStatement("Category not found","select catId from category where catTitle = :title",[":title"=>$this->catTitle]);
            $this->catId=$result[0]->catId;
            return $result[0]->catId;
        }
    
        /**
        * Deleting a category with a given category id. 
        * @param $catId
        * @return bool
        */
        public static function deleteCategoryWhenIdGiven($catId){
    
            $result = Database::executeSelectStatement("Orders cannot be checked","select distinct p.prod_id from (select prod_id from product where categoryId= :catId) p join orderLine o on p.prod_id=o.prod_id",[":catId"=>$catId]);
            if($result==null){
                Database::executeNonSelectStatement("Category not deleted","delete from product where categoryId = :catId",[":catId"=>$catId]);
                Database::executeNonSelectStatement("Category not deleted","delete from category where catId = :catId",[":catId"=>$catId]);
                return true;
            }
            else
                return false;
        }
    }
?>