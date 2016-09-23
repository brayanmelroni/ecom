<?php
    require_once(dirname(__FILE__)."/..".DIRECTORY_SEPARATOR."entities/Order.php");
    require_once(dirname(__FILE__)."/..".DIRECTORY_SEPARATOR."entities/OrderLine.php");
    require_once("cartController.php");

    /**
    * This class handles all the order related operations.
    * Front end views get all order related information via this controller class.
    */
    class orderController{

        /**
        * Saving an order information.
        * @param $transaction_id
        * @param $user_id
        * @return mixed
        */
        public function saveOrder($transaction_id, $user_id){
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
    
        /**
        * @return array : report about all the orders in json encoded format.
        */
        public function createOrderReport(){
            $ReportInJson=[];
            foreach (Order::orderDescriptions() as $order) {
                $ReportInJson[]=json_encode($order);
            }
            return $ReportInJson;
        }
    
        /**
        * deleting an order with given order id. 
        * @param $id
        * @return bool
        */
        public function deleteOrder($id){
            return Order::deleteOrderWhenIdGiven($id);
        }
    }
?>