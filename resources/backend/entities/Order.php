<?php
require_once("Database.php");

    /**
    * Entity Class representing Order table in the database. 
    * This class is only accessed by a controller class or other entity class. 
    */
    class Order{
        private $order_id;
        private $amount;
        private $transaction_id;
        private $user_id;
        private $orderDate;
    
        /**
        * Order constructor.
        * @param $amount
        * @param $transaction_id
        * @param $user_id
        * @param $orderDate
        */
        public function __construct($amount, $transaction_id, $user_id, $orderDate){
            $this->order_id=null;
            $this->amount=addslashes($amount);
            $this->transaction_id=addslashes($transaction_id);
            $this->user_id=addslashes($user_id);
            $this->orderDate=addslashes($orderDate);
        }
    
        /**
        * Generating a logical description about an order.
        * @return array
        */
        public static function orderDescriptions(){
            return Database::executeSelectStatement("Report can not be created.","select order_id,amount,transaction_id,cust_name,post_address,GROUP_CONCAT(prod_description SEPARATOR ', ') as prod_description
            ,orderDate from (SELECT o.order_id, o.amount, o.transaction_id, (select concat(first_name,space(1),last_name) from user where user_id=o.user_id) as 'cust_name',(select concat(address1,',',space(1),address2,',',space(1),city,',',space(1),state,',',space(1),zip) from user where user_id=o.user_id) as 'post_address',(select concat(title,' :',ol.quantity,' item(s)') from product where prod_id = ol.prod_id) as 'prod_description',o.orderDate 
            FROM  `order` o
            INNER JOIN orderLine ol ON o.user_id = ol.user_id
            AND o.orderDate = ol.orderDate) z group by order_id");
        }
    
    
        /** saving an order to a database.  
        * @return mixed
        */
        public function save(){
            Database::executeNonSelectStatement("Order not saved","insert into `order`(amount,transaction_id,user_id,orderDate) 
            values ($this->amount,'$this->transaction_id',$this->user_id,'$this->orderDate')");
            $result = Database::executeSelectStatement("Order not found","select order_id from `order` where transaction_id = :id",[":id"=>$this->transaction_id]);
            $this->order_id=$result[0]->order_id;
            return $result[0]->order_id;
        }
    
    
        /** deleting an order with a given order id. 
        * @param $order_id
        * @return bool
        */
        public static function deleteOrderWhenIdGiven($order_id){
    
            $result = Database::executeSelectStatement("Order not found","select user_id,orderDate from `order` where order_id = :id",[":id"=>$order_id]);
            $user_id=$result[0]->user_id;
            $order_date=$result[0]->orderDate;
            Database::executeNonSelectStatement("Order not deleted.","delete from orderLine where user_id= :user_id and orderDate= :order_date",
                [":user_id"=>$user_id,":order_date"=>$order_date]);
            Database::executeNonSelectStatement("Order not deleted","delete from `order` where order_id= :order_id",[":order_id"=>$order_id]);
            return true;
        }
    }

?>