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
        return $result[0]->order_id;
    }
    
    public static function orderDescriptions(){
        return self::executeStatement("Report can not be created.","select order_id,amount,transaction_id,cust_name,post_address,GROUP_CONCAT(prod_description SEPARATOR ', ') as prod_description
        ,orderDate from (SELECT o.order_id, o.amount, o.transaction_id, (select concat(first_name,space(1),last_name) from user where user_id=o.user_id) as 'cust_name',(select concat(address1,',',space(1),address2,',',space(1),city,',',space(1),state,',',space(1),zip) from user where user_id=o.user_id) as 'post_address',(select concat(title,' :',ol.quantity,' item(s)') from product where prod_id = ol.prod_id) as 'prod_description',o.orderDate 
        FROM  `order` o
        INNER JOIN orderLine ol ON o.user_id = ol.user_id
        AND o.orderDate = ol.orderDate) z group by order_id");
    }
    
    public static function deleteOrderWhenIdGiven($order_id){ 
        
        $result = Order::executeStatement("Order not found","select user_id,orderDate from `order` where order_id = :id",[":id"=>$order_id]);
        $user_id=$result[0]->user_id;
        $order_date=$result[0]->orderDate;
        try{
            $connection=(new Database())->getConnection();
            $connection->exec("delete from orderLine where user_id='$user_id' and orderDate='$order_date'");            
            $connection->exec("delete from `order` where order_id='$order_id'");
        }
        catch(PDOException $e){
            echo $e;
            die("Order not deleted.");
        }
        return true;
    }
}

    //var_dump(Order::deleteOrderWhenIdGiven(187));
    
    //$order=new Order(234.45,"wwfghx",1,date("Y-m-d H:i:s", time()));
    //$order->save();
  /*  foreach (Order::orderDescriptions() as $order) {
        var_dump($order);
        echo "<hr/>";
    }*/
    



?>