<?php
require Doctrine\DBAL\DriverManager;

$connectionParams = array(
    'url' => 'mysql://bdaa096600bffd:24eff3d4@eu-cdbr-west-03.cleardb.net/heroku_5c9e28cdaa57eac?reconnect=true',
);
$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);

if(!empty($conn)){
    print_r($conn);
}