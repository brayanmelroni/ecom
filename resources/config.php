<?php
    /**
     * Output buffering turned on. 
     * A session is srarted.
     * Some constants used within the website are defined. 
     * A function is declared to be used for redirection.  
     * */
    ob_start();
    session_start();
    defined("DS") ? null : define("DS",DIRECTORY_SEPARATOR);
    defined("TEMPLATE_CUSTOMER") ? null : define("TEMPLATE_CUSTOMER",__DIR__.DS."templates/customer");
    defined("TEMPLATE_ADMIN") ? null : define("TEMPLATE_ADMIN",__DIR__.DS."templates/admin");
    function redirect($location){header("Location : $location");}

?>

