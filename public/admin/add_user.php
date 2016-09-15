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
                            <h1 class="page-header">Add User</h1>
                            <?php
                                if($_SESSION["message"]){
                                    echo "<div class='alert alert-info'>".$_SESSION["message"]."</div>"; 
                                    $_SESSION["message"]=null;
                                }
                            ?>
                            <div class="col-md-6 user_image_box">
                                <a href="#" data-toggle="modal" data-target="#photo-library"><img class="img-responsive" src="" alt=""></a>

                             </div>

                            <form action="add_user.php" method="post" enctype="multipart/form-data">

                                <div class="col-md-6">

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
                                        <label for="user_group">User Group</label>
                                        <select name="user_group" id="user_group" class="form-control">
                                            <option value="customer">customer</option>
                                            <option value="admin">admin</option>
                                         </select>
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" class="form-control">
                                   </div>
                                   <input type="Submit" name="save_user" class="btn btn-primary pull-right" value="Save" >
                                  
                                 
                                </div>

                            </form>
                            <?php require_once(dirname(__FILE__)."/../../resources/backend/controllers/userController.php");
                                $first_name=$_POST["first_name"];
                                $last_name=$_POST["last_name"];
                                $address_1=$_POST["address_1"];
                                $address_2=$_POST["address_2"];
                                $city=$_POST["city"];
                                $state=$_POST["state"];
                                $zip=$_POST["zip"];
                                $user_name=$_POST["user_name"];
                                $password=$_POST["password"];
                                $user_group=$_POST["user_group"];
                                $email=$_POST["email"];
                                
                                if($first_name !=null && $last_name !=null && $address_1!=null && $address_2!=null && $city!=null && 
                                $state!=null && $zip!=null && $user_name!=null && $password!=null && $user_group!=null && $email!=null){
                                    
                                    (new userController())->saveUser($first_name,$last_name,$address_1,$address_2,$city,$state, $zip,$user_name,
                                    $password,$user_group,$email);
                                    $_SESSION["message"]="New User was created";
                                    echo "<script>window.location='"."add_user.php"."'</script>";
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




    