<?php
    session_start();
    
    require_once(dirname(__FILE__)."/..".DIRECTORY_SEPARATOR."entities/User.php");
    class userController{
        
        public function getUserIfAuthorized($username,$password){
            return  json_encode(User::getUser($username,$password));
        }
        
        public function userGroup($user_id){
            return User::getUserById($user_id)->getUser_Group();
        }
        
        public function user($user_id){
            return json_encode(User::getUserById($user_id));
        }
        
        public function storeCurrentUserId($id){
            $_SESSION["user_id"]=$id;
        }
        
        public function isLoggedIn(){
            if ($_SESSION["user_id"]!=null)
                return true;
            else
                return false;
        }
        
        public function getNameOfLoggedUser(){
            $user_id=$_SESSION["user_id"];
            if ($user_id !=null){
                return User::getUserById($user_id)->getFirst_Name();
            }
            else
                return null;
        }
        
        public function logOut(){
            session_destroy();
        }
    }
    
    //var_dump($status);
    //var_dump((new userController())->userGroup(1));
    //var_dump((new userController())->user(2));
    //var_dump((new userController())->getNameOfLoggedUser());
    //var_dump((new userController())->isLoggedIn());
    
?>    
    
    
   