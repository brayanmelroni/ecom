<?php
    session_start();
    require_once("productController.php");
    
    class CartController{
        public function addToCart($id){
            $productController = new ProductController();

            $quantityOfProduct= $productController->getProductQuantity($id);
            $productTitle= $productController->getProductTitle($id);

            if($quantityOfProduct==0)
                return "This product is unavailable at the moment.";
            else{

                if($_SESSION["product_".$id]==null){
                    return $this->addNewProduct($id, $productTitle);
                }
                else{
                    return $this->addExistingProduct($id, $quantityOfProduct, $productTitle);
                }
            }
        }
        
        private function addExistingProduct($id, $quantityOfProduct, $productTitle)
        {
            if ($quantityOfProduct > $_SESSION["product_" . $id]) {
                $_SESSION["product_" . $id]++;
                return $productTitle. " Added to the basket";
            } else
                return "Only " . $quantityOfProduct . " " . $productTitle . " item(s) found. New arrivals coming soon.";
        }
        
        
        private function addNewProduct($id, $productTitle)
        {
            $_SESSION["product_" . $id] = 1;
            return $productTitle. " Added to the basket.";
        }
        
        
        public function removeOneItem($id){
            if($_SESSION["product_".$id]!=0)
            $_SESSION["product_".$id]--;
        }
        
        public function deleteItem($id){
            $_SESSION["product_".$id]=null;
        }
        
        public function viewCart(){
            $products=[];
            foreach ($_SESSION as $id=>$quantity) {
                if(substr($id,0,7)=="product"){
                    $id=substr($id,8);
                    $products[(new ProductController())->getProduct($id)]=$quantity;
                }
            }
            return $products;
        }
        
        public function getTotalOfItems(){
            $numItems=0;
            foreach ($this->viewCart() as $product=>$quantity) {
                $numItems+=(int)$quantity;
            }        
            return $numItems;
        }
        
        public function getTotalPrice(){
            $total=0;
            foreach ($this->viewCart() as $product=>$quantity) {
                $product=json_decode($product);
                $total+=$product->price*(int)$quantity;
            }        
            return $total;
        }
        
    }
?>





