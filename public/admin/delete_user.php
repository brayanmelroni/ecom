<?php
    session_start();
    require_once(dirname(__FILE__)."/../../resources/backend/controllers/userController.php");
    $rowsDeleted=(new userController())-> deleteUser($_GET["del_user"]);
    if($rowsDeleted >0){
        $_SESSION["message"]="User ".$_GET['del_user']." was successfully deleted";
    }
    else{
        $_SESSION["message"]="User could not be deleted";
    }
    echo "<script>window.location='"."users.php"."'</script>";
?>
