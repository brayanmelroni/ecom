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
                       Add Product
                    
                    </h1>
                    <?php
                        /**
                        *  If the session containes a value for session variable: message,  it is displayed.
                        *  Then the message session variable is set to null. 
                        */
                        if($_SESSION["message"]){
                            echo "<div class='alert alert-info'>".$_SESSION["message"]."</div>"; 
                            $_SESSION["message"]=null;
                        }
                    ?>
                    </div>
                               
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="col-md-8">
        
                            <div class="form-group">
                                <label for="product_title">Product Title </label>
                                <input type="text" name="product_title" class="form-control">
                            </div>
        
                            <div class="form-group">
                                   <label for="short_description">Product Short Description</label>
                              <textarea name="short_description" id="" cols="30" rows="4" class="form-control"></textarea>
                            </div>
                            
                            <div class="form-group">
                                   <label for="long_description">Product Long Description</label>
                              <textarea name="long_description" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            
                            <div class="form-group row">
                        
                                  <div class="col-xs-3">
                                    <label for="product-price">Product Price</label>
                                    <input type="text" name="product_price" class="form-control" size="60">
                                  </div>
                            </div>
        
                        </div><!--Main Content-->
        
                        <!-- SIDEBAR-->
        
                        <aside id="admin_sidebar" class="col-md-4">
                            <div class="form-group">
                               <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft">
                                <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
                            </div>
            
            
                             <!-- Product Categories-->
            
                            <div class="form-group">
                                <label for="product-title">Product Category</label>
                                <hr>
                                <select name="product_category" id="" class="form-control">
                                    
                                    <?php require_once(dirname(__FILE__)."/../../resources/backend/controllers/categoryController.php");
                                        /**
                                        *  All the categories are retreived and their names are presented, so that one category could be selected. 
                                        */
                                        $catController=new categoryController();
                                        foreach ($catController->allCategories() as $category) {
                                            $category=json_decode($category);
                                            echo "<option name='product_category' value='{$category->catId}'>{$category->catTitle}</option>";
                                        }
                                    ?>
                                </select>
                            </div>
            
                            <!-- Product Tags -->
                            <div class="form-group">
                                <label for="product_quantity">Product Quantity</label>
                                <hr>
                                <input type="number" name="product_quantity" class="form-control">
                            </div>
                            
                            <!-- Product Image -->
                            <div class="form-group">
                                <label for="product-title">Product Image</label>
                                <input type="file" name="file">
                            </div>
        
                        </aside><!--SIDEBAR-->
                    </form>
                    <?php require_once(dirname(__FILE__)."/../../resources/backend/controllers/productController.php");
                        /**
                        *  If all the input variables are entered correctly, information regarding new product is saved and a success message 
                        *  is displayed, else an error message is displayed. 
                        */
                        if($_POST['product_title']!=null && $_POST["product_category"]!=null && $_POST["product_price"]!=null
                        && $_POST["long_description"]!=null && $_POST["short_description"]!=null && $_POST["product_quantity"]!=null){
                            
                            move_uploaded_file($_FILES["file"]["tmp_name"],dirname(__FILE__)."/../../resources/uploads/".$_FILES["file"]["name"]);
                            $prod_image="/resources/uploads/".$_FILES["file"]["name"];
                            
                            $value=(new productController())->saveProduct($_POST['product_title'],$_POST["product_category"],
                            $_POST["product_price"],$_POST["long_description"],$_POST["short_description"],$prod_image,
                            $_POST["product_quantity"]);
                            
                            if($value>0)
                                $_SESSION["message"]="New Product was saved";
                            if($value==null)
                                $_SESSION["message"]="Error: Product was not saved";
                            echo "<script>window.location='"."add_product.php"."'</script>"; 
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