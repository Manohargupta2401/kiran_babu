<?php

define("PROJECT_ROOT_PATH", __DIR__ . "/../");
 
// include main configuration file
require_once PROJECT_ROOT_PATH . "/db-handler/config.php";
 
// include the base controller file
require_once PROJECT_ROOT_PATH . "/controller/Api/BaseController.php";
 
// include the use model file
require_once PROJECT_ROOT_PATH . "/model/UserModel.php";

require_once PROJECT_ROOT_PATH . "/lib/ErrorMessage.php";

require_once PROJECT_ROOT_PATH . "/lib/Response.php";

require PROJECT_ROOT_PATH . "/Controller/Api/UserController.php";
?>