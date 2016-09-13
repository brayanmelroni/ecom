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
                    
                    <?php
                        $requestURI=$_SERVER["REQUEST_URI"];
                        if($requestURI =="/public/admin/" || $requestURI=="/public/admin/index.php"){
                            include(TEMPLATE_ADMIN.DS."admin_content.php");    
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
