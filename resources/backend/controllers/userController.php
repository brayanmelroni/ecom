<?php
session_start();

    require_once(dirname(__FILE__)."/..".DIRECTORY_SEPARATOR."entities/User.php");
    /**
    * This class handles all the user related operations.
    * Front end views get all user related information via this controller class. 
    */
    class userController{

        /**
        * @return array: all users' information in json encoded format
        */
        public function allUsers(){
            $userDescriptions=[];
            foreach ((new Database())->getAllUsers() as $user) {
                $userDescriptions[]=json_encode($user);
            }
            return $userDescriptions;
        }

        /**
        * @param $user_id
        * @return string:  information about the user with given id in json encoded format
        */
        public function user($user_id){
            return json_encode(User::getUserById($user_id));
        }

        /**
        * @param $username
        * @param $password
        * @return string: information about the user with given username and password in json encoded format.
        */
        public function getUserIfAuthorized($username, $password){
            return  json_encode(User::getUser($username,$password));
        }

        /**
        * @param $user_id
        * @return string: getting the user group of a user with given id.
        */
        public function userGroup($user_id){
            return User::getUserById($user_id)->getUser_Group();
        }

        /**
        * deleting the user with the given id.
        * @param $user_id
        * @return bool
        */
        public function deleteUser($user_id){
            return User::deleteUserWhenIdGiven($user_id);
        }

        /** Saving a user 
        * @param $first_name
        * @param $last_name
        * @param $address1
        * @param $address2
        * @param $city
        * @param $state
        * @param $zip
        * @param $username
        * @param $password
        * @param $user_group
        * @param $email
        */
        public function saveUser($first_name, $last_name, $address1, $address2, $city, $state, $zip, $username, $password, $user_group, $email){
            $user=new User(null,$first_name,$last_name,$address1,$address2,$city,$state,$zip,$username,sha1($password),$user_group,$email);
            $user->save();
        }

        /** Storing the current logged in user's id
        * @param $id
        */
        public function storeCurrentUserId($id){
            $_SESSION["user_id"]=$id;
        }

        /** Checking whether a user is logged in.
        * @return bool
        */
        public function isLoggedIn(){
            if ($_SESSION["user_id"]!=null)
                return true;
            else
                return false;
        }

        /**
        * @return null|string: user id of the current logged in user
        */
        public function getNameOfLoggedUser(){
            $user_id=$_SESSION["user_id"];
            if ($user_id !=null){
                return User::getUserById($user_id)->getFirst_Name();
            }
            else
                return null;
        }

        /**
        *  logging out the current user
        */
        public function logOut(){
            session_destroy();
        }
    }
?>
