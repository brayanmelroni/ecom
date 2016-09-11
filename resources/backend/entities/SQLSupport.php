<?php
    require_once("Database.php");
    trait SQLSupport{
        public static function executeStatement($errorMessage,$query, array $placeholdersAndValues=null){
            try {
                $statement = (new Database())->getConnection()->prepare($query);
                $statement->setFetchMode(PDO::FETCH_OBJ);
                $statement->execute($placeholdersAndValues);
                $results = $statement->fetchAll();
            } catch (PDOException $e) {
                echo $e;
                die($errorMessage);
            }
            return $results;
        }
        
    }

?>