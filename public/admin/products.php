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

                    <div class="row">
                        <h1 class="page-header">
                           All Products
                        </h1>
                        <div class="message">
                            <?php
                                if($_SESSION["message"]!=null){
                                    echo "<div class='alert alert-info'>".$_SESSION["message"]."</div>"; 
                                    $_SESSION["message"]=null;
                                }
                            ?>
                        </div>
                        <table class="table table-hover">
                            <thead>
                        
                              <tr>
                                   <th>Product Id</th>
                                   <th>Title</th>
                                   <th>Category Id</th>
                                   <th>Price</th>
                                   <th>Long Description</th>
                                   <th>Short Description</th>
                                   <th>Quantity</th>
                              </tr>
                            </thead>
                            <tbody>
                                <!--http://placehold.it/62x62-->
                                <?php require_once(dirname(__FILE__)."/../../resources/backend/controllers/productController.php");
                                        foreach ((new productController())->allProducts() as $product) {
                                            $product=json_decode($product);
                                            echo "<tr>
                                                <td>{$product->prod_id}</td>
                                                <td>{$product->title}<br>
                                                    <a href='edit_product.php?p_id={$product->prod_id}'><img src='{$product->prod_image}' alt=''></a>
                                                </td>  
                                                <td>{$product->categoryId}</td>
                                                <td>&#163;{$product->price}</td>
                                                <td>{$product->long_description}</td>
                                                <td>{$product->short_description}</td>
                                                <td>{$product->quantity}</td>
                                                <td><a class='btn btn-danger' href='delete_product.php?del_product={$product->prod_id}'><span class='glyphicon glyphicon-remove'></span></a></td>
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
