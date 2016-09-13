<!-- Configuration-->
<?php require_once("../resources/config.php") ?>
<!DOCTYPE html>
<html lang="en">
     <!-- Header-->
    <?php include(TEMPLATE_CUSTOMER.DS."head.php"); ?>
    <body>
        <!-- Navigation -->
        <?php include(TEMPLATE_CUSTOMER.DS."navigation.php"); ?>

        <!-- Page Content -->
        <div class="container">
        <!-- /.row --> 
            <div class="row">
                <h1>Shopping Basket</h1>

                <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                    <input type="hidden" name="cmd" value="_cart">
                    <input type="hidden" name="business" value="brayanmelroni1-facilitator@gmail.com">
                    <input type="hidden" name="currency_code" value="GBP">
                    <?php
                        require_once(dirname(__FILE__)."/../resources/backend/controllers/userController.php");
                        $user=json_decode((new userController())->user($_SESSION["user_id"]));
                        echo "<input type='hidden' name='first_name' value='{$user->first_name}'>
                        <input type='hidden' name='last_name' value='{$user->last_name}'>
                        <input type='hidden' name='address1' value='{$user->address1}'>
                        <input type='hidden' name='address2' value='{$user->address2}'>
                        <input type='hidden' name='city' value='{$user->city}'>
                        <input type='hidden' name='state' value='{$user->state}'>
                        <input type='hidden' name='zip' value='{$user->zip}'>";
                    ?>
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
                                $cartController=new cartController();
                                $counter=0;
                                foreach($cartController->viewCart() as $product=>$quantity){
                                    if($quantity!=null){
                                        $product=json_decode($product);
                                        $title=$product->title;
                                        $prod_id=$product->prod_id;
                                        $price=$product->price;
                                        echo " <tr><td>{$title}</td>";
                                        echo "<td>&#163;{$price}</td>";
                                        echo "<td>{$quantity}</td>";
                                        
                                        $subTotal=($price)*(int) $quantity;
                                        echo "<td>&#163;{$subTotal}</td>";
                                        
                                        echo "<td>
                                        <a class='btn btn-warning' href='/resources/backend/controllers/proxyCartController.php?remove={$prod_id}'>
                                            <span class='glyphicon glyphicon-minus'></span>
                                        </a>
                                        <a class='btn btn-success' href='/resources/backend/controllers/proxyCartController.php?add={$prod_id}'>
                                            <span class='glyphicon glyphicon-plus'></span>
                                        </a>
                                        <a class='btn btn-danger' href='/resources/backend/controllers/proxyCartController.php?delete={$prod_id}'>
                                            <span class='glyphicon glyphicon-remove'></span> 
                                        </a></td></tr>";
                                        
                                        $counter++;
                                        echo "<input type='hidden' name='item_name_{$counter}' value='{$title}'</input>";
                                        echo "<input type='hidden' name='item_number_{$counter}' value='{$prod_id}'</input>";
                                        echo "<input type='hidden' name='amount_{$counter}' value='{$price}'</input>";
                                        echo "<input type='hidden' name='quantity_{$counter}' value='{$quantity}'</input>";
                                        
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                    <?php if($cartController->getTotalOfItems()>0){
                             echo "<input type='image' name='upload' id='inputCheckout' src='https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif' alt='PayPal - The safer, easier way to pay online'/>";
                          }
                    ?>           
                </form>

                <!--  ***********CART TOTALS*************-->
                            
                <div class="col-xs-4 pull-right ">
                    <h2>Cart Totals</h2>
                
                    <table class="table table-bordered" cellspacing="0">
                        <tr class="cart-subtotal">
                        <th>Items:</th>
                        <td><span class="amount"><?php echo $cartController->getTotalOfItems();?></span></td>
                        </tr>
                        <tr class="shipping">
                        <th>Shipping and Handling</th>
                        <td>Free Shipping</td>
                        </tr>
                        
                        <tr class="order-total">
                        <th>Order Total</th>
                        <td><strong><span class="amount">&#163;<?php echo $cartController->getTotalPrice();?></span></strong> </td>
                        </tr>
                        
                        </tbody>
                        
                    </table>
                
                </div><!-- CART TOTALS-->


             </div><!--Main Content-->
             

            <!-- Footer -->
            <?php require_once(TEMPLATE_CUSTOMER.DS."footer.php"); ?>

        </div>
        <!-- /.container -->
    </body>

</html>
