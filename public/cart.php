<!-- Configuration-->
<?php require_once("../resources/config.php") ?>
<!DOCTYPE html>
<html lang="en">
     <!-- Header-->
    <?php include(TEMPLATE_DIR.DS."head.php"); ?>
    <body>
        <!-- Navigation -->
        <?php include(TEMPLATE_DIR.DS."navigation.php"); ?>

        <!-- Page Content -->
        <div class="container">
        <!-- /.row --> 
            <div class="row">
                <h1>Shopping Basket</h1>

                <form action="">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                           <th>Product</th>
                           <th>Price</th>
                           <th>Quantity</th>
                           <th>Sub-total</th>
                     
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                                require_once(dirname(__FILE__)."/../resources/backend/controllers/cartController.php");
                                foreach((new cartController())->viewCart() as $product=>$quantity){
                                    if($quantity!=null){
                                        $product=json_decode($product);
                                        echo " <tr><td>{$product->title}</td>";
                                        echo "<td>&#163;{$product->price}</td>";
                                        echo "<td>{$quantity}</td>";
                                        
                                        $subTotal=($product->price)*(int) $quantity;
                                        echo "<td>&#163;{$subTotal}</td>";
                                        
                                        echo "<td>
                                        <a class='btn btn-warning' href='/resources/backend/controllers/proxyCartController.php?remove={$product->prod_id}'>
                                            <span class='glyphicon glyphicon-minus'></span>
                                        </a>
                                        <a class='btn btn-success' href='/resources/backend/controllers/proxyCartController.php?add={$product->prod_id}'>
                                            <span class='glyphicon glyphicon-plus'></span>
                                        </a>
                                        <a class='btn btn-danger' href='/resources/backend/controllers/proxyCartController.php?delete={$product->prod_id}'>
                                            <span class='glyphicon glyphicon-remove'></span> 
                                        </a></td></tr>";
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </form>

                <!--  ***********CART TOTALS*************-->
                            
                <div class="col-xs-4 pull-right ">
                    <h2>Cart Totals</h2>
                
                    <table class="table table-bordered" cellspacing="0">
                
                        <tr class="cart-subtotal">
                        <th>Items:</th>
                        <td><span class="amount"><?php echo (new cartController())->getTotalOfItems();?></span></td>
                        </tr>
                        <tr class="shipping">
                        <th>Shipping and Handling</th>
                        <td>Free Shipping</td>
                        </tr>
                        
                        <tr class="order-total">
                        <th>Order Total</th>
                        <td><strong><span class="amount">&#163;<?php echo (new cartController())->getTotalPrice();?></span></strong> </td>
                        </tr>
                        
                        </tbody>
                        
                    </table>
                
                </div><!-- CART TOTALS-->


             </div><!--Main Content-->
             

            <!-- Footer -->
            <?php require_once(TEMPLATE_DIR.DS."footer.php"); ?>

        </div>
        <!-- /.container -->
    </body>

</html>
