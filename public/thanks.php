<!-- Configuration-->
<?php require_once("../resources/config.php") ?>
<!DOCTYPE html>
<html lang="en">
     <!-- Header-->
    <?php include(TEMPLATE_CUSTOMER.DS."head.php"); ?>
    <body>
        <!-- Navigation -->
        <?php include(TEMPLATE_CUSTOMER.DS."navigation.php"); ?>
        
        <!--Page Content-->
        <div class="container">
            <?php include(dirname(__FILE__)."/../resources/backend/controllers/orderController.php");
                $cartController=new cartController();
                if($_GET["st"]=="Completed" && $cartController->getTotalPrice()>0){
                    $orderId=(new orderController())->saveOrder($_GET["tx"],$_SESSION["user_id"]);
                    echo "<div class='text-center alert alert-success'><h4>Your order was successfully placed.<br/>
                    Your order number is {$orderId}.</h4></div>";
                    
                    echo "<div class='text-center alert alert-success'><h4> Today you bought following products.<br/><br/>";
                    
                    foreach ($cartController->viewCart() as $product=>$quantity) {
                       $product=json_decode($product);
                       if($quantity!=null){
                            echo $quantity." ". $product->title."(s)"."each &#163;".$product->price."<br/>";   
                       }
                    }
                    echo "<h4/></div>";
                    echo "<div class='text-center alert alert-success'><h4>Total paid: &#163;{$cartController->getTotalPrice()}</h4></div>";
                  
                    foreach ($_SESSION as $id=>$quantity) {
                        if(substr($id,0,7)=="product"){
                            $_SESSION[$id]=null;
                        }
                    }
                    
                }
                else{
                    $_SESSION["message"]="Sorry the transaction was unsucessful. Please try again";
                    echo "<script>window.location='" . "/public/cart.php" . "'</script>"; 
                }
            ?>
            
            <!-- Footer -->
            <?php require_once(TEMPLATE_CUSTOMER.DS."footer.php"); ?>
        </div>
    </body>

</html>