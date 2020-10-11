<?php 
if(empty($_GET['orderBy'])){
  header('Location: https://vast-garden-09239.herokuapp.com/?orderBy=name&page=1');
}
session_start;
require_once('./vendor/autoload.php');
use \Doctrine\DBAL\DriverManager as ORM;
?>
<!doctype html>
<html lang="en">
  <head>
  <!-- Sorting -->
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://www.jqueryscript.net/demo/jQuery-Plugin-For-Sortable-Bootstrap-Tables-Bootstrap-Sortable/Contents/bootstrap-sortable.css" rel="stylesheet" type="text/css">
    <title>Inizio IČO entry</title>
  </head>
  <body>
   
  <div class="container">
  <div class="row">
    <div class="col-sm">
      
    </div>
    <div class="col-sm">

    <form action="/formHandler.php" method="post">
    <div class="form-group">
    <label for="exampleInputEmail1">IČO: </label>
    <input name="ico" class="form-control" type="text" pattern="[0-9]+" id="ico" placeholder="Zadejte IČO" required>
    <input name="ctrl" type="hidden" value="inizioentry">
    </div>
    <small style="color: red;"> <?php echo $_SESSION["error"]; $_SESSION["error"] = ""; ?></small>
    <button type="submit" class="btn btn-primary">Hledat</button>
    
    </form>
    
        </div>
    <div class="col-sm">
    <a href="/?orderBy=name&page=1"> Seřadit dle jména </a><br>
    <a href="/?orderBy=published&page=1"> Seřadit dle data vyhledání </a><br>

    </div>
  </div>
</div>

    

  <?php 
   try {



    $connectionParams = array(
      'url' => getenv('PGSQL_DATABASE_URL'),
      'driver' => 'pdo_pgsql',
  
    );

  $conn = ORM::getConnection($connectionParams);
  
  if(!empty($conn)){
    $orderBy = $_GET['orderBy'];
    if($_GET['page'] > 0){
      $sql = "SELECT * FROM firma ORDER BY ".$orderBy." DESC LIMIT 3 OFFSET ".(($_GET['page']*3)-3);
    }
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
  }

  
    $companies = $conn->fetchAll('SELECT * FROM firma');

  
    $totalPages = ceil(count($companies)/3);

   } catch (\Throwable $th) {
     echo "Připojení k databázi selhalo.\r Error: ". $th;
   }

  
  ?>
<?php if(count($companies) != 0){ ?>
<hr>
<div class="container">
  <div class="row">
    <div class="col-sm">
    <form action="" method="get">
    <div class="form-group">
    <input name="firma" class="form-control" type="text" id="firma" placeholder="Hledat dle firmy"> <button type="submit" class="btn btn-primary">Hledat</button>
    </div>
    
    </div>
    <div class="col-sm">

    
        </div>
    <div class="col-sm">
    
   
    
    </form>
    </div>
  </div>
</div>
<div class="container">
  <table class="table table-bordered table-striped sortable">
    <thead>
      <tr>
      <th data-defaultsign="month">Čas vyhledání</th>
      <th data-defaultsign="_19">IČO</th>
      <th data-defaultsign="_19">DIČ</th>
        <th data-defaultsign="AZ">Název Firmy</th>
        <th data-defaultsign="AZ">Ulice</th>
        <th data-defaultsign="AZ">Město</th>
        <th data-defaultsign="AZ">PSČ</th>

      </tr>
    </thead>
    <tbody>
    <?php 
    foreach ($result as $firma) {
      echo "<tr>
      <td data-dateformat='DD-MM-YYYY H:i:s'> {$firma['published']} </td>
      <td> {$firma['ico']} </td>
      <td> {$firma['dic']} </td>
      <td> {$firma['name']} </td>
      <td> {$firma['street']} </td>
      <td> {$firma['city']} </td>
      <td> {$firma['zip']} </td>
      
      </tr>";
    } 
    ?>
    
      
    </tbody>
  </table>
  <?php } else { ?>
<div class="container">
  <div class="row">
    <div class="col-2">
    </div>
    <div class="col-8">
    <h2 > V databázi nebyly nalezeny žádné záznamy, zkuste přidat nový </h2>

    </div>
    <div class="col-2">
    </div>
  </div>
</div>

 <?php } ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script> 
  <script src="https://www.jqueryscript.net/demo/jQuery-Plugin-For-Sortable-Bootstrap-Tables-Bootstrap-Sortable/Scripts/bootstrap-sortable.js"></script> 
</div>


<div class="container">
  <div class="row">
    <div class="col-sm">
      
    </div>
    <div class="col-sm">
    <nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php if($_GET['page'] > 1){ ?>
    <li class="page-item"><a class="page-link" href='<?php echo "/?orderBy=".$_GET['orderBy']."&"."page=".($_GET['page']-1); ?>'>Previous</a></li>
    <li class="page-item"><a class="page-link" href='<?php echo "/?orderBy=".$_GET['orderBy']."&"."page=".($_GET['page']-1); ?>'><?php echo $_GET['page']-1; ?></a></li> 
    <?php } ?>
    <?php if(count($companies) != 0){ ?>
    <li class="page-item active"><a class="page-link" href='<?php echo "/?orderBy=".$_GET['orderBy']."&"."page=".($_GET['page']); ?>'><?php echo $_GET['page']; ?></a></li>

    <?php } 
    if(!($_GET["page"] >= $totalPages)) { ?>
    <li class="page-item"><a class="page-link" href='<?php echo "/?orderBy=".$_GET['orderBy']."&"."page=".($_GET['page']+1); ?>'><?php echo $_GET['page']+1; ?></a></li>

    <li class="page-item"><a class="page-link" href='<?php echo "/?orderBy=".$_GET['orderBy']."&"."page=".($_GET['page']+1); ?>'>Next</a></li>
    <?php } ?>
  </ul>
</nav>
        </div>
    <div class="col-sm">
    
    </div>
  </div>
</div>
    




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha512-3P8rXCuGJdNZOnUx/03c1jOTnMn3rP63nBip5gOP2qmUh5YAdVAvFZ1E+QLZZbC1rtMrQb+mah3AfYW11RUrWA==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



  </body>
</html>

