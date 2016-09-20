<?php require_once("../resources/config.php") ?>
<!DOCTYPE html>
<html lang="en">
    <?php include(TEMPLATE_CUSTOMER.DS."head.php"); ?>
<body>

    <!-- Navigation -->
    <?php include(TEMPLATE_CUSTOMER.DS."navigation.php"); ?>
    
    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
             <?php  include(dirname(__FILE__)."/../resources/backend/controllers/categoryController.php");
                    $categoryName=(new categoryController())->getCategoryTitle($_GET["catId"]);
                    echo "<h1>{$categoryName}</h1>";
             ?>
            <p>Latest Books</p>
        </header>

        <!-- Page Features -->
        <div class="row text-center">
            <?php include(TEMPLATE_CUSTOMER.DS."thumbnails_category.php"); ?>
        </div>
        <!-- /.row -->

        <!-- Footer -->
        <?php include(TEMPLATE_CUSTOMER.DS."footer.php"); ?>
    </div>
    <!-- /.container -->

  

</body>

</html>

