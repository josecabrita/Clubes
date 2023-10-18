<?php 

require_once "ClubesHandler.php";

$view = "";
if (isset($_GET["view"]))
    $view = $_GET["view"];

    switch ($view) {

        case "all":
            // to handle REST Url /mobile/list/
            $mobileRestHandler = new MobileRestHandler();
            $mobileRestHandler->getAllMobiles();
            break;
    
        case "single":
            // to handle REST Url /mobile/show/<id>/
            $mobileRestHandler = new MobileRestHandler();
            $mobileRestHandler->getMobile($_GET["id"]);
            break;
    
        case "":
            // 404 - not found;
            break;
    }

?>