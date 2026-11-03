<?php
//Koneksi ke database
$conn = mysqli_connect("localhost", "root", "Raden1904", "ujicoba");

function query($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

// Fungsi untuk button tambah
function tambah($data)
{
  global $conn;
  $nama = htmlspecialchars($data["nama"]);
  $nim = htmlspecialchars($data["nim"]);
  $email = htmlspecialchars($data["email"]);
  $jurusan = htmlspecialchars($data["jurusan"]);
  // Upload Gambar 
  $gambar = upload();
  if ($gambar) {
    return false;
  }

  $query = "INSERT INTO mahasiswa
            (nama, nim, email, jurusan, gambar)
            VALUES
            ('$nama', '$nim', '$email', '$jurusan', '$gambar')
            ";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function upload()
{
  $namaFile = $_FILES['gambar']['name'];
  $ukuranFIle = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmpName = $_FILES['gambar']['tmp_name'];

  // Cek apakah tidak ada gambar yang diupload
  if ($error === 4) {
    echo "<script>
          alert('Pilih gambar terlebih dahulu');
          </script>";
    return false;
  }

  // Cek apakah yang diupload gambar atau bukan
  $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
  $ekstensiGambar = explode('.', $namaFile);
  $ekstensiGambar = strtolower(end($ekstensiGambarValid));
  if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
    echo "<script>
          alert('Yang anda upload bukan sebuah gambar');
          </script>";
    return false;
  }

  // Cek Jika ukuran gambar terlalu besar
  if ($ukuranFIle > 1000000) {
    echo "<script>
          alert('Ukuran Gambar Terlalu besar');
          </script>";
    return false;
  }

  // Lolos Pengecekan Gambar
  move_uploaded_file($tmpName, 'belajar_php/crud/img/' . $namaFile);
  return $namaFile;
}

// Fungsi untuk menghapus data
function hapus($id)
{
  global $conn;
  mysqli_query($conn, "DELETE FROM mahasiswa WHERE id=$id");
  return mysqli_affected_rows($conn);
}

// Fungsi untuk mengubah data
function ubah($data)
{
  global $conn;
  $id = $data["id"];
  $nama = htmlspecialchars($data["nama"]);
  $nim = htmlspecialchars($data["nim"]);
  $email = htmlspecialchars($data["email"]);
  $jurusan = htmlspecialchars($data["jurusan"]);
  $gambar = htmlspecialchars($data["gambar"]);

  $query = "UPDATE mahasiswa SET
              nama = '$nama',
              nim = '$nim',
              email = '$email',
              jurusan = '$jurusan',
              gambar = '$gambar'
            WHERE id = $id
            ";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

// Fungsi untuk button cari
function cari($keyword)
{
  $query = "SELECT * FROM mahasiswa 
            WHERE 
            nama LIKE '%$keyword%' OR
            nim LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%'
            ";
  return query($query);
}