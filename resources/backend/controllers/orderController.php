<?php
require_once(dirname(__FILE__)."/..".DIRECTORY_SEPARATOR."entities/Order.php");
require_once(dirname(__FILE__)."/..".DIRECTORY_SEPARATOR."entities/OrderLine.php");
require_once("cartController.php");

class orderController{
    
    public function saveOrder($transaction_id,$user_id){
        $cartController=new cartController();
        $orderDate=date("Y-m-d H:i:s", time());
        
        $orderId=(new Order($cartController->getTotalPrice(), $transaction_id, $user_id, $orderDate))->save();

        foreach ($cartController->viewCart() as $jsonProduct=>$quantity){
            if($quantity!=0){
                $prod_id=json_decode($jsonProduct)->prod_id;
                (new OrderLine($user_id, $orderDate, $prod_id, $quantity))->save();
                (new productController())->findAndSetQuantity($prod_id, json_decode($jsonProduct)->quantity-$quantity);
            }
        }
        return $orderId;
    }
    
    public function createOrderReport(){
        $ReportInJson=[];
        foreach (Order::orderDescriptions() as $order) {
            $ReportInJson[]=json_encode($order);
        }
        return $ReportInJson;
    }
    
    public function deleteOrder($id){
         return Order::deleteOrderWhenIdGiven($id); 
    }
}

//(new orderController())->saveOrder("xxxx345AB",1);
/*foreach ((new orderController())->createOrderReport() as $order) {
    var_dump($order); echo "<hr/>";
}*/

(new orderController())->deleteOrder(180);



?>