<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CONSTRUKTUR PHP</title>
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
    <h1>Construktor PHP</h1>
    <p>Welcome to pembelajaran PHP Raden</p>
  </header>

  <!-- Container -->
  <div class="container">

    <!-- Main Content -->
    <main class="main-content">
      <h2>Construktor</h2>
      <p>
        Konstruktor adalah metode khusus yang dijalankan ketika objek dibuat dengan new.
        Konstruktor mengatur keadaan awal objek, misalnya NIM, nama, dan semester.
        Konstruktor tidak wajib ada; jika didefinisikan, argumen harus mengikuti parameter yang ditetapkan.
        Constructor property promotion (PHP 8+) dapat mempersingkat deklarasi dan pengisian properti.
      </p>

      <p>
        Ini merupakan contoh dari Construktor:
      </p>
      <main class="php">
        <?php
      class Mahasiswa {
        public function __construct(
        public string $nim,
        public string $nama,
        public int $semester = 1
      ) {}
        public function profil(): string {
          return "$this->nim - $this->nama (Semester $this->semester)";
        }
      }
      $mhs = new Mahasiswa('2530521005', 'Raden Muhammad Rizky', 3);
      echo $mhs->profil();
      ?>

        <h2>Destructor</h2>
        <p>
          Destructor adalah method khusus yang dipanggil saat objek dihancurkan, termasuk pada akhir eksekusi normal.
          unset($obj) menghapus variabel/referensi, tetapi tidak menjamin destructor langsung berjalan jika objek masih
          memiliki referensi lain.
          Urutan destructor pada akhir skrip tidak boleh dijadikan ketergantungan logika bisnis.
          Destructor bukan method untuk menghapus record mahasiswa dari Array/Session.
        </p>
        <p>
          Berikut ini merupakan contoh Destructor:
        </p>
        <?php
        class DemoSiklus {
          public function __construct() { echo "Object dibuat<br>"; }
          public function tampil(): void { echo "Method dipanggil<br>"; }
          public function __destruct() { echo "Destructor berjalan<br>"; }
        }
        $obj = new DemoSiklus();
        $obj->tampil();
        unset($obj);
        echo "Program dilanjutkan";
        ?>
      </main>
  </div>
</body>

</html>