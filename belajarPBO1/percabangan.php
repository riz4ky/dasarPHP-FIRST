<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PERCABANGAN PHP</title>
</head>

<body>
  <h1>PERCABANGAN DENGAN MENGGUNAKAN PHP</h1>
  <p>Berikut ini contoh percabangan menentukan nilai true or false</p>
  <?php 
    $nilai = 90; 
    if ( $nilai >= 85) {
      echo " Nilai mata kuliah struktur data sangat baik yaitu ", $nilai. "<br>";
    } 
    elseif ( $nilai >= 80) {
      echo "Nilai mata kuliah struktur data baik yaitu ", $nilai. "<br>";
    }
    else{
      echo "Perlu melakukan remedial";
    }
    ?>
  <br>
</body>

</html>