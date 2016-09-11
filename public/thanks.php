<!-- Configuration-->
<?php require_once("../resources/config.php") ?>
<!DOCTYPE html>
<html lang="en">
     <!-- Header-->
    <?php include(TEMPLATE_DIR.DS."head.php"); ?>
    <body>
        <!-- Navigation -->
        <?php include(TEMPLATE_DIR.DS."navigation.php"); ?>
        
        <!--Page Content-->
        <div class="container">
            <?php include(dirname(__FILE__)."/../resources/backend/controllers/orderController.php");
                if($_GET["st"]=="Completed"){
                    echo "<div class='text-center alert alert-success'><h4>Payment Completed. Thank You.</h4></div>";
                    (new orderController())->saveOrder($_GET["tx"],$_SESSION["user_id"]);
                    
                    foreach ($_SESSION as $id=>$quantity) {
                        if(substr($id,0,7)=="product"){
                            $_SESSION[$id]=null;
                        }
                    }
                    
                    print_r([
                        "transactionId"=>$_GET["tx"], "Currency"=>$_GET["cc"],"Amount"=>$_GET["amt"]
                    ]);
                }
                else{
                    $_SESSION["message"]="Sorry the transaction was unsucessful. Please try again";
                    echo "<script>window.location='" . "/public/cart.php" . "'</script>"; 
                }
            ?>
            
            <!-- Footer -->
            <?php require_once(TEMPLATE_DIR.DS."footer.php"); ?>
        </div>
    </body>

</html>