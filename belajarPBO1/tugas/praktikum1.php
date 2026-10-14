<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PRAKTIKUM 1 DENGAN MENGGUNAKAN PHP</title>

</head>

<body>
  <h1>LAPORAN NILAI MATA KULIAH STRUKTUR DATA</h1>
  <p>Biodata sebagai berikut: </p>
  <?php 
      $nama = "Raden Muhammad Rizky";
      $umur = 19;
      $nim = 2530521005;
      $kelas = "3A";
      $fakultas = "Sains dan Teknologi";
      $prodi = "Teknik Informatika";
      $mahasiswaaktif = true;
      $matakuliah = "struktur data";
      $nilaitugas = 95.5;
      $nilaiujian = 94.7;
  ?>
  <br>

  <?php
      if ($nilaitugas >= 75) {
      echo "Status : nilai tugas aman <br>";
      } elseif ($nilaiujian >= 80) {
      echo "Status : nilai ujian juga aman <br>";
      } else {
      echo "Status : nilai tugas dan ujian tidak aman!!! perlu diperbaiki <br>";
      }

      function hitungNilaiAkhir($nilaitugas, $nilaiujian) {
      return ($nilaitugas * 0.4) + ($nilaiujian * 0.6);
      }
      $nilaiAkhir = hitungNilaiAkhir($nilaitugas, $nilaiujian);

      echo "Nama Lengkap   : ", $nama. "<br>";
      echo "Umur           : ", $umur. "<br>";
      echo "NIM            : ", $nim ."<br>";
      echo "Fakultas       : ", $fakultas. "<br>";
      echo "Program Studi  : ", $prodi."<br>";
      echo "Mata Kuliah    : ", $matakuliah."<br>";
      echo "Nilai tugas saya yaitu  : ", $nilaitugas."<br>";
      echo "Nilai ujian saya yaitu  : ", $nilaiujian."<br>";
      echo "Nilai akhir saya yaitu  : ", $nilaiAkhir."<br>";
    ?>
  <br>

  <?php
      echo "Status saya lulus <br>";
       for ($i = 1; $i <= 5; $i++) {
      echo "Saya lulus mata kuliah struktur data <br>";
      }
?>
</body>

</html>