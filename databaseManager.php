<?php
// namespace \vendor;
use \Doctrine\DBAL\DriverManager as ORM;

echo "include succ.";

$connectionParams = array(
    'url' => $_ENV('CLEARDB_DATABASE_URL'),
);
$conn = ORM::getConnection($connectionParams);

if(!empty($conn)){
    echo "Connected succ.";
    print_r($conn);
}