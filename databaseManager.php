<?php
require_once('./vendor/autoload.php');
use \Doctrine\DBAL\DriverManager as ORM;

echo "\n include succ.";

$connectionParams = array(
    'url' => getenv('CLEARDB_DATABASE_URL'),
);
$conn = ORM::getConnection($connectionParams);

if(!empty($conn)){
    echo "\n Connected succ.";
    print_r($conn);
}