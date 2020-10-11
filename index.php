<?php 
if(empty($_GET['orderBy'])){
  header('Location: https://vast-garden-09239.herokuapp.com/?orderBy=name');
}
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
    <input name="ico" class="form-control" type="text" pattern="[0-9]+" id="ico" placeholder="Zadejte IČO">
    </div>
    <button type="submit" class="btn btn-primary">Hledat</button>
    
    </form>
    
        </div>
    <div class="col-sm">
    <a href="/?orderBy=name"> Seřadit dle jména </a><br>
    <a href="/?orderBy=date"> Seřadit dle data vyhledání </a><br>

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
      
  }

   } catch (\Throwable $th) {
     echo "Připojení k databázi selhalo.\r Error: ". $th;
   }

   
  
  ?>

<div class="container">
  <table class="table table-bordered table-striped sortable">
    <caption>
    Optional table caption.
    </caption>
    <thead>
      <tr>
        <th data-defaultsign="_19">#</th>
        <th data-defaultsign="AZ">First Name</th>
        <th>Last Name</th>
        <th data-defaultsign="month">Birthday</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td data-value="1">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td data-dateformat="MM-DD-YYYY">11-11-1970</td>
      </tr>
      <tr>
        <td  data-value="2">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td data-dateformat="MM-DD-YYYY">11-11-1980</td>
      </tr>
      <tr>
        <td data-value="3">3</th>
        <td>Larry</td>
        <td>the Bird</td>
        <td data-dateformat="MM-DD-YYYY">11-11-1960</td>
      </tr>
    </tbody>
  </table>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script> 
  <script src="https://www.jqueryscript.net/demo/jQuery-Plugin-For-Sortable-Bootstrap-Tables-Bootstrap-Sortable/Scripts/bootstrap-sortable.js"></script> 
</div>

    <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href='<?php echo "/?orderBy=".$_GET['orderBy']."&"."page=".($_GET['page']-1); ?>'>Previous</a></li>
    <li class="page-item"><a class="page-link" href="/#1">1</a></li>
    <li class="page-item"><a class="page-link" href="/#2">2</a></li>
    <li class="page-item"><a class="page-link" href="/#3">3</a></li>
    <li class="page-item"><a class="page-link" href='<?php echo "/?orderBy=".$_GET['orderBy']."&"."page=".($_GET['page']-1); ?>'>Next</a></li>
  </ul>
</nav>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha512-3P8rXCuGJdNZOnUx/03c1jOTnMn3rP63nBip5gOP2qmUh5YAdVAvFZ1E+QLZZbC1rtMrQb+mah3AfYW11RUrWA==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



  </body>
</html>

