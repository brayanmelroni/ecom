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
                    <h1 class="page-header">
                       Edit Product
                    
                    </h1>
                    <?php
                        if($_SESSION["message"]){
                        echo "<div class='alert alert-info'>".$_SESSION["message"]."</div>"; 
                        $_SESSION["message"]=null;
                        }
                    ?>
                    </div>
                         
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="col-md-8">
                            <?php require_once(dirname(__FILE__)."/../../resources/backend/controllers/productController.php");
                                $prod_id=$_GET["p_id"];
                                $productController=new ProductController();
                                $product=json_decode($productController->getProduct($prod_id));
                            ?>
                            <div class='form-group'>
                                <label for='product_title'>Product Title </label>
                                <input type='text' name='product_title' value='<?php echo $product->title; ?>'class='form-control'>
                            </div> 
                            
                            <div class='form-group'>
                                   <label for='short_description'>Product Short Description</label>
                              <textarea name='short_description' id='' cols='30' rows='4' class='form-control'><?php echo $product->short_description;?></textarea>
                            </div>
                                  
                            <div class='form-group'>
                                   <label for='long_description'>Product Long Description</label>
                              <textarea name='long_description' id='' cols='30' rows='10' class='form-control'><?php echo $product->long_description; ?></textarea>
                            </div>
                            
                            <div class='form-group row'>
                                  <div class='col-xs-3'>
                                    <label for='product-price'>Product Price</label>
                                    <input type='text' name='product_price' class='form-control' value='<?php echo $product->price;?>' size='60'>
                                  </div>
                            </div>
        
                        </div><!--Main Content-->
        
                        <!-- SIDEBAR-->
        
                        <aside id='admin_sidebar' class='col-md-4'>
                            <div class='form-group'>
                                <input type='submit' name='publish' class='btn btn-primary btn-lg' value='Update'>
                            </div>
                            
                             <!-- Product Categories-->
            
                            <div class='form-group'>
                                <label for='product-title'>Product Category</label>
                                <hr>
                                <select name='product_category' id='' class='form-control'> ";
                                <?php
                                        require_once(dirname(__FILE__)."/../../resources/backend/controllers/categoryController.php");
                                        $catController=new categoryController();
                                        foreach ($catController->allCategories() as $category) {
                                            $category=json_decode($category);
                                            if($category->catId == $product->categoryId)
                                                echo "<option name='product_category' value='{$category->catId}' selected='selected'>{$category->catTitle}</option>";
                                            else
                                                echo "<option name='product_category' value='{$category->catId}'>{$category->catTitle}</option>";
                                        }
                                
                                ?>;
                                </select>
                            </div>
            
                            <!-- Product Tags -->
                            <div class='form-group'>
                                <label for='product_quantity'>Product Quantity</label>
                                <hr>
                                <input type='number' name='product_quantity' value='<?php echo $product->quantity;?>'class='form-control'>
                            </div>
                            
                            <!-- Product Image -->
                            <div class='form-group'>
                                <label for='product-title'>Product Image</label>
                                <input type='file' name='file'><br/>
                                <img src='<?php echo $product->prod_image;?>'/>
                            </div>
                        </aside><!--SIDEBAR--> 
                    </form>
                    <?php 
                            move_uploaded_file($_FILES["file"]["tmp_name"],dirname(__FILE__)."/../../resources/uploads/".$_FILES["file"]["name"]);
                            $prod_image="/resources/uploads/".$_FILES["file"]["name"];
                            
                            $value=(new productController())->updateProduct($product->prod_id,$_POST['product_title'],$_POST["product_category"],
                            $_POST["product_price"],$_POST["long_description"],$_POST["short_description"],$prod_image,
                            $_POST["product_quantity"]);
                            
                            if($value>0){
                                $_SESSION["message"]="Product was successfully updated.";
                                echo "<script>window.location='"."edit_product.php"."'</script>"; 
                            }
                        
                    ?>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->

    </body>

</html>