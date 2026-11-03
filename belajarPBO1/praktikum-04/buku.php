<?php

class Buku
{

  public string $judul;
  public string $penulis;
  public int $tahun;
  public string $penerbit;

  // Constructor
  public function __construct(
    string $judul,
    string $penulis,
    int $tahun,
    string $penerbit
  ) {
    $this->judul = $judul;
    $this->penulis = $penulis;
    $this->tahun = $tahun;
    $this->penerbit = $penerbit;
  }

  // Method untuk menampilkan informasi buku
  public function tampilInfo(): string
  {
    return "Judul Buku: $this->judul<br>" .
      "Penulis: $this->penulis<br>" .
      "Tahun Terbit: $this->tahun<br>" .
      "Penerbit: $this->penerbit<br>";
  }
}

// Membuat tiga objek buku
$buku1 = new Buku(
  "Sunah-sunah Rasulullah",
  "Ahmad ROfi'i",
  2022,
  "Pustaka Al-Umm"
);

$buku2 = new Buku(
  "Belajar Web Programming",
  "Budi Santoso",
  2023,
  "Erlangga"
);

$buku3 = new Buku(
  "Jago SQL Untuk Pemula",
  "Hendra Wijaya",
  2024,
  "Informatika Cerdas"
);

// Menampilkan informasi buku
echo "<h3>Data Buku 1</h3>";
echo $buku1->tampilInfo();
echo "<hr>";

echo "<h3>Data Buku 2</h3>";
echo $buku2->tampilInfo();
echo "<hr>";

echo "<h3>Data Buku 3</h3>";
echo $buku3->tampilInfo();
