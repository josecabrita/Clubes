<?php 
 header("Access-Control-Allow-Origin: *");
require_once "ClubesHandler.php";

$view = "";
if (isset($_GET["view"]))
    $view = $_GET["view"];
    //echo $view."<br>";

    switch ($view) {

        case "all":
            // to handle REST Url /clubes/list/
            $clubesHandler = new ClubesHandler();
            $clubesHandler->getAllEquipas();
            //print_r($clubesHandler->getAllEquipas());
            //echo "<br>Fim";
            break;
    
        case "classification":
            // to handle REST Url /clubes/show/<id>/
            $clubesHandler = new ClubesHandler();
            $clubesHandler->getClassification();
            break;
    
        case "":
            // 404 - not found;
            echo "Error";
            break;
    }


?>