<?php
ob_start();
session_start();
defined("DS") ? null : define("DS",DIRECTORY_SEPARATOR);
defined("TEMPLATE_DIR") ? null : define("TEMPLATE_DIR",__DIR__.DS."templates");
defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK",__DIR__.DS."templates/back");
function redirect($location){header("Location : $location");}
?>
