<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <?php include("top_nav.php"); ?>
</nav>

<?php
    
    if($_SESSION["message"]!=null){
        echo "<div class='alert alert-success fade in' id='messageArea'> 
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"
            .$_SESSION["message"].
        "</div>"; 
        $_SESSION["message"]=null;
    }
    
?>


