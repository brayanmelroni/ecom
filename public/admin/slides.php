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
                    <div class="row">
                        <h3 class="bg-success"></h3>
                        <div class="col-xs-3">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="file" name="file">
        
                                </div>
        
                                <div class="form-group">
                                    <label for="title">Slide Title</label>
                                    <input type="text" name="banner_title" class="form-control">
                                </div>
        
                                <div class="form-group">
                                    <input type="submit" name="add_banner">
                                </div>
    
                            </form>
    
                        </div>
    
                        <div class="col-xs-8">
                           
                        </div>

                    </div><!-- ROW-->

                    <hr>

                    <h1>Slides Available</h1>

                    <div class="row">
                        
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>



