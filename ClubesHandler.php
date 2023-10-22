<?php 

require_once "SimpleClube.php";
require_once "Clubes.php";

class  ClubesHandler extends SimpleClube
{
    function getAllEquipas()
    {
        $clubes = new Clubes();
        $rawData = $clubes->conn->query($clubes->getAllClubes());
        $linha = array();
        $dados = array();
        while($row = $rawData->fetch_assoc())
        {
            $linha['id'] = $row['id'];
            $linha['nome'] = $row['nome'];
            $linha['data_criacao'] = $row['data_criacao'];
            $linha['localidade'] = $row['localidade'];
            $linha['emblema'] = base64_encode($row['emblema']);
            $linha['link'] = $row['link'];
            $linha['estadio'] = base64_encode($row['estadio']);

            $dados[] = $linha;
        }
        
        //$rawData = $mobile->getAllMobile();
        
        if (empty($dados)) {
            $statusCode = 404;
            $dados = array(
                'error' => 'Nenhum clube encontrado!'
            );
        } else {
            $statusCode = 200;
        }
        

        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        //$this->setHttpHeaders($requestContentType, $statusCode);
        $temp = explode(',',$requestContentType);
        $type = $temp[0];
        
        $this->setHttpHeaders($type, $statusCode);
           
        //return $dados;


        if (strpos($requestContentType, 'application/json') !== false) {
            $response = $this->encodeJson($dados);
            echo $response;
        } else if (strpos($requestContentType, 'text/html') !== false) {
            $response = $this->encodeHtml($dados);
            echo $response;
        } else if (strpos($requestContentType, 'application/xml') !== false) {
            $response = $this->encodeXml($dados);
            echo $response;
           
        }
        else{
            //echo "Error no type";
            $response = $this->encodeJson($dados);
            echo $response;
        }
        
    }

    public function encodeHtml($responseData)
    {
        /*
        $htmlResponse = "<table border='1'><tr><th>ID</th>";
        foreach ($responseData as $key => $value) {
            $htmlResponse .= "<tr><td>" . $key . "</td><td>" . $value . "</td></tr>";
        }
        $htmlResponse .= "</table>";
*/
$htmlResponse="";
for($x=0;$x<count($responseData); $x++)
{
foreach ($responseData[$x] as $key => $value) {
    $htmlResponse .= $key . " : " . $value." , ";
}
//echo "<br>";
}
        //return $responseData;
        return $htmlResponse;
    }

    public function encodeJson($responseData)
    {
        $jsonResponse = json_encode($responseData);
        return $jsonResponse;
    }

    public function encodeXml($responseData)
    {
        // creating object of SimpleXMLElement
        $xml = new SimpleXMLElement('<?xml version="1.0"?><mobile></mobile>');
        foreach ($responseData as $key => $value) {
            $xml->addChild($key, $value);
        }
        return $xml->asXML();
    }

    public function getClassification()
    {
        //
    }

}












?>