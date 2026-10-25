<?php
//Koneksi ke database
$conn = mysqli_connect("localhost", "root", "Raden1904", "ujicoba");
// Menggunakan variabel conn (connection) agar mempermudah dalam query

//Mengambil data dari tabel mahasiswa/ query data mahasiswa.
$result = mysqli_query($conn, "SELECT * FROM mahasiswa"); 
if($result){
  echo mysqli_error($conn);
}
//Sintaks SQL disarankan menggunakan huruf kapital semua.
// Disimpan dalam variabel result agar melakukan sesuai dengan perintah true.
// Namun jika melakukan perintah yang salah, maka akan menampilkan perintah false.
// Tujuannya adalah agar mencegah menulisan query yang salah.
// Menggunakan var_dump untuk mencegah error

// Mengambil data (fetch) mahasiswa dari $result
// Terdapat berbagai cara dalam mengambil sebuah data:
// 1. mysqli_fetch_row() mengembalikan array numeric dan harus menggunakan parameter[]
// Contohnya yaitu:
// $mhs = mysqli_fetch_row($result);
// var_dump($mhs[3]); 

// 2. mysqli_fetch_assoc() mengembalikan array asosiatif, dapat diakses melalui string parameter["nama"]
// Contohnya yaitu:
// $mhs = mysqli_fetch_assoc($result);
// var_dump($mhs["NIM"]); 


// 3. mysqli_fetch_array() mengembalikan array yang dapat berupa pemanggilan string maupun menggunakan parameter[]
// Kekurangannya adalah data yang disajikan menjadi double dan membuat pemrosesan menjadi lebih berat.
// Contohnya yaitu:
// $mhs = mysqli_fetch_array($result);
// var_dump($mhs["NIM"]); 

// 4. mysqli_fetch_object()
// $mhs = mysqli_fetch_object($result);
// var_dump($mhs->email); 

// Kita akan menggunakan pemanggilan assoc
// Agar data yang ditampilkan tidak hanya satu, maka kita perlu melakukan perulangan:
// while( $mhs = mysqli_fetch_assoc($result) ){
//   var_dump($mhs); 
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Admin</title>
</head>

<body>
  <h1>Daftar Mahasiswa</h1>
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
    <?php while( $row = mysqli_fetch_assoc( $result ) ) :?>
    <tr>
      <td><?=  $i; ?></td>
      <td>
        <a href="">Ubah</a> |
        <a href="">Hapus</a>
      </td>
      <td><img src="img/gambar1.jpeg <?php echo $row["gambar"];?>" width="50"></td>
      <td><?php echo $row["nim"];?></td>
      <td><?php echo $row["nama"];?></td>
      <td><?php echo $row["email"];?></td>
      <td><?php echo $row["jurusan"];?></td>
    </tr>
    <?php $i++; ?>
    <?php endwhile; ?>
  </table>

</body>

</html>