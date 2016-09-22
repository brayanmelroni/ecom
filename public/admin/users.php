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
                    <div class="col-lg-12">
                        <h1 class="page-header">Users</h1>
                        <?php
                                if($_SESSION["message"]){
                                    echo "<div class='alert alert-info'>".$_SESSION["message"]."</div>"; 
                                    $_SESSION["message"]=null;
                                }
                        ?>
                        <p class="bg-success">
                            <?php echo $message; ?>
                        </p>

                        <a href="add_user.php" class="btn btn-primary">Add User</a>
                    
                        <div class="col-md-12">

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>User name</th>
                                        <th>Address</th>
                                        <th>User Group</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <?php require_once(dirname(__FILE__)."/../../resources/backend/controllers/userController.php");
                                        foreach ((new userController())->allUsers() as $user) {
                                            $user=json_decode($user);
                                            echo "<tr>
                                                <td>{$user->user_id}</td>
                                                <td>{$user->first_name} {$user->last_name}</td>
                                                <td>{$user->username}</td>
                                                <td>{$user->address1}, {$user->address2}, {$user->city}, {$user->state}, {$user->zip}</td>
                                                <td>{$user->user_group}</td>
                                                <td>{$user->email}</td>
                                                <td><a class='btn btn-danger' href='/../../resources/backend/services/delete_user.php?del_user={$user->user_id}'><span class='glyphicon glyphicon-remove'></span></a></td>
                                            </tr>";
                                        }
                                    ?>
    
                                </tbody>
                            </table> <!--End of Table-->
                    
                        </div>

                    </div>
    
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->
    </body>
</html>
