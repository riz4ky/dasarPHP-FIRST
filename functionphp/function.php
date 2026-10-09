<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Function Dalam PHP</title>
</head>

<body>
  <h1>FUNCTION DALAM PHP/<h1>
      <p>Fungsi dalam php sangatlah banyak.</p>
      <P>Adapun berikut ini merupakan beberapa fungsi yang sering digunakan dalam php yaitu:</P>

      <h2>Date/Time</h2>
      <p>Tanggal dan waktu akan sangat sering digunakan dalam mengembangkan web dan aplikasi.</p>
      <p>Adapun function dalam Date/Time yaitu:</p>
      <ul><b>Time()</b></ul>
      <p>Time berbeda dengan date. Time menghasilkan timestamp yaitu </p>
      <p>Contoh penggunaan time yaitu:</p>
      <?php 
        echo time(). "<br>"; //Digunakan untuk menentukan timestamp dalam satuan detik
        echo strtotime("06/10/2026"); //strtotime digunakan untuk mengeksport hari,bulan,tanggal,tahun ke timestamp
      ?>
      <br>
      <ul><b>Date()</b></ul>
      <p>Date digunakan untuk menentukan waktu</p>
      <?php 
        echo date("Y")."<br>"; // Y besar untuk tahun lengkap (2026)
        echo date("y")."<br>"; // y kecil untuk tahun singkatan (26)
        echo date("M")."<br>"; // M untuk bulan
        echo date("m")."<br>"; // m kecil untuk bulan ke- berapa
        echo date("D"). "<br>"; //D untuk day
        echo date("d")."<br>"; // d untuk tanggal
        echo date("H")."<br>"; // H besar untuk waktu 24 jam
        echo date("h")."<br>"; // h kecil untuk waktu 12 jam
        echo date("A")."<br>"; // A besar untuk menentukan AM/PM
        echo date("a")."<br>"; // A kecil untuk menentukan AM/PM (huruf kecil)
        echo date("I")."<br>"; // I besar untuk menit jika 0 malam, 1 pagi
        echo date("i")."<br>"; // i kecil untuk menit
        echo date("S")."<br>"; // s Besar untuk format english
        echo date("s")."<br>"; // i kecil untuk detik
        //Contoh penggunaan date digabung
        echo " Tanggal dan Waktu: ". date("d/m/Y H:i:s", 3600); 
      ?>
      <ul><b>mkTime()</b></ul>


</body>

</html>