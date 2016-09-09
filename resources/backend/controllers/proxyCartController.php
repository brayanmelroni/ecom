<?php

    require_once("cartController.php");
    
    class proxyCartController{
        public function handleCart(){
            if($_GET["add"]!=null){
                $this->handleAdd();
            }
            
            if($_GET["remove"]!=null){
                $this->handleRemove();
            }
        
            if($_GET["delete"]!=null){
                $this->handleDelete();
            }
        }

        private function handleAdd(){
            $_SESSION["message"] = (new CartController())->addToCart($_GET["add"]);
            $_GET["add"] = null;
            echo "<script> history.go(-1);</script>";
        }

        private function handleRemove(){
            (new CartController())->removeOneItem($_GET["remove"]);
            $_GET["remove"] = null;
            echo "<script>window.location='" . "/public/cart.php" . "'</script>";
        }

        private function handleDelete(){
            (new CartController())->deleteItem($_GET["delete"]);
            $_GET["delete"] = null;
            echo "<script>window.location='" . "/public/cart.php" . "'</script>";
        }
    }
    
    (new proxyCartController())->handleCart();
    
?>