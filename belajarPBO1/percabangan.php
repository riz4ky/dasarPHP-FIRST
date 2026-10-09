<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PERCABANGAN PHP</title>
</head>

<body>
  <h1>PERULANGAN DENGAN MENGGUNAKAN PHP</h1>
  <p>Berikut ini contoh percabangan menentukan nilai true or false</p>
  <?php 
    $x = 90; 
    if ( $x > 0) {
      echo "TRUE, karena", " ", $x , " ","besar dari 0";
    } 
    elseif ( $x == 0) {
      echo "Tengah-tengah";
    }
    else{
      echo "FALSE, periksa kembali operator";
    }
    ?>
  <br>
</body>

</html>