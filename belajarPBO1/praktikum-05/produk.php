<?php

declare(strict_types=1);
require_once __DIR__ . '/Mahasiswa.php';

class produk
{
  public $nama;
  protected $kategori;
  private $harga;
  public function __construct($nama, $kategori, $harga)
  {
    $this->nama = $nama;
    $this->kategori = $kategori;
    $this->harga = $harga;
  }
  public function tampilkanHarga()
  {
    return $this->harga;
  }
}

class ProdukDigital extends Produk
{
  public function tampilkanKategori()
  {
    // Protected dapat diakses oleh class turunan.
    return $this->kategori;
  }
  // Harga bersifat private di class Produk.
  // Method ini tidak dapat mengakses $this->harga
  // secara langsung sebagai properti private milik Produk.
}
