<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FUNCTION PHP</title>
</head>

<body>
  <h1>FUNCTION MENGGUNAKAN PHP</h1>
  <p>Contoh Function dasar dalam PHP yaitu</p>
  <?php
      function hitungLuas($panjang, $lebar) {
      return $panjang * $lebar;
    }
      $hasil = hitungLuas(10, 5);
      echo "Luas = " . $hasil;
    ?>
</body>

</html>