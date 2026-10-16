<!-- Control Flow PHP -->
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Control Flow Dalam PHP</title>
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
      <h2>STRUKTUR KENDALI</h2>
      <p>
        Struktur kendali digunakan untuk mengontrol alur eksekusi program.
        Struktur kendali terbagi menjadi dua jenis: struktur kondisi dan struktur perulangan.
      </p>

      <h2>Perulangan</h2>
      <p>
        Perulangan merupakan struktur yang digunakan untuk menjalankan blok kode secara berulang selama kondisi tertentu
        terpenuhi atau selama jumlah pengulangan yang ditentukan belum selesai.
        PHP menyediakan beberapa jenis perulangan, antara lain for, while, do-while, dan foreach. Perulangan membantu
        mengurangi penulisan kode yang sama berkali-kali.
        Struktur perulangan digunakan untuk mengulangi eksekusi blok kode tertentu selama kondisi yang ditentukan
        terpenuhi.
        Struktur perulangan umumnya terdiri dari tiga bagi menjadi:
      </p>

      <p><b> Perulangan FOR</b></p>
      <P>
        Contoh perulangan menggunakan For yaitu:
      </P>
      <main class="php">
        <?php 
        //Harus menggunakan tanda dolar ($) sebelum nama variabel
        // Jika i = 0, dan i < 5, maka lakukan perulangan 
        for( $i = 0; $i < 5; $i++ ) {
        echo "Perulangan for ke-$i <br>";
        }
      ?>
        <br>
      </main>

      <P><b>Perulangan WHILE</b></P>
      <p>
        Contoh perulangan menggunakan While yaitu:
      </p>
      <main class="php">
        <?php 
        // While loop akan mengeksekusi blok kode setidaknya satu kali, dan kemudian memeriksa kondisi untuk menentukan apakah akan melanjutkan perulangan atau tidak.
        // Selama kondisi bernilai true, blok kode akan terus dieksekusi. Jika kondisi bernilai false, perulangan akan berhenti.
        // Cek terlebih dahulu kondisi berikut, kemudian lakukan hal ini ""
        $i = 0;
        while ( $i < 5 ) {
        echo "Ini adalah perulangan while ke-$i <br>";
        $i++; //$i++ saja saja dengan $i = $i+1
        } 
      ?>
      </main>


      <ul><b>Perulangan DO WHILE</b></ul>
      <p>
        Contoh perulangan menggunakan do while yaitu:
      </p>
      <main class="php">
        <?php 
        // Do-while loop akan mengeksekusi blok kode setidaknya satu kali, dan kemudian memeriksa kondisi untuk menentukan apakah akan melanjutkan perulangan atau tidak.
        // Selama kondisi bernilai true, blok kode akan terus dieksekusi. Jika kondisi bernilai false, perulangan akan berhenti.
        // Lakukan hal ini "" dulu selama kondisi bernilai true, dan jika kondisi bernilai false, perulangan akan berhenti.
        $i = 0;
        do {
        echo "Ini adalah perulangan do-while ke-$i <br>";
        $i++; //$i++ saja saja dengan $i = $i+1
        } while ( $i < 5 );
      ?>
      </main>

      <ul><b>Latihan Perulangan</b></ul>
      <p>
        Latihan Perulangan dengan menggunakan tabel
      </p>
      <main class="php">
        <table border="1" cellpadding="10" cellspacing="0">
          <?php 
        //Ini merupakan for untuk baris <tr>
        for( $i = 1; $i <= 3 ; $i++){
          echo "<tr>"; //$i merupakan baris
          //Di dalam for, kita melakukan perulangan for untuk kolom
          for( $j = 1; $j <= 5; $j++){
            echo "<td>$i,$j</td>"; //$j merupakan kolom
          }
          echo"</tr>";
          }
        ?>
        </table>
        </ul>
      </main>

      <h2>Struktur Kendali Pengkondisian</h2>
      <p>
        Struktur kendali digunakan untuk menentukan percabangan
        Struktur kendali terdiri dari:
      </p>
      <p><b>Pengkondisian IF ELSE</b></p>
      <p>Contoh Pengkondisian IF ELSE yaitu: </p>
      <main class="php">
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
      </main>

      <p>Contoh Pengkondisian IF ELSE dengan menggunakan tabel</p>
      <table border="1" cellpadding="10" cellspacing="0">
        <main class="php">
          <?php 
        //Ini merupakan for untuk baris <tr>
        for( $i = 1; $i <= 5 ; $i++){
          if( $i % 2 == 0) {  //JIka tr dibagi 2 hasilnya 0, maka dia akan berwarna hitam.
            echo "<tr class= warna-baris>"; //tr kita berikan warna hitam jika dia genap
          }
          else{
          echo"<tr></tr>";
          }
          //Di dalam for, kita melakukan perulangan for untuk kolom
          for( $j = 1; $j <= 5; $j++){
            echo "<td>$i,$j</td>"; //$j merupakan kolom
          }
          echo"</tr>";
          }
      ?>
        </main>
      </table>

      <p><b>Pengkondisian TERNARY</b></p>
      <p>
        Pengkondisian ternary (operator) dibagi menjadi tiga jenis yaitu:
        Operator Unary yang memproses satu nilai
        Operator Binary yang memproses dua nilai
        Operator Ternary yang memproses tiga nilai
      </p>

      <p>Operator secara keseluruhan dibagi menjadi tujuh belas jenis: </p>
      <p>Operator Aritmetika</p>
      <p>Penjumlahan (+)</p>
      <p>Pengurangan (-)</p>
      <p>Perkalian (*)</p>
      <p>Pembagian (/)</p>
      <p>Modulo (%)</p>
      <p>Perpangkatan (**)</p>

      <p><b>Pengkondisian SWITCH</b></p>
      <p>Pengkondisian SWITCH digunakan untuk melakukan tindakan yang berbeda berdasarkan kondisi yang berbeda.</p>
      <p>Contoh penggunaan SWITCH yaitu:</p>
      <main class="php">
        <?php 
      $warna_buah = "merah";
      switch( $warna_buah ) {  
        case "merah":
          echo "Kamu menyukai buah berwarna merah";
          break;
        case "Hijau":
          echo "Kamu menyukai buah berwarna hijau";
          break;
        case "Coklat":
          echo "Kamu menyukai buah berwarna coklat";
          break;
        default:
        echo "Kamu menyukai buah berwarna merah, hijau, coklat";
      }
      ?>
      </main>
      </ul>
      </ul>
  </div>
</body>

</html>