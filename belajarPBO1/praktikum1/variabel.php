<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>VARIABEL DAN TIPE DATA</title>
</head>

<body>
  <h1>VARIABEL DAN TIPE DATA DARI PHP</h1>
  <p>Variabel dan tipe data di php contohnya yaitu:</p>
  <?php 
        $nama = "Raden Muhammad Rizky";
        $NIM = "2530521005";
        $umur = "19";
        $jurusan = "Teknik Informatika";
        $nilai = "89,6";
        echo "Nama saya adalah: ", $nama. "<br>";
        echo "NIM saya adalah: ", $NIM. "<br>";
        echo "Umur saya adalah: ", $umur. "<br>";      
        echo "Saya kuliah di jurusan: ", $jurusan. "<br>";  
        echo "Nilai terakhir saya adalah: ", $nilai. "<br>";  

        $str = "Hari ini hari minggu";
        $int = 70;
        $float = 89.77;
        $bool = 90>8;
        echo "Contoh tipe data dari string yaitu : ", $str. "<br>";
        echo "Contoh Tipe data dari Integer yaitu : ", $int. "<br>";
        echo "Contoh Tipe data dari Float yaitu : ", $float. "<br>";
        echo "Contoh Tipe data dari Boolean yaitu : ", $bool. "<br>";
      ?>
  <br>
</body>

</html>