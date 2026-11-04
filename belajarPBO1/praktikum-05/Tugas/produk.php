<?php

declare(strict_types=1);
class Produk
{
  public string $nama;
  protected string $kategori;
  private int $harga;

  public function __construct(
    string $nama,
    string $kategori,
    int $harga
  ) {
    $this->nama = trim($nama);
    $this->kategori = trim($kategori);

    if ($this->nama === '' || $this->kategori === '') {
      throw new InvalidArgumentException(
        "Nama dan kategori wajib diisi."
      );
    }

    if ($harga < 0) {
      throw new InvalidArgumentException(
        "Harga tidak boleh negatif."
      );
    }

    $this->harga = $harga;
  }

  public function tampilkanInfo(): string
  {
    return "Nama: {$this->nama} | " .
      "Kategori: {$this->kategori} | " .
      "Harga: Rp" .
      number_format($this->harga, 0, ',', '.');
  }
}

class ProdukDigital extends Produk
{
  public function bacaKategoriDariAnak(): string
  {
    return $this->kategori;
  }
}

// Membuat object Produk
$produk = new Produk(
  "Laptop Lenovo",
  "Barang Elektronik",
  8500000
);

echo "=== UJI AKSES DARI LUAR CLASS ===<br>";

// Mengakses property public
echo "Nama produk: " . $produk->nama . "<br>";

// // Mengakses property protected
// try {
//   echo $produk->kategori;
// } catch (Error $e) {
//   echo "Kategori ditolak: " .
//     $e->getMessage() . "<br>";
// }

// // Mengakses property private
// try {
//   global $harga;
//   echo $produk->harga;
// } catch (Error $e) {
//   echo "Harga ditolak: " .
//     $e->getMessage() . "<br>";
// }

// Menguji property protected dari class turunan
echo "<br>=== UJI CLASS TURUNAN ===<br>";
$produkDigital = new ProdukDigital(
  "E-Book PHP",
  "Produk Digital",
  75000
);

echo "Kategori dari class turunan: " .
  $produkDigital->bacaKategoriDariAnak();
echo "<br><br>=== INFORMASI PRODUK ===<br>";
echo $produk->tampilkanInfo();