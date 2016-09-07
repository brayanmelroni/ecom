<!-- Configuration-->
<?php require_once("../resources/config.php") ?>
<!DOCTYPE html>
<html lang="en">
    <!-- Header-->
    <?php include(TEMPLATE_DIR.DS."head.php"); ?>
    <body>
        <!-- Navigation -->
        <?php include(TEMPLATE_DIR.DS."navigation.php"); ?>

        <!-- Contact Section -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Contact Us</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form name="sentMessage" id="contactForm" method="post" >
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text"name="name" class="form-control" placeholder="Your Name *" id="name" required data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Your Email *" id="email" required data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="subject" class="form-control" placeholder="Subject *" id="subject" required data-validation-required-message="Please enter a subject.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea name="message" class="form-control" placeholder="Your Message *" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button name="submit" value="submit" type="submit" class="btn btn-xl">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.container -->
         
        <?php
            include(dirname(__FILE__)."/../resources/backend/controllers/mailController.php"); 
            if($_POST["submit"]!=null){
                if((new mailController())->sendMessage($_POST["name"],$_POST["email"],$_POST["subject"],$_POST["message"])){
                    echo "<h2 class='text-center alert-success'>Your message has been sent</h2>";
                    $_POST["name"]=null;  $_POST["email"]=null; $_POST["subject"]=null; $_POST["message"]=null;
                }    
                else 
                    echo "<h2 class='text-center bg-warning'>An error occured</h2>";
            }
            require_once(TEMPLATE_DIR.DS."footer.php"); ?>
    </body>
</html>

