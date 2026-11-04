<?php
class LaporanMahasiswa{
 private string $nama;
  // Constructor
  public function __construct(string $nama)
  {
    $this->nama = $nama;
  }

  // Magic method __call()
  public function __call(string $method, array $args): mixed
  {
    // Memeriksa nama method yang diizinkan
    if ($method === 'cetakRingkas' && count($args) === 0) {
      return "Mahasiswa: " . $this->nama;
    }
    // Jika method tidak tersedia
    throw new BadMethodCallException(
      "Method tidak tersedia: " . $method
    );
  }
}

// Membuat objek laporan mahasiswa
$laporan = new LaporanMahasiswa("Raden");
echo "<h3>Pengujian Magic Method __call()</h3>";
// Menguji method yang diizinkan
try {
  echo $laporan->cetakRingkas();
} catch (BadMethodCallException $e) {
  echo "Terjadi kesalahan: " . $e->getMessage();
}
echo "<br><br>";

// Menguji method yang tidak diizinkan
try {
  echo $laporan->cetakDetail();
} catch (BadMethodCallException $e) {
  echo "Terjadi Exception: " . $e->getMessage();
}
