<?php require_once("../resources/config.php") ?>
<!DOCTYPE html>
<html lang="en">
    <?php include(TEMPLATE_CUSTOMER.DS."head.php"); ?>
    <body>
        <!-- Navigation -->
        <?php include(TEMPLATE_CUSTOMER.DS."navigation.php"); ?>

        <!-- Page Content -->
        <div class="container">

            <header>
                <h1 class="text-center">Sign In</h1>
                <div class="col-sm-4 col-sm-offset-5">         
                    <form class="" action="" method="post" enctype="multipart/form-data">
                        
                        <div class="form-group"><label for="">
                            username<input type="text" name="username" class="form-control"></label>
                        </div>
                         <div class="form-group"><label for="password">
                            Password<input type="password" name="password" class="form-control"></label>
                        </div>
        
                        <div class="form-group">
                          <input type="submit" name="submit" class="btn btn-primary" id="login_submit">
                        </div>
                    </form>
                     
                </div> 
                <div class="col-sm-2 col-sm-offset-5"> 
                        <div class="form-group"><label for="">
                            New to website?<a href="registration.php" class="btn btn-default form-control">Create new account</a></label>
                        </div>
                </div>
                
            </header>
        </div>
        <?php include(dirname(__FILE__)."/../resources/backend/controllers/userController.php"); 
                if($_POST["username"]!=null && $_POST["password"]!=null){
                    $userController=new userController();
                    $user=json_decode($userController->getUserIfAuthorized($_POST["username"],$_POST["password"]));
                    if($user==!null){
                        $currentUserId=$user->user_id;
                        $userController->storeCurrentUserId($currentUserId);
                        if($userController->userGroup($currentUserId)=="admin")
                            echo "<script>window.location='admin/orders.php'</script>";
                        else
                            echo "<script>window.location='index.php'</script>";
                    }
                    else
                        echo "<h2 class='text-center bg-danger'>Your e-mail or password was incorrect. Please try again.</h2>";
                }
        ?>
        <!-- /.container -->
        <?php include(TEMPLATE_CUSTOMER.DS."footer.php"); ?> 
    </body>

</html>


