<?php
ob_start();
session_start();
defined("DS") ? null : define("DS",DIRECTORY_SEPARATOR);
defined("TEMPLATE_CUSTOMER") ? null : define("TEMPLATE_CUSTOMER",__DIR__.DS."templates/customer");
defined("TEMPLATE_ADMIN") ? null : define("TEMPLATE_ADMIN",__DIR__.DS."templates/admin");
function redirect($location){header("Location : $location");}


?>

