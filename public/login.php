<?php require_once("../resources/config.php") ?>
<!DOCTYPE html>
<html lang="en">
    <?php include(TEMPLATE_DIR.DS."head.php"); ?>
    <body>
        <!-- Navigation -->
        <?php include(TEMPLATE_DIR.DS."navigation.php"); ?>

        <!-- Page Content -->
        <div class="container">

            <header>
                <h1 class="text-center">Login</h1>
                <div class="col-sm-4 col-sm-offset-5">         
                    <form class="" action="" method="post" enctype="multipart/form-data">
                        
                        <div class="form-group"><label for="">
                            username<input type="text" name="username" class="form-control"></label>
                        </div>
                         <div class="form-group"><label for="password">
                            Password<input type="password" name="password" class="form-control"></label>
                        </div>
        
                        <div class="form-group">
                          <input type="submit" name="submit" class="btn btn-primary" >
                        </div>
                    </form>
                </div>  
                
            </header>
        </div>
        <?php include(dirname(__FILE__)."/../resources/backend/controllers/userController.php"); 
                if($_POST["username"]!=null && $_POST["password"]!=null){
                    $user=(new userController())->getUserIfAuthorized($_POST["username"],$_POST["password"]);
                    if($user==!null){
                        if((new userController())->getUserGroup($user)=="admin")
                            echo "<script>window.location='admin'</script>";
                        else
                            echo "<script>window.location='shop.php'</script>";
                    }
                    else
                        echo "<h2 class='text-center bg-warning'>Your e-mail or password was incorrect. Please try again.</h2>";
                }
        ?>
        <!-- /.container -->
        <?php include(TEMPLATE_DIR.DS."footer.php"); ?>
    </body>

</html>


