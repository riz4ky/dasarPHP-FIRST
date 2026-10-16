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
  <title>PENGENALAN PHP</title>
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
    text-align: justify;
  }
  </style>
</head>

<body>

  <!-- Header -->
  <header class="header">
    <h1>Pengenalan Pemrograman PHP</h1>
    <p>Welcome to pembelajaran PHP Raden</p>
  </header>

  <!-- Container -->
  <div class="container">

    <!-- Main Content -->
    <main class="main-content">
      <h2>Pengrograman PHP</h2>
      <p>
        PHP merupakan singkatan dari PHP: Hypertext Preprocessor, yaitu bahasa pemrograman yang banyak digunakan untuk
        mengembangkan aplikasi berbasis web. PHP termasuk bahasa pemrograman server-side, yang berarti kode PHP
        dijalankan di sisi server sebelum hasilnya dikirimkan kepada pengguna melalui browser.
        PHP dapat digunakan untuk membuat halaman web yang dinamis, mengolah data, memproses formulir, serta
        berkomunikasi dengan database.
      </p>

      <p>
        PHP pertama kali dikembangkan oleh Rasmus Lerdorf pada tahun 1994. Pada awal perkembangannya, PHP digunakan
        untuk membantu pengelolaan halaman web pribadi.
        Seiring berjalannya waktu, PHP berkembang menjadi bahasa pemrograman yang banyak digunakan untuk membangun
        berbagai jenis aplikasi web, mulai dari website sederhana hingga sistem informasi yang kompleks.
      </p>

      <p>
        Contohnya adalah memeriksa data login, menghitung total pembayaran, menyimpan informasi pengguna, dan mengambil
        data dari database.
        PHP juga dapat digabungkan dengan HTML sehingga halaman web bisa menampilkan informasi berdasarkan data yang
        tersedia.
      </p>

      <h2>Sintaks Dasar PHP</h2>
      <p>
        Contoh dari sintaks dari PHP yaitu echo. echo digunakan untuk mencetak segala sesuatu ke layar.
        echo dapat mencetak berbagai jenis data, dimulai dari integer, float, string, dan boolean.
        Berikut ini contoh penggunaan echo
      </p>
      <main class="php">
        <?php
          echo "Halo perkenalkan nama saya". " " . $nama." ". "saya berumur". " " . $umur." " . "tahun saya sedang kuliah di prodi". " " . $prodi. "." ;
          echo "PHP adalah bahasa pemrograman server-side yang digunakan untuk mengembangkan aplikasi web. <br>";
          echo "Dengan PHP, kita dapat membuat halaman web yang dinamis dan interaktif. <br>"; 
          echo "<br>";
          echo "Cara mencetak teks di PHP adalah dengan menggunakan perintah echo atau print.";
          echo "Dengan echo kita dapat mencetak sesuatu baik itu string, integer, dll <br>";
          echo "Contoh mencetak angka dengan echo : <br>";
          echo 90 . "<br>";
          echo 100 . "<br>";
          echo 150 . "<br>";
          echo 800000000 . "<br>";

          echo "<br>";
          echo "Terdapat dua cara mengeluarkan data ke layar yaitu dengan menggunakan echo dan print. ";
          echo "<echo tidak memiliki nilai kembalian, sedangkan print memiliki nilai kembalian 1 sehingga dapat digunakan dalam ekspresi. <br>";
          echo "echo dapat mengambil beberapa parameter, sementara print bisa ambil hanya satu argumen. <br> ";
        ?>
        <?php
          //Beikut ini adalah contoh komentar dalam php
          /*
          Komentar ini digunakan untuk multiple vomment atau komentar yang lebih dari satu baris.  
          Komentar ini dapat digunakan untuk memberikan penjelasan pada kode program.
          Komentar ini tidak akan dieksekusi oleh PHP.
          */
          # Komentar ini digunakan untuk single comment atau komentar yang hanya satu baris.
        ?>
        <br>
        <?php
          echo "Variabel adalah tempat untuk menyimpan data sementara dalam program. Variabel dapat menyimpan berbagai jenis data seperti string, integer, float, boolean, array, dan objek. <br>";
          echo "Dalam php kita juga dapat membuat sebuah variabel dengan menggunakan tanda dolar ($). Tetapi variabel yang akan dibuat harus ditempatkan pada awal file sebelum doctype html. <br>";
          echo "Adapun contoh variabel yang telah dibuat di atas adalah : <br>";
          echo "Nama saya adalah = " . $nama . ";<br>";
          echo "Saya berusia = " . $umur . ";<br>";
          echo "Saya memilih jurusan = " . $prodi . ";<br>";
          echo "Kita juga dapat menampilkan nilai dari variabel dengan menggunakan perintah echo. <br>";
          var_dump($nama);
          echo "<br>";
          var_dump($umur);
          echo "<br>";
        ?>
      </main>
    </main>
  </div>
</body>

</html>