<!-- Array PHP -->
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Array Dalam PHP</title>
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
    <h1>Array Dalam PHP</h1>
    <p>Welcome to pembelajaran PHP Raden</p>
  </header>

  <!-- Container -->
  <div class="container">

    <!-- Main Content -->
    <main class="main-content">
      <h2>Array</h2>
      <p>
        Array adalah struktur data yang digunakan untuk menyimpan beberapa nilai dalam satu variabel.
        Tanpa array, programmer perlu membuat banyak variabel berbeda untuk menyimpan setiap data.
        Dengan array, beberapa nilai yang saling berhubungan dapat dikelompokkan sehingga lebih mudah dikelola dan
        diproses.
      </p>

      <p>
        Array merupakan sebuah struktur data yang digunakan untuk menyimpan sekumpulan data dengan tipe yang sama
        Array dibagi menjadi beberapa bagian yaitu:
        Item di dalam array dapat berupa tpe data apapun.
      </p>

      <h2>Array Standar</h2>
      <p>
        Array standar yaitu sebuah array yang berisikan data-data dan diakses melalui indeks tertentu.
        Dalam array yang diindeks, setiap item memiliki nomor indeks.
        Item array pertama memiliki indeks 0, item array kedua memiliki indeks 1, dll.
        Contoh dari array yaitu:
      </p>
      <main class="php">
        <?php 
        $array1 = ["Raden", "Kaza", "Ahmi", "Yuda", "Mulqi"];
        print_r($array1); //print_r untuk menampilkan seluruh isi data
      ?>
        <br>
      </main>

      <p>Kita juga dapat mengubah nilai item array dengan menggunakan nomor indeks:</p>
      <main class="php">
        <?php 
        $buah = ["Belimbing","Jeruk","Mangga","Nanas","Nangka"];
        $buah[2] = "Lengkeng";
        var_dump($buah);
      ?>
        <br>
      </main>

      <p>Kita juga dapat melakukan looping di dalam aaray untuk menampilkan semua item array</p>
      <main class="php">
        <?php 
        $buah = ["Belimbing","Jeruk","Mangga","Nanas","Nangka"];
        foreach ( $buah as $x) { 
        echo "$x <br>";
        }
      ?>
        <br>
      </main>

      <p><b>Asosiatif Array</b></p>
      <p>
        Array biasa harus menggunakan index, namun asosiatif array dapat mengakses berbagai indeks contoh nya nama,
        kelas,dll. Contoh dari asosiatif array yaitu:
      </p>
      <main class="php">
        <?php 
        $array3 = [
        "nama" => "raden",
        "usia" => "19",
        "status" => "mahasiswa"
        ];
        print_r($array3);
      ?>
        <br>
      </main>

      <P><b>Multidimensional Array</b></P>
      <p>
        Yaitu gabungan dari Array biasa dan Asosiatif Array
        Contohnya yaitu:
      </P>
      <main class="php">
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
      </main>
  </div>
</body>

</html>