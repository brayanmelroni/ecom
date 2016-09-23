<?php
    require_once("Database.php");
    /**
    * Trait providing functionalities for executing SQL select, insert, update, delete statements
    */
    trait SQLSupport{
        
        /**
        * Executes SQL Select statements.
        * @param $errorMessage
        * @param $query
        * @param array|null $placeholdersAndValues
        * @return array
        */
        public static function executeSelectStatement($errorMessage,$query, array $placeholdersAndValues=null){
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
        
        /**
        * Executes SQL Insert, Update, Delete statements.
        * @param $errorMessage
        * @param $query
        * @param array|null $placeholdersAndValues
        * @return bool
        */
        public static function executeNonSelectStatement($errorMessage,$query, array $placeholdersAndValues=null){
            try {
                $statement = (new Database())->getConnection()->prepare($query);
                $status=$statement->execute($placeholdersAndValues);
            } catch (PDOException $e) {
                echo $e;
                die($errorMessage);
            }
            return $status;
        }
        
    }

?>