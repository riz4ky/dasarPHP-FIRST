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

    echo "Objek buku berhasil dibuat.<br>";
  }

  // Method untuk menampilkan informasi buku
  public function tampilInfo(): void
  {
    echo "Judul: $this->judul<br>";
    echo "Penulis: $this->penulis<br>";
    echo "Tahun: $this->tahun<br>";
    echo "Penerbit: $this->penerbit<br>";
  }

  // Destructor
  public function __destruct()
  {
    echo "Destructor berhasil berjalan, Objek buku berjudul $this->judul dihancurkan.<br>";
  }
}

// Membuat objek buku
$buku = new Buku(
  "Sunnah-sunah Rasulullah",
  "Ahmad ROfi'i",
  2022,
  "Pustaka Al-Umm"
);

echo "<hr>";
echo "<h3>Informasi Buku</h3>";
$buku->tampilInfo();

// Membuat alias dari objek buku
echo "<hr>";
$alias = $buku;
echo "<br>Buku Alias objek berhasil dibuat.<br>";

// Menghapus referensi pertama
unset($buku);
echo "Variabel buku telah di-unset.<br>";
echo "Destructor belum berjalan karena masih ada alias.<br>";

// Menghapus referensi terakhir
// unset($alias);

echo "Variabel alias telah di-unset.<br>";
