<?php
require_once("Database.php");

class OrderLine{
    private $user_id;
    private $orderDate;
    private $prod_id;
    private $quantity;
    
    public function __construct($user_id,$orderDate,$prod_id,$quantity){
        $this->user_id=$user_id;
        $this->orderDate=$orderDate; 
        $this->prod_id=$prod_id;
        $this->quantity=$quantity;
    }
    
    public function save(){
        try{
            return (new Database())->getConnection()->exec("insert into orderLine values ($this->user_id,'$this->orderDate',
            $this->prod_id,$this->quantity)");
        }
         catch(PDOException $e){
            echo $e;
            die("Order line not saved.");
        }
    }
    
}

    //(new OrderLine(2,date("Y-m-d H:i:s", time()),3,3))->save();
?>