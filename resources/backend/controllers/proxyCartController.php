<?php

    require_once("cartController.php");
    /**
    *  A class acting as a proxy to CartController class. 
    */
    class proxyCartController{

        public $cartController;

        /**
        * proxyCartController constructor.
        */
        public function __construct(){
            $this->cartController = new CartController();
        }

        /**
        *  Directing the execution to one of the methods: handleAdd,handleRemove,handleDelete based on GET parameters.
        */
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

        /**
        *  Helper function delegating the execution to addToCart method in cartController class.
        */
        private function handleAdd(){

            $_SESSION["message"] = $this->cartController->addToCart($_GET["add"]);
            $_GET["add"] = null;
            echo "<script> history.go(-1);</script>";
        }

        /**
        *  Helper function delegating the execution to removeOneItem method in cartController class.
        */
        private function handleRemove(){
            $this->cartController->removeOneItem($_GET["remove"]);
            $_GET["remove"] = null;
            echo "<script>window.location='" . "/public/cart.php" . "'</script>";
        }

        /**
        * Helper function delegating the execution to deleteItem method in cartController class.
        */
        private function handleDelete(){
            $this->cartController->deleteItem($_GET["delete"]);
            $_GET["delete"] = null;
            echo "<script>window.location='" . "/public/cart.php" . "'</script>";
        }
    }

    /**
    *   At first handleCart function is called when executing this php file. 
    */
    (new proxyCartController())->handleCart();

?>

