<?php require_once("../resources/config.php") ?>
<!DOCTYPE html>
<html lang="en">
    <?php include(TEMPLATE_DIR.DS."head.php"); ?>
<body>

    <!-- Navigation -->
    <?php include(TEMPLATE_DIR.DS."navigation.php"); ?>
    
    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
             <?php  include(dirname(__FILE__)."/../resources/backend/controllers/categoryController.php");
                    $categoryName=(new categoryController())->getCategoryTitle($_GET["catId"]);
                    echo "<h1>{$categoryName}</h1>";
             ?>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
            <p><a class="btn btn-primary btn-large">Call to action!</a>
            </p>
        </header>

        <hr>

        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">
                <h3>Latest Products</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">
            <?php include(TEMPLATE_DIR.DS."thumbnails_category.php"); ?>
        </div>
        <!-- /.row -->

        <!-- Footer -->
        <?php include(TEMPLATE_DIR.DS."footer.php"); ?>
    </div>
    <!-- /.container -->

  

</body>

</html>
