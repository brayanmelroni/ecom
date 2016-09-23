<?php require_once("../resources/config.php") ?>
<!DOCTYPE html>
<html lang="en">
     <?php include(TEMPLATE_CUSTOMER.DS."head.php"); ?>
    <body>
         <?php include(TEMPLATE_CUSTOMER.DS."navigation.php"); ?>
            <!-- Page Content -->
            <div class="container">
                <header>
                    <h1 class="text-center">Create account</h1>
                    <div class="col-sm-5 col-sm-offset-4">       
                   
                            <form action="registration.php" method="post" enctype="multipart/form-data">

                                

                                   <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" name="first_name" class="form-control"  >
                                    </div>
                                   
                                   <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" name="last_name" class="form-control"  >
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="address_1">Address Line 1</label>
                                        <input type="text" name="address_1" class="form-control"  >
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="address_2">Address Line 2</label>
                                        <input type="text" name="address_2" class="form-control"  >
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" name="city" class="form-control"  >
                                    </div>
                                    
                                   <div class="form-group">
                                        <label for="state">State</label>
                                        <input type="text" name="state" class="form-control"  >
                                   </div>
                                    
                                    <div class="form-group">
                                        <label for="zip">Zip</label>
                                        <input type="text" name="zip" class="form-control"  >
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="user_name">Username</label>
                                        <input type="text" name="user_name" class="form-control"  >
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control">
                                   </div>
                                   
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" class="form-control">
                                   </div>
                                   <input type="Submit" name="save_user" class="btn btn-primary pull-right" value="Save" >
                                  
                            </form>
                            <?php include(dirname(__FILE__)."/../resources/backend/controllers/userController.php");
                                /**
                                *  Registering a new user, if all the fields have been correctly filled. 
                                */
                                $first_name=$_POST["first_name"];
                                $last_name=$_POST["last_name"];
                                $address_1=$_POST["address_1"];
                                $address_2=$_POST["address_2"];
                                $city=$_POST["city"];
                                $state=$_POST["state"];
                                $zip=$_POST["zip"];
                                $user_name=$_POST["user_name"];
                                $password=$_POST["password"];
                                $user_group="customer";
                                $email=$_POST["email"];
                                
                                if($first_name !=null && $last_name !=null && $address_1!=null && $address_2!=null && $city!=null && 
                                $state!=null && $zip!=null && $user_name!=null && $password!=null && $user_group!=null && $email!=null){
                                    
                                    (new userController())->saveUser($first_name,$last_name,$address_1,$address_2,$city,$state, $zip,$user_name,
                                    $password,$user_group,$email);
                                    $_SESSION["message"]="New User was created";
                                    echo "<script>window.location='"."login.php"."'</script>";
                                }
                            ?>
                        </div>
                        <!-- /.container-fluid -->
                </header>
                <!-- /#page-wrapper -->

            </div>
            <!-- /#wrapper -->
            <?php include(TEMPLATE_CUSTOMER.DS."footer.php"); ?> 
    </body>

</html>




    