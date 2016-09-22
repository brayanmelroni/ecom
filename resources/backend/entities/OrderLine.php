<?php
require_once("Database.php");

class OrderLine{
    
    private $user_id;
    private $orderDate;
    private $prod_id;
    private $quantity;
    
    public function __construct($user_id,$orderDate,$prod_id,$quantity){
        $this->user_id=addslashes($user_id);
        $this->orderDate=addslashes($orderDate); 
        $this->prod_id=addslashes($prod_id);
        $this->quantity=addslashes($quantity);
    }
    
    public function save(){
        Database::executeNonSelectStatement("Order Line not saved","insert into orderLine values ($this->user_id,'$this->orderDate',
        $this->prod_id,$this->quantity)");
       
    } 
}
?>