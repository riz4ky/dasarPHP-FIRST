<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SUPERGLOBAL PHPP</title>
</head>

<>
  <h1>VARIABEL SCOPE DALAM PHP</h1>
  <p>PHP Superglobals adalah variabel bawaan yang selalu dapat diakses di semua cakupan</p>
  <p>Beberapa variabel yang telah ditentukan sebelumnya dalam PHP adalah "superglobal",</p>
  <p>yang berarti bahwa mereka selalu dapat diakses, apa pun cakupannya - dan Anda dapat mengaksesnya dari mana saja</p>
  <p>fungsi, kelas atau file tanpa harus melakukan sesuatu yang istimewa.</p>
  <p>Adapun variabel dari superglobal PHP adalah:</p>

  <h2>Variabel Superglobal</h2>
  <ul><b>$GLOBALS</b></ul>
  <p>Sebuah array yang berisi referensi ke semua variabel global dari script</p>
  <br>

  <ul><b>$_SERVER</b></ul>
  <p>Memegang informasi tentang server web termasuk header, path, dan script lokasi</p>
  <br>

  <ul><b>$_REQUEST</b></ul>
  <p>Sebuah array yang berisi data dari $_GET, $_POST, dan $_COOKIE superglobals</p>
  <br>

  <ul><b>$_POST</b></ul>
  <p>Sebuah array variabel yang diterima melalui metode HTTP POST</p>
  <br>

  <ul><b>$_GET</b></ul>
  <p>Sebuah array variabel yang diterima melalui metode HTTP GET</p>
  <p>Contoh nya:</p>
  <?php 
  // $_GET["nama"] = "Raden Muhammad Rizky";
  // $_GET["NIM"] = "2530521005";
  var_dump($_GET);
  // echo $_SERVER["SERVER_PROTOCOL"];
  ?>
  <p>Kita juga dapat menambahkan data ke dalam variabel GET melalui URL dengan cara ".php?nama=raden"</p>
  <p>Bila kita ingin menambahkan lagi data melalui URL, maka tambahkan "&NIM=2530521005"</p>
  <br>

  <ul><b>$_FILES</b></ul>
  <p>Sebuah array item yang diunggah ke script saat ini melalui metode HTTP POST (nama file, jenis, ukuran)</p>
  <br>

  <ul><b>$_ENV</b></ul>
  <p>Memegang variabel lingkungan yang diteruskan ke skrip saat ini</p>
  <br>

  <ul><b>$_COOKIE</b></ul>
  <p>Sebuah array variabel yang diteruskan ke script saat ini melalui HTTP Cookies</p>
  <br>

  <ul><b>$_SESSION</b></ul>
  <p>Sebuah array variabel sesi</p>
  <br>
  </body>

</html>




<?php
$x = 50;
echo($x);
function tampilx() {
  $x = 90;
  echo $x;
}

tampilx(); 
?>