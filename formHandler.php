<?php


require_once('./vendor/autoload.php');
use \Doctrine\DBAL\DriverManager as ORM;

header("Content-Type: application/json; charset=UTF-8");
define('ARES','http://wwwinfo.mfcr.cz/cgi-bin/ares/darv_bas.cgi?ico=');

$ico = intval($_POST['ico']);
$file = @file_get_contents(ARES.$ico);
if ($file) $xml = @simplexml_load_string($file);
$a = array();
if ($xml) {
 $ns = $xml->getDocNamespaces();
 $data = $xml->children($ns['are']);
 $el = $data->children($ns['D'])->VBAS;
 if (strval($el->ICO) == $ico) {
  $a['ico'] 	= strval($el->ICO);
  $a['dic'] 	= strval($el->DIC);
  $a['firma'] 	= strval($el->OF);
  if(!empty($el->AA->NU)){
      $a['ulice']	= strval($el->AA->NU).' '.strval($el->AA->CD);
    } else {
        $a['ulice']	= strval($el->AA->N).' '.strval($el->AA->CD);
    }
  $a['mesto']	= strval($el->AA->N);
  $a['psc']	= strval($el->AA->PSC);
  $a['stav'] 	= 'ok';
 } else
  $a['stav'] 	= 'IČ firmy nebylo nalezeno';
} else
 $a['stav'] 	= 'Databáze ARES není dostupná';

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

    // $count = $conn->insert('firma', array('ico' => '9087089', 'published' => date("d-m-Y h:i:s",$t), 'data' => $data));
    // echo "\r inserted {{$count}} rows";

} catch (\Throwable $th) {
    throw $th;
}

//echo json_encode($a);