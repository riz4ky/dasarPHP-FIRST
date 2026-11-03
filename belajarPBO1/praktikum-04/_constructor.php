<?php

declare(strict_types=1);
class Mahasiswa // Mendefinisikan class Mahasiswa
{
  public string $nim; // Mendefinisikan atribut NIM dengan tipe data strin
  public string $nama; // Mendefinisikan atribut nama dengan tipe data string 
  public string $asalSekolah; // Mendefinisikan atribut asalSekolah dengan tipe data string
  public int $semester; // Mendefinisikan atribut semester dengan tipe data integer 
  public string $fakultas; // Mendefinisikan atribut fakultas dengan tipe data string 
  public string $jurusan; // Mendefinisikan atribut jurusan dengan tipe data string
  // Constructor
  public function __construct(
    string $nim,
    string $nama,
    string $asalSekolah,
    int $semester,
    string $fakultas = "Belum diisi",
    string $jurusan = "Belum diisi"
  ) {
    $this->nim = $nim; // Digunakan untuk mengisi nilai parameter kedalam atribut NIM
    $this->nama = $nama; // Digunakan untuk mengisi nilai parameter kedalam atribut nama
    $this->asalSekolah = $asalSekolah; // Digunakan untuk mengisi nilai parameter kedalam atribut asalSekolah
    $this->semester = $semester; // Digunakan untuk mengisi nilai parameter kedalam atribut semester 
    $this->fakultas = $fakultas; // Digunakan untuk mengisi nilai parameter kedalam atribut fakultas 
    $this->jurusan = $jurusan; // Digunakan untuk mengisi nilai parameter kedalam atribut jurusan 
  }

  // Method untuk menampilkan profil mahasiswa
  public function profil(): string // Mendefinisikan method yang digunakan untuk mengembalikan informasi mahasiswa dalam bentuk string
  {
    return
      "NIM: $this->nim<br>" .
      "Nama: $this->nama<br>" .
      "Asal Sekolah: $this->asalSekolah<br>" .
      "Semester: $this->semester<br>" .
      "Fakultas: $this->fakultas<br>" .
      "Jurusan: $this->jurusan<br>";
  }
}

// Membuat objek pertama dengan fakultas
$mhs1 = new Mahasiswa( // Merupakan objek pertama yang dibuat dengan memberikan
  "2530521005",
  "Raden Muhammad Rizky",
  "SMA Negeri 4 Sukabumi",
  3,
  "Sains dan Teknologi",
  "Teknik Informatika"
);

// Membuat objek kedua tanpa fakultas
$mhs2 = new Mahasiswa(
  "2530521006",
  "Wirayudhabuana P",
  "SMA Negeri 3 Sukabumi",
  3,
  "Belum diisi",
  "Teknik Informatika"
);

// Menampilkan hasil
echo "<h3>Data Mahasiswa 1</h3>";
echo $mhs1->profil(); // Digunakan untuk memanggil method profil()

echo "<hr>";

echo "<h3>Data Mahasiswa 2</h3>";
echo $mhs2->profil();
