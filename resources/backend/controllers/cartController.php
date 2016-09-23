<?php
    session_start();
    require_once("productController.php");

    /**
    * This class handles all the cart related operations.
    * Front end views get all cart related information via this controller class.
    */
    class CartController{

        /**
        * Adding a product with a given product id to the cart.
        * @param $id
        * @return string
        */
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

        /**
        * Helper function increasing the  number of products with given id in the cart by one.
        * @param $id
        * @param $quantityOfProduct
        * @param $productTitle
        * @return string
        */
        private function addExistingProduct($id, $quantityOfProduct, $productTitle)
        {
            if ($quantityOfProduct > $_SESSION["product_" . $id]) {
                $_SESSION["product_" . $id]++;
                return $productTitle. " Added to the basket";
            } else
                return "Only " . $quantityOfProduct . " " . $productTitle . " item(s) found. New arrivals coming soon.";
        }


        /**
        * Helper function adding a completely new product to the cart.
        * @param $id
        * @param $productTitle
        * @return string
        */
        private function addNewProduct($id, $productTitle)
        {
            $_SESSION["product_" . $id] = 1;
            return $productTitle. " Added to the basket.";
        }


        /**
        * Decreasing the  number of products with given id in the cart by one.
        * @param $id
        */
        public function removeOneItem($id){
            if($_SESSION["product_".$id]!=0)
                $_SESSION["product_".$id]--;
        }


        /**
        * Removing a product with given id from the cart.
        * @param $id
        */
        public function deleteItem($id){
            $_SESSION["product_".$id]=null;
        }

        /**
        * @return array: An associative array containing information about products in the cart
        */
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

        /**
        * @return int : total items in the cart
        */
        public function getTotalOfItems(){
            $numItems=0;
            foreach ($this->viewCart() as $product=>$quantity) {
                $numItems+=(int)$quantity;
            }
            return $numItems;
        }

        /**
        * @return int : total price of the products  in the cart.
        */
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




