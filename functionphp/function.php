<!-- Variabel PHP -->
<?php
  $nama = "Raden Rizky";
  $umur = 19;
  $prodi = "Teknik Informatika";

?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Function Dalam PHP</title>
  <style>
  /* Pengaturan dasar */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    background-color: #f4f4f4;
    color: #333;
  }

  /* Bagian Header */
  .header {
    background-color: #2563eb;
    color: white;
    padding: 25px;
    text-align: center;
  }

  .header h1 {
    margin-bottom: 10px;
  }

  /* Container utama */
  .container {
    max-width: 1000px;
    margin: 30px auto;
    padding: 20px;
  }

  /* Bagian Main Content */
  .main-content {
    background-color: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 2px 8px #00000015;
  }

  .main-content h2 {
    margin-bottom: 15px;
    color: #2563eb;
  }

  .main-content p {
    line-height: 1.6;
    margin-bottom: 15px;
    text-align: justify;
  }

  /* Tombol */
  .tombol {
    background-color: #2563eb;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .php {
    line-height: 1.6;
    margin-bottom: 15px;
    text-align: justify
  }
  </style>
</head>

<body>

  <!-- Header -->
  <header class="header">
    <h1>Function Dalam PHP</h1>
    <p>Welcome to pembelajaran PHP Raden</p>
  </header>

  <!-- Container -->
  <div class="container">

    <!-- Main Content -->
    <main class="main-content">

      <h2>Funtion Dalam PHP</h2>
      <p>
        Fungsi adalah sekumpulan kode yang dibuat untuk menjalankan tugas tertentu dan dapat dipanggil kembali ketika
        diperlukan.
        Penggunaan fungsi membantu membuat program lebih terstruktur, mengurangi pengulangan kode, dan mempermudah
        pemeliharaan aplikasi.
        Dalam PHP, fungsi dapat dibuat menggunakan kata kunci function, diikuti nama fungsi, tanda kurung, dan blok kode
        di dalam kurung kurawal.
      </p>
      <p>
        Fungsi dalam php sangatlah banyak. Adapun berikut ini merupakan beberapa fungsi yang sering digunakan dalam php
        yaitu:
      </P>

      <h2>Date/Time</h2>
      <p>
        Tanggal dan waktu akan sangat sering digunakan dalam mengembangkan web dan aplikasi.
        Adapun function dalam Date/Time yaitu:
      </p>
      <ul><b>Time()</b></ul>
      <p>Time berbeda dengan date. Time menghasilkan timestamp yaitu waktu yang dihitung dari awal mula terciptanya
        komputer yaitu pada tahun 1977 Contoh penggunaan time yaitu:
      </p>
      <main class="php">
        <?php 
          echo time(). "<br>"; //Digunakan untuk menentukan timestamp dalam satuan detik
          echo strtotime("06/10/2026"); //strtotime digunakan untuk mengeksport hari,bulan,tanggal,tahun ke timestamp
        ?>
      </main>

      <ul><b>Date()</b></ul>
      <p>
        Date digunakan untuk menentukan waktu, baik itu waktu tahun, bulan,
        hari, tanggal, jam, dan detik. Sebagai contoh berikut ini:
      </p>
      <main class="php">
        <?php 
        echo date("Y"). " Adalah Tahun yang baik dalam hidup saya"."<br>"; // Y besar untuk tahun lengkap (2026)
        echo date("y"). " Ini merupakan tahun tetapi disingkat hanya angka nya saja"."<br>"; // y kecil untuk tahun singkatan (26)
        echo date("M"). " Bulan Oktober semoga saya menjadi lebih baik lagi"."<br>"; // M untuk bulan
        echo date("m"). " Ini merupakan bulan tetapi ditampilkan dalam bentuk angka"."<br>"; // m kecil untuk bulan ke- berapa
        echo date("D"). " Hari ini merupakan hari jumat (Friday)"."<br>"; //D untuk day
        echo date("d"). " Ini merupakan tanggal, tetapi dalam bentuk angka"."<br>"; // d untuk tanggal
        echo date("H"). " Ini merupakan jam tetapi untuk waktu selama 24 jam"."<br>"; // H besar untuk waktu 24 jam
        echo date("h"). " Ini merupakan jam tetapi untuk waktu selama 12 jam"."<br>"; // h kecil untuk waktu 12 jam
        echo date("A"). " Ini merupakan jam tetapi untuk menentukan AM/PM"."<br>"; // A besar untuk menentukan AM/PM
        echo date("a"). " Ini merupakan jam tetapi untuk menentukan AM/PM tetapi dalam huruf kecil "."<br>"; // A kecil untuk menentukan AM/PM (huruf kecil)
        echo date("I"). " I besar digunakan untuk menit. Jika malam 0, Jika siang 1"."<br>"; // I besar untuk menit jika 0 malam, 1 pagi
        echo date("i"). " i kecil digunakan untuk menit"."<br>"; // i kecil untuk menit
        echo date("S"). " S besar digunakan untuk format english"."<br>"; // s Besar untuk format english
        echo date("s"). " s kecil untuk detik"."<br>"; // i kecil untuk detik
        //Contoh penggunaan date digabung
        echo "<br>";
        echo "Sebagai contoh penggunaan function waktu yaitu: <br>";
        echo " Tanggal dan Waktu: ". date("d/m/Y H:i:s", 3600); 
      ?>
      </main>
    </main>
  </div>
</body>

</html>