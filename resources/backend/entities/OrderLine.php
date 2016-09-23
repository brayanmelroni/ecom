<?php
    require_once("Database.php");

    /**
    * Entity Class representing OrderLine table in the database. 
    * This class is only accessed by a controller class or other entity class. 
    */
    class OrderLine{
    
        private $user_id;
        private $orderDate;
        private $prod_id;
        private $quantity;
        
        /**
        * OrderLine constructor.
        * @param $user_id
        * @param $orderDate
        * @param $prod_id
        * @param $quantity
        */
        public function __construct($user_id,$orderDate,$prod_id,$quantity){
            $this->user_id=addslashes($user_id);
            $this->orderDate=addslashes($orderDate); 
            $this->prod_id=addslashes($prod_id);
            $this->quantity=addslashes($quantity);
        }
        
        /**
        * Save information about an Order Line to the database.
        */
        public function save(){
            Database::executeNonSelectStatement("Order Line not saved","insert into orderLine values ($this->user_id,'$this->orderDate',
            $this->prod_id,$this->quantity)");
           
        } 
    }
?>