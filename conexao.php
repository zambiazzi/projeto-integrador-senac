<?php
$servername = "localhost";
$username = "root";
$password = "Root";
$dbname = "db_ProjetoIntegrador";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    echo "Conexão Falhou: ".$conn->connect_error;
}
?>
