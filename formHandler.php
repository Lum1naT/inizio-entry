<?php

session_start;

require_once('./vendor/autoload.php');
use \Doctrine\DBAL\DriverManager as ORM;

header("Content-Type: application/json; charset=UTF-8");
define('ARES','http://wwwinfo.mfcr.cz/cgi-bin/ares/darv_bas.cgi?ico=');
date_default_timezone_set('Europe/Prague');

if($_POST['ctrl'] == 'inizioentry'){
$ico = intval($_POST['ico']);
$file = @file_get_contents(ARES.$ico);
if ($file) $xml = @simplexml_load_string($file);
$a = array();
if ($xml) {
 $ns = $xml->getDocNamespaces();
 $data = $xml->children($ns['are']);
 $el = $data->children($ns['D'])->VBAS;
 if(empty(strval($el->ICO))){ $_SESSION["error"] = 'IČ firmy nebylo nalezeno';  header('Location: https://vast-garden-09239.herokuapp.com/?orderBy=name&page=1'); }
 if (strval($el->ICO) == $ico) {
  $a['ico'] 	= strval($el->ICO);
  $a['dic'] 	= strval($el->DIC);
  $a['name'] 	= strval($el->OF);
  if(!empty($el->AA->NU)){
      $a['street']	= strval($el->AA->NU).' '.strval($el->AA->CD);
    } else {
        $a['street']	= strval($el->AA->N).' '.strval($el->AA->CD);
    }
  $a['city']	= strval($el->AA->N);
  $a['zip']	= strval($el->AA->PSC);
  $a['state'] 	= 'ok';
 } else 
 $_SESSION["error"] = 'IČ firmy nebylo nalezeno';
} else
$_SESSION["error"] = 'Databáze ARES není dostupná';

try {

    $connectionParams = array(
        'url' => getenv('PGSQL_DATABASE_URL'),
        'driver' => 'pdo_pgsql',
    
    );
    $conn = ORM::getConnection($connectionParams);
    
    if(!empty($conn)){
        echo "\n Connected succ.";
    }
    
    $t = time();


    $count = $conn->insert('firma', array('ico' => $a['ico'], 
                                            'published' => date("d-m-Y H:i:s",$t),
                                            'dic' => $a['dic'],                                           
                                            'name' => $a['name'],
                                            'street' => $a['street'],
                                            'city' => $a['city'],
                                            'zip' => $a['zip']));

  header('Location: https://vast-garden-09239.herokuapp.com/?orderBy=name&page=1');
} catch (\Throwable $th) {
    throw $a["state"]." Error:".$th;
}

} else {
    echo "Chyba. Zkuste to prosím znovu.";
}

