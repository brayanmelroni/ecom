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
                <h1>Starbucks Book Shop</h1> 
                <p>The Ultimate second hand book store in Islington</p>
            </header>

            <hr>
       
            <!-- Page Features -->
            <div class="row text-center">
                <?php include(TEMPLATE_DIR.DS."thumbnails_index.php"); ?>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
        <!-- Footer -->
        <?php include(TEMPLATE_DIR.DS."footer.php"); ?>
    </body>
</html>
