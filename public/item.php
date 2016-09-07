<?php require_once("../resources/config.php") ?>
<!DOCTYPE html>
<html lang="en">
    <?php include(TEMPLATE_DIR.DS."head.php"); ?>
    <body>
        <?php include(TEMPLATE_DIR.DS."navigation.php"); ?>

        <!-- Page Content -->
        <div class="container">

            <!-- Side Navigation -->
            <?php include(TEMPLATE_DIR.DS."side_nav.php"); ?>
            

            <div class="col-md-9">
                <?php include(TEMPLATE_DIR.DS."singleproduct.php"); ?> 
           
            </div>

        </div>
        <!-- /.container -->
        <?php include(TEMPLATE_DIR.DS."footer.php"); ?>
 
    </body>

</html>
