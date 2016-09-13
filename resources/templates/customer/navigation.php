<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <?php include("top_nav.php"); ?>
</nav>

<?php
    if($_SESSION["message"]){
                echo "<div class='alert alert-info'>".$_SESSION["message"]."</div>"; 
                $_SESSION["message"]=null;
    }
?>