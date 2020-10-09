<?php
require_once('./vendor/autoload.php');
use \Doctrine\DBAL\DriverManager as ORM;

echo "\r include succ.";

$connectionParams = array(
    'url' => getenv('PGSQL_DATABASE_URL'),
    'driver' => 'pdo_pgsql',

);
$conn = ORM::getConnection($connectionParams);

if(!empty($conn)){
    echo "\n Connected succ.";
}

$data = "<dtt:Kod>9</dtt:Kod>";
$t = time();

$count = $conn->insert('firma', array('ico' => '9087089', 'published' => date("d-m-Y h:i:s",$t), 'data' => $data));;
echo "\r inserted {{$count}} rows";
