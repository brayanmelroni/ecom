<?php
require_once("Database.php");
require_once("SQLSupport.php");

class Order{
    use SQLSupport;
    private $order_id;
    private $amount;
    private $transaction_id;
    private $user_id;
    private $orderDate;
    
    public function __construct($amount,$transaction_id,$user_id,$orderDate){
        $this->order_id=null;
        $this->amount=$amount;
        $this->transaction_id=$transaction_id;
        $this->user_id=$user_id;
        $this->orderDate=$orderDate;
    }
    
    public function save(){
        try{
            (new Database())->getConnection()->exec("insert into `order`(amount,transaction_id,user_id,orderDate) 
            values ($this->amount,'$this->transaction_id',$this->user_id,'$this->orderDate')");
            
            $result = Order::executeStatement("Order not found","select order_id from `order` where transaction_id = :id",[":id"=>$this->transaction_id]);
            $this->order_id=$result[0]->order_id;
        }
        catch(PDOException $e){
            echo $e;
            die("Order not saved.");
        }
    }
    
}
    
    //$order=new Order(234.45,"wwfghx",1,date("Y-m-d H:i:s", time()));
    //$order->save();



?>