<?php
    require_once("Database.php");
    class Category implements JsonSerializable{
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
            try{
                $statement=(new Database())->getConnection()->prepare("select * from category where catId = :id");
                $statement->setFetchMode(PDO::FETCH_OBJ);
                $statement->bindParam(":id", $id);
                $statement->execute();
                $result = $statement->fetchAll();
                return new Category($id,$result[0]->catTitle);
            }
            catch(PDOException $e){
                var_dump($e);
                die("Category not found");
            }
        }
    }
?>