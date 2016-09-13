<?php require_once("../resources/config.php"); ?>

<!DOCTYPE html>
<html lang="en">
    <?php include(TEMPLATE_CUSTOMER.DS."head.php"); ?>
    <body>
        <?php include(TEMPLATE_CUSTOMER.DS."navigation.php"); ?>
    
        <!-- Page Content -->
        <div class="container">
            <div class="row">
                <!-- Categories -->
                <?php include(TEMPLATE_CUSTOMER.DS."side_nav.php"); ?>

                <div class="col-md-9">
                    <div class="row carousel-holder">
                
                        <div class="col-md-12">
                            <!-- Carousel -->
                            <?php include(TEMPLATE_CUSTOMER.DS."slider.php"); ?>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Product thumbnails--!>
                         <?php include(TEMPLATE_CUSTOMER.DS."thumbnails_index.php"); ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- /.container -->
        <?php include(TEMPLATE_CUSTOMER.DS."footer.php"); ?>
    </body>

</html>
