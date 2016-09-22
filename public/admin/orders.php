<?php require_once(dirname(__FILE__)."/../../resources/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
    <?php require_once(TEMPLATE_ADMIN.DS."head.php"); ?>
    <body>
        <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <?php require_once(TEMPLATE_ADMIN.DS."top_navigation.php"); ?>
            <?php require_once(TEMPLATE_ADMIN.DS."side_navigation.php"); ?>
        <!-- /.navbar-collapse -->
        </nav>
        
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="row">
                        <h1 class="page-header">All Orders</h1>
                        <div class="message">
                            <?php
                                
                                if($_SESSION["message"]){
                                    echo "<div class='alert alert-info'>".$_SESSION["message"]."</div>"; 
                                    $_SESSION["message"]=null;
                                }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-hover">
                            <thead>
                                  <tr>
                                       <th>Order Id</th>
                                       <th>Amount</th>
                                       <th>Transaction Id</th>
                                       <th>Customer name</th>
                                       <th>Post address</th>
                                       <th>Product description</th>
                                       <th>Order Date</th>
                                  </tr>
                                </thead>
                                <tbody id="order_details">
                                    <?php require_once(dirname(__FILE__)."/../../resources/backend/controllers/orderController.php");
                                        foreach ((new orderController())->createOrderReport() as $row) {
                                            $row=json_decode($row);
                                            echo "<tr>
                                                <td>{$row->order_id}</td>
                                                <td>&#163;{$row->amount}</td>
                                                <td>{$row->transaction_id}</td>
                                                <td>{$row->cust_name}</td>
                                                <td>{$row->post_address}</td>
                                                <td>{$row->prod_description}</td>
                                                <td>{$row->orderDate}</td>
                                                <td><a class='btn btn-danger' id='btn_delete_order' href='/../../resources/backend/services/delete_order.php?del_order={$row->order_id}' ><span class='glyphicon glyphicon-remove'></span></a></td>
                                            </tr>";
                                        }
                                    ?>
                                </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
    </body>

</html>

