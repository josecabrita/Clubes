<?php 

require_once "SimpleClube.php";
require_once "Clubes.php";

class  ClubesHandler extends SimpleClube
{
    function getAllMobiles()
    {
        $mobile = new Mobile();
        $rawData = $mobile->getAllMobile();

        if (empty($rawData)) {
            $statusCode = 404;
            $rawData = array(
                'error' => 'No mobiles found!'
            );
        } else {
            $statusCode = 200;
        }

        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this->setHttpHeaders($requestContentType, $statusCode);

        if (strpos($requestContentType, 'application/json') !== false) {
            $response = $this->encodeJson($rawData);
            echo $response;
        } else if (strpos($requestContentType, 'text/html') !== false) {
            $response = $this->encodeHtml($rawData);
            echo $response;
        } else if (strpos($requestContentType, 'application/xml') !== false) {
            $response = $this->encodeXml($rawData);
            echo $response;
        }
    }

}














?>