<?php
    require_once(dirname(__FILE__)."/..".DIRECTORY_SEPARATOR."entities/User.php");
    class userController{
        
        public function getUserIfAuthorized($username,$password){
            return  User::getUser($username,$password);
        }
        
        public function getUserGroup(User $user){
            return $user->getUserGroup();
        }
    }
?>    
    
    
   