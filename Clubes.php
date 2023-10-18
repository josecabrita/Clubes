<?php 

class Clubes
{
    
    public $servername;
    public $username;
    public $password;
    public $db_name;
    public $port;
    public $conn;

    function __construct($servername="localhost",$db_name="futebol", $username="root", $password="", $port=3308)
    {
        $this->servername= $servername;
        $this->username = $username;
        $this->password = $password;
        $this->db_name = $db_name;
        $this->port = $port;

        $this->conn = new mysqli($servername, $username, $password, $db_name, $port);
        //return $conn;

    }

    public function getAllClubes()
    {
        $query = "SELECT id, nome, localidade FROM Clubes;";
        return $query;
    }
}
echo "Inicio\n";
$obj = new Clubes();
//var_dump($obj->conn);
$result = $obj->conn->query($obj->getAllClubes());



  // output data of each row
  while($row = $result->fetch_assoc()) 
  {
    echo "id: " . $row["id"]. " - Nome: " . $row["nome"]. " " . $row["localidade"]. "\n";
  }


echo "Fim";

?>