<?php
require Doctrine\DBAL\DriverManager;

$connectionParams = array(
    'url' => $_ENV('CLEARDB_DATABASE_URL'),
);
$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);

if(!empty($conn)){
    echo "Connected succ.";
    print_r($conn);
}