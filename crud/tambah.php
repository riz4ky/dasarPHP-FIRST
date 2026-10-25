<?php 
require "functions.php";
$conn = mysqli_connect("localhost", "root", "Raden1904", "ujicoba");
// cek apakah tombol submit sudah ditekan atau belum
global $conn;  
if ( isset($_POST["submit"]) ) {
    // Cek apakah data berhasil di tambahkan atau tidak
    if ( tambah($_POST) > 0 ) {
      echo"
        <script>
          alert('Data berhasil ditambahkan');
          document.location.href = 'mysql2.php';
        </script>
      ";
  } else{
    echo "
        <script>
          alert('Data gagal ditambahkan');
          document.location.href = 'mysql2.php';
        </script>
      ";
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah data mahasiswa</title>
  <style>
  /* Pengaturan dasar */
  .header {
    background-color: #2563eb;
    margin: 0 auto;
    margin-bottom: 10px;
    color: white;
    padding: 30px;
    border-radius: 12px;
    text-align: center;
    max-width: 500px;
  }

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: Arial, sans-serif;
    background-color: #f1f5f9;
    color: #1e293b;
    padding: 40px 20px;
  }

  /* Container formulir */
  .container {
    max-width: 500px;
    margin: 0 auto;
    padding: 30px;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
  }

  /* Judul */
  h2 {
    text-align: center;
    margin-bottom: 8px;
    color: #1d4ed8;
    font-size: 24px;
  }

  .subtitle {
    text-align: center;
    color: #64748b;
    font-size: 14px;
    margin-bottom: 25px;
  }

  /* Setiap kelompok input */
  .form-group {
    margin-bottom: 18px;
  }

  .form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    font-size: 14px;
  }

  /* Input dan pilihan jurusan */
  .form-group input,
  .form-group select {
    width: 100%;
    padding: 12px;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    font-size: 14px;
    background-color: #ffffff;
    outline: none;
    transition: 0.2s;
  }

  /* Efek ketika input dipilih */
  .form-group input:focus,
  .form-group select:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
  }

  /* Input gambar */
  .form-group input[type="file"] {
    background-color: #f8fafc;
    cursor: pointer;
  }

  /* Tombol tambah */
  .btn-tambah {
    width: 100%;
    padding: 13px;
    margin-top: 5px;
    background-color: #2563eb;
    color: #ffffff;
    border: none;
    border-radius: 6px;
    font-size: 15px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.2s;
  }

  /* Efek hover tombol */
  .btn-tambah:hover {
    background-color: #1d4ed8;
  }

  /* Tampilan untuk layar kecil */
  @media (max-width: 480px) {
    .container {
      padding: 25px;
    }

    h1 {
      font-size: 20px;
      margin-bottom: 5px;
    }
  }
  </style>
</head>

<header>
  <div class="header">
    <h1>Tambah Data Mahasiswa</h1>
  </div>
</header>

<body>
  <div class="container">
    <form action="" method="post" enctype="multipart/from-data">
      <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" placeholder="Masukkan nama lengkap anda" required>
      </div>

      <div class="form-group">
        <label for="nim">NIM</label>
        <input type="text" name="nim" id="nim" placeholder="Masukkan NIM lengkap anda" required>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" placeholder="Masukkan email anda" required>
      </div>

      <div class="form-group">
        <label for="jurusan">Jurusan</label>
        <input type="text" name="jurusan" id="jurusan" placeholder="Masukkan jurusan anda" required>
      </div>

      <div class="form-group">
        <label for="gambar">Foto</label>
        <input type="text" name="gambar" id="gambar" placeholder="Masukkan foto yang anda punya" required>
      </div>

      <button type="submit" name="submit" class="btn-tambah"> + Tambahkan data</button>
      </li>
      </ul>
    </form>
  </div>
</body>

</html>