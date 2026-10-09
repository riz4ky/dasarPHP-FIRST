<!-- Variabel PHP -->
<?php
  $nama = "Raden Rizky";
  $umur = 19;
  $prodi = "Teknik Informatika";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Belajar PHP</title>
</head>

<body>
  <h1>
    <?php
      echo "Selamat datang di pemrograman PHP";
    ?>
  </h1>

  <h2> Pengenalan Echo, Variabel. dan Comandliine</h2>
  <p>
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
  </p>
  <p>
    <?php
          //Beikut ini adalah contoh komentar dalam php
          /*
          Komentar ini digunakan untuk multiple vomment atau komentar yang lebih dari satu baris.  
          Komentar ini dapat digunakan untuk memberikan penjelasan pada kode program.
          Komentar ini tidak akan dieksekusi oleh PHP.
          */
          # Komentar ini digunakan untuk single comment atau komentar yang hanya satu baris.
      ?>
  </p>
  <p>
    <?php
          echo "Variabel adalah tempat untuk menyimpan data sementara dalam program. Variabel dapat menyimpan berbagai jenis data seperti string, integer, float, boolean, array, dan objek. <br>";
          echo "Dalam php kita juga dapat membuat sebuah variabel dengan menggunakan tanda dolar ($). Tetapi variabel yang akan dibuat harus ditempatkan pada awal file sebelum doctype html. <br>";
          echo "Adapun contoh variabel yang telah dibuat di atas adalah : <br>";
          echo "$nama = " . $nama . ";<br>";
          echo "$umur = " . $umur . ";<br>";
          echo "$prodi = " . $prodi . ";<br>";
          echo "Kita juga dapat menampilkan nilai dari variabel dengan menggunakan perintah echo. <br>";
          var_dump($nama);
          echo "<br>";
          var_dump($umur);
          echo "<br>";
          var_dump($prodi);
      ?>
  </p>
</body>

</html>