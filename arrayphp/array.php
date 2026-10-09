<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ARRAY DALAM PHP</title>
</head>

<body>
  <h1>ARRAY DALAM PHP</h1>
  <p>Array merupakan sebuah struktur data yang digunakan untuk menyimpan sekumpulan data dengan tipe yang sama</p>
  <p>Array dibagi menjadi beberapa bagian yaitu:</p>
  <p>Item di dalam array dapat berupa tpe data apapun.</p>
  <ul>
    <li><b>Array Standar</b></li>
    <p>Array standar yaitu sebuah array yang berisikan data-data dan diakses melalui indeks tertentu.</p>
    <p>Dalam array yang diindeks, setiap item memiliki nomor indeks.</p>
    <p>Item array pertama memiliki indeks 0, item array kedua memiliki indeks 1, dll.</p>
    <p>Contoh dari array yaitu: </p>
    <?php 
       $array1 = ["Raden", "Kaza", "Ahmi", "Yuda", "Mulqi"];
      print_r($array1); //print_r untuk menampilkan seluruh isi data
      ?>
    <br>
    <p>Kita juga dapat mengetahui jumlah isi data di dalam array dengan cara berikut ini:</p>
    <?php 
       $array3 = ["Tomat","Bawang","Telor", ];
       echo count($array3);
      ?>
    <br>
    <p>Kita juga dapat mengubah nilai item array dengan menggunakan nomor indeks:</p>
    <?php 
    $buah = ["Belimbing","Jeruk","Mangga","Nanas","Nangka"];
    $buah[2] = "Lengkeng";
    var_dump($buah);
    ?>
    <br>
    <p>Kita juga dapat melakukan looping di dalam aaray untuk menampilkan semua item array</p>
    <?php 
    $buah = ["Belimbing","Jeruk","Mangga","Nanas","Nangka"];
    foreach ( $buah as $x) { 
      echo "$x <br>";
    }
    ?>
    <br>

    <li><b>Asosiatif Array</b></li>
    <p>Array biasa harus menggunakan index, namun asosiatif array dapat mengakses berbagai indeks contoh nya nama,
      kelas,dll</p>
    <p>Contoh dari asosiatif array yaitu:</p>
    <?php 
  $array3 = [
  "nama" => "raden",
  "usia" => "19",
  "status" => "mahasiswa"
  ];
  print_r($array3);
  ?>
    <br>
    <li><b>Multidimensional Array</b></li>
    <p>Yaitu gabungan dari Array biasa dan Asosiatif Array</p>
    <P>Contohnya yaitu:</P>
    <?php 
  $namakelompok = [
    [
    "nama" => "Raden",
    "usia" => "19",
    "kelas" => "3A",
    ],
    [
    "nama"=> "Mulqi",
    "usia" => "19",
    "kelas" => "3C"
    ],
    [
    "nama"=> "Kaza",
    "usia"=> "19",
    "kelas"=> "3C"
    ]
  ];
  print_r($namakelompok);
  print_r($namakelompok [2]);
  //Jadi dimensional Array itu gabungan dari array biasa dan asosiatif array.
  //Jadi kita bisa mengakses semua isi di dalamnya, maupun mengakses index tertentu.
  ?>
  </ul>
</body>

</html>