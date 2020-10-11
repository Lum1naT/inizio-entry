<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Inizio IČO entry</title>
  </head>
  <body>
    <?php
    echo "Hello World";
    include_once './databaseManager.php';
    echo "<br>";

    ?>

    <form>
    <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input name="ico" class="form-control" type="text" pattern="[0-9]+" id="ico" placeholder="Zadejte IČO">
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Firma</label>
    <input name="firma" class="form-control" type="text">
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Ulice</label>
    <input name="ulice" class="form-control" type="text">
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Město</label>
    <input name="mesto" class="form-control" type="text">
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">PSC</label>
    <input name="psc" class="form-control" type="text">
    </div>
    
    </form>

    <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href='<?php echo "/?page=".($_GET['page']-1); ?>'>Previous</a></li>
    <li class="page-item"><a class="page-link" href="/#1">1</a></li>
    <li class="page-item"><a class="page-link" href="/#2">2</a></li>
    <li class="page-item"><a class="page-link" href="/#3">3</a></li>
    <li class="page-item"><a class="page-link" href='<?php echo "/?page=".($_GET['page']+1); ?>'>Next</a></li>
  </ul>
</nav>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha512-3P8rXCuGJdNZOnUx/03c1jOTnMn3rP63nBip5gOP2qmUh5YAdVAvFZ1E+QLZZbC1rtMrQb+mah3AfYW11RUrWA==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <script type='text/javascript'>

$(document).ready(function(){
 $('#ico').change( function() {
   var ico = $(this).val();
   $.ajax({
    type: "POST",
    url: "/formHandler.php",
    contentType: "application/json; charset=utf-8",
    dataType: "json", 
    data: "ico="+ico,
    cache: false,
    success: function(data) {
     if (data.stav == 'ok') {
      $('input[name=dic]').val(data.dic);
      $('input[name=firma]').val(data.firma);
      $('input[name=ulice]').val(data.ulice);
      $('input[name=mesto]').val(data.mesto);
      $('input[name=psc]').val(data.psc);
      alert('Název a sídlo firmy bylo vyplněno z databáze ARES.');
     } else {
      alert(data.stav);
     }
    },
   });
  });
});

  </script>

  </body>
</html>

