<?php
require "functions.php"; //Menggunakan require untuk mengambil dari file lain.
$mahasiswa = query("SELECT * FROM mahasiswa")
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Admin</title>
  <style>
  * {
    margin: 0;
    padding: 10;
    box-sizing: border-box;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
  }

  /* body {
    font-family: Arial, sans-serif;
    background-color: #f1f5f9;
    color: #1e293b;
    padding: 40px 20px;
  } */

  .header {
    background-color: #2563eb;
    margin: 0 auto;
    color: white;
    padding: 30px;
    border-radius: 12px;
    text-align: center;
    max-width: 800px;
    font-size: 20px;
  }

  .main-content {
    max-width: 800px;
    margin: 0 auto;
    padding: 30px;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
  }

  .btn-tambah {
    max-width: 800px;
    margin: 0 auto;
    margin-bottom: 10px;
    padding: 10px;
    color: #1e293b;
    background-color: #2563eb;
    border-radius: 12px;
    transition: 0.2s;
  }

  /* Efek hover tombol */
  .btn-tambah:hover {
    background-color: #1d4ed8;
  }
  </style>
</head>

<header class="header">
  <h1>Daftar Mahasiswa</h1>
</header>

<body>
  <div class="main-content">
    <button type="submit" name="submit" class="btn-tambah">
      <a href="tambah.php">Tambah data mahasiswa</a>
    </button>
    <br>
    <table border="1" cellpadding="10" cellspacing="0">
      <tr>
        <th>No.</th>
        <th>Aksi</th>
        <th>Gambar</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Jurusan</th>
      </tr>

      <?php $i = 1; ?>
      <?php foreach( $mahasiswa as $row): ?>
      <tr>
        <td><?=  $i; ?></td>
        <td>
          <a href="ubah.php?id= <?= $row["id"] ?>">Ubah</a> |
          <a href="hapus.php?id= <?= $row["id"];?>"
            onclick="return confirm('anda yakin ingin menghapus data ini?');">Hapus</a>
        </td>
        <td>
          <img src="img/raden.jpeg" <?= $row["gambar"];?> width="50">
        </td>
        <td><?php echo $row["nim"];?></td>
        <td><?php echo $row["nama"];?></td>
        <td><?php echo $row["email"];?></td>
        <td><?php echo $row["jurusan"];?></td>
      </tr>
      <?php $i++; ?>
      <?php endforeach; ?>
    </table>
  </div>
</body>

</html>