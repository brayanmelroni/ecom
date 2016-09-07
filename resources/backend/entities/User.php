<?php
    require_once("Database.php");
    class User{
        private $user_id;
        private $username;
        private $password;
        private $user_group;
        private $email;
        
        public function __construct($user_id,$username,$password,$user_group,$email){
            $this->user_id=$user_id;
            $this->username=$username;
            $this->password=$password;
            $this->user_group=$user_group;
            $this->email=$email;
        }
        
        public function getUserGroup(){
            return $this->user_group;
        }
        
        public static function getUser($username,$password){
             try{
                $statement=(new Database())->getConnection()->prepare("select * from user where username = :username and password = :password");
                $statement->setFetchMode(PDO::FETCH_OBJ);
                $statement->bindParam(":username", $username);
                $statement->bindParam(":password",sha1($password));
                $statement->execute();
                $result = $statement->fetchAll();
                if($result!=null)
                    return new User($result[0]->user_id,$result[0]->username,$result[0]->password,$result[0]->user_group,$result[0]->email);
                else 
                    return null;
            }
            catch(PDOException $e){
                var_dump($e);
                die("User not found");
            }
        }
        
    }
?>