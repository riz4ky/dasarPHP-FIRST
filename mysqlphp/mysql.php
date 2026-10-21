<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Database & MySQL</title>
  <style>
  /* Pengaturan dasar */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    bacground-color: #f4f4f4;
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

  .table {
    border: 1px;
    padding: 16;

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
    <h1>Database & MySQL</h1>
    <p>Welcome to pembelajaran PHP Raden</p>
  </header>

  <!-- Container -->
  <div class="container">

    <!-- Main Content -->
    <main class="main-content">
      <h2>MSQL PHP</h2>
      <p>
        Data adalah sebuah kumpulan informasi/fakta mentah yang berupa angka, karakter, atau simmbol yang belum diolah
        dan tidak memiliki makna bagi pengguna nya.
        Sedangkan informasi adalah sebuah data yang telah diproses, diorganisir, dan disusun dalam konteks tertentu
        sehingga memiliki nilai dan makna bagi pengguna nya.
        Basis data terdiri dari dua suku kata yaitu basis yang artiny atempat, markas, atau gudang penyimpanan.
        Sedangkan data bermakna referensi dunia nyata yang terstruktur dan saling berkaitan.
      </p>

      <p>
        Basis data adalah kumpulan suatu data yang terstruktur dan saling berkaitan dan disimpan di dalam elektronik
        komputer.
        Basis data dikelola menggunakan perangkat lunak khusus yanng disebut DBMS (Database Management System).
      </p>

      <h2>Halaman Admin</h2>
      <p>
        Berikut ini merupakan contoh halaman admin
      </p>
      <table border="2" cellpadding="17" cellspacing="5">
        <tr>
          <th>No.</th>
          <th>Aksi</th>
          <th>Gambar</th>
          <th>NIM</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Jurusan</th>
        </tr>

        <tr>
          <td>1</td>
          <td>
            <a href="">Ubah data disini | </a>
            <a href="">Hapus data disini</a>
          </td>
          <td><img src="img/gambar6.jpeg" alt=""></td>
        </tr>
      </table>

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