<?php
require_once('./vendor/autoload.php');
use \Doctrine\DBAL\DriverManager as ORM;

echo "\n include succ.";

$connectionParams = array(
    'url' => getenv('PGSQL_DATABASE_URL'),
    'driver' => 'pdo_pgsql',

);
$conn = ORM::getConnection($connectionParams);

if(!empty($conn)){
    echo "\n Connected succ.";
    print_r($conn);
}