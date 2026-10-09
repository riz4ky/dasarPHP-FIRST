<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>STRUKTUR KENDALI</title>
  <style>
  .warna-baris {
    background-color: black;
  }
  </style>
</head>

<body>
  <h1>STRUKTUR KENDALI</h1>
  <p>Struktur kendali digunakan untuk mengontrol alur eksekusi program.</p>
  <p>Struktur kendali terbagi menjadi dua jenis: struktur kondisi dan struktur perulangan.</p>

  <h2>Struktur Kendali Perulangan</h2>
  <p>Struktur perulangan digunakan untuk mengulangi eksekusi blok kode tertentu selama kondisi yang ditentukan
    terpenuhi.</p>
  <p>Struktur perulangan umumnya terdiri dari tiga bagi menjadi: </p>
  <ul>
    <li><B>Perulangan for</B></li>
    <p>Contoh perulangan menggunakan For yaitu:</p>
    <?php 
    //Harus menggunakan tanda dolar ($) sebelum nama variabel
    // Jika i = 0, dan i < 5, maka lakukan perulangan 
    for( $i = 0; $i < 5; $i++ ) {
      echo "Perulangan for ke-$i <br>";
     }
    ?>
    <br>

    <li><B>Perulangan while</B></li>
    <p>Contoh perulangan menggunakan while yaitu:</p>
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

    <br>
    <li><B>Perulangan do while</B></li>
    <p>Contoh perulangan menggunakan do while yaitu:</p>
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
    <h2>LATIHAN PERULANGAN</h2>
    <P>Latihan perulangan dengan menggunakan tabel</P>
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

  <h2>Struktur Kendali Pengkondisian</h2>
  <p>Struktur kendali digunakan untuk menentukan percabangan</p>
  <p>Struktur kendali terdiri dari:</p>
  <ul>
    <li><b>Pengkondisian IF ELSE</b></li>
    <P>Contoh pengkondisian IF ELSE yaitu:</P>
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

    <br>
    <p>Contoh Pengkondisian IF ELSE dengan menggunakan tabel</p>
    <table border="1" cellpadding="10" cellspacing="0">
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
    </table>
    <br>

    <li><b>Pengkondisian TERNARY</b></li>
    <p>Pengkondisian ternary (operator) dibagi menjadi tiga jenis yaitu:</p>
    <p>Operator Unary yang memproses satu nilai</p>
    <p>Operator Binary yang memproses dua nilai</p>
    <p>Operator Ternary yang memproses tiga nilai</p>

    <p>Operator secara keseluruhan dibagi menjadi tujuh belas jenis: </p>
    <li>Operator Aritmetika</li>
    <p>Penjumlahan (+)</p>
    <p>Pengurangan (-)</p>
    <p>Perkalian (*)</p>
    <p>Pembagian (/)</p>
    <p>Modulo (%)</p>
    <p>Perpangkatan (**)</p>

    <li><b>Pengkondisian SWITCH</b></li>
    <p>Pengkondisian SWITCH digunakan untuk melakukan tindakan yang berbeda berdasarkan kondisi yang berbeda.</p>
    <p>Contoh penggunaan SWITCH yaitu:</p>
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
  </ul>
  </ul>

</body>

</html>