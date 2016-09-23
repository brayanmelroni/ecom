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
                    <h1 class="page-header">Product Categories</h1>
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
                    <div class="col-md-4">
                        <form action="" method="post">
            
                            <div class="form-group">
                                <label for="category-title">Title</label>
                                <input type="text" name="cat_title" class="form-control">
                            </div>
                    
                            <div class="form-group">
                                <input type="submit" name="add_category" class="btn btn-primary" value="Add Category">
                            </div>      
    
                        </form>
                    </div>
    
                    <div class="col-md-8">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php require_once(dirname(__FILE__)."/../../resources/backend/controllers/categoryController.php");
                                        $catController=new categoryController();
                                        /**
                                        *  Information about all the existing categories are displayed. 
                                        */
                                        foreach ($catController->allCategories() as $category) {
                                            $category=json_decode($category);
                                            echo "<tr>
                                                <td>{$category->catId}</td>
                                                <td>{$category->catTitle}</td>
                                                <td><a class='btn btn-danger' id='btn_delete_order' href='/../../resources/backend/services/deleteCategory.php?del_cat={$category->catId}' ><span class='glyphicon glyphicon-remove'></span></a></td>
                                            </tr>";
                                        }
                                        
                                        /**
                                        *   The code to create a new category.   
                                        */
                                        $status=$catController->saveCategory($_POST["cat_title"]);
                                        if($status!=null){
                                            $_SESSION["message"]="New Category was created";
                                            echo "<script>window.location='"."categories.php"."'</script>";
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
