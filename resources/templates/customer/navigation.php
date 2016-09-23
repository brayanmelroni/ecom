<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <?php include("top_nav.php"); ?>
</nav>

<?php
    /**
    *  If the session containes a value for session variable: message,  it is displayed.
    *  Then the message session variable is set to null. 
    */
    if($_SESSION["message"]!=null){
        echo "<div class='alert alert-success fade in' id='messageArea'> 
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"
            .$_SESSION["message"].
        "</div>"; 
        $_SESSION["message"]=null;
    }
    
?>


