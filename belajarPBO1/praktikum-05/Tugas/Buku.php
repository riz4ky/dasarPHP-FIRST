<?php

declare(strict_types=1);
class Buku
{
  private string $kodeBuku;
  private string $judul;
  private int $stok;

  // Constructor
  public function __construct(
    string $kodeBuku,
    string $judul,
    int $stok
  ) {
    $kodeBuku = trim($kodeBuku);

    if ($kodeBuku === '') {
      throw new InvalidArgumentException(
        "Kode buku wajib diisi."
      );
    }

    if ($stok < 0) {
      throw new InvalidArgumentException(
        "Stok awal tidak boleh negatif."
      );
    }

    $this->kodeBuku = $kodeBuku;
    $this->setJudul($judul);
    $this->stok = $stok;
  }

  // Getter kode buku
  public function getKodeBuku(): string
  {
    return $this->kodeBuku;
  }

  // Getter judul
  public function getJudul(): string
  {
    return $this->judul;
  }

  // Getter stok
  public function getStok(): int
  {
    return $this->stok;
  }

  // Setter judul dengan validasi
  public function setJudul(string $judul): void
  {
    $judul = trim($judul);
    if ($judul === '') {
      throw new InvalidArgumentException(
        "Judul buku wajib diisi."
      );
    }
    $this->judul = $judul;
  }
  // Menambah stok
  public function tambahStok(int $jumlah): void
  {
    if ($jumlah <= 0) {
      throw new InvalidArgumentException(
        "Jumlah penambahan stok harus lebih dari 0."
      );
    }
    $this->stok += $jumlah;
  }

  // Mengurangi stok
  public function kurangiStok(int $jumlah): void
  {
    if ($jumlah <= 0) {
      throw new InvalidArgumentException(
        "Jumlah pengurangan stok harus lebih dari 0."
      );
    }

    if ($jumlah > $this->stok) {
      throw new InvalidArgumentException(
        "Stok tidak mencukupi untuk pengurangan tersebut."
      );
    }

    $this->stok -= $jumlah;
  }
}


// Fungsi untuk menguji input tidak valid
function ujiTidakValid(
  string $namaUji,
  callable $aksi
): void {
  try {
    $aksi();

    echo "[GAGAL] {$namaUji}: input seharusnya ditolak.<br>";
  } catch (InvalidArgumentException $e) {

    echo "[BERHASIL DITOLAK] {$namaUji}: " .
      $e->getMessage() . "<br>";
  }
}


// ==================================
// PENGUJIAN INPUT VALID
// ==================================

echo "<h3>DUA CONTOH INPUT VALID</h3>";

// Pengujian valid 1
$buku1 = new Buku(
  "BK001",
  "Dasar Pemrograman PHP",
  10
);

$buku1->tambahStok(5);
$buku1->kurangiStok(3);
$buku1->setJudul("Pemrograman PHP 8");

echo "Valid 1: ";
echo $buku1->getKodeBuku() . " | ";
echo $buku1->getJudul() . " | ";
echo "Stok: " . $buku1->getStok() . "<br>";


// Pengujian valid 2
$buku2 = new Buku(
  "BK002",
  "Pengantar Basis Data",
  0
);

$buku2->tambahStok(8);

echo "Valid 2: ";
echo $buku2->getKodeBuku() . " | ";
echo $buku2->getJudul() . " | ";
echo "Stok: " . $buku2->getStok() . "<br>";


// ==================================
// PENGUJIAN INPUT TIDAK VALID
// ==================================

echo "<h3>CONTOH INPUT TIDAK VALID</h3>";

// Pengujian 1: kode buku kosong
ujiTidakValid(
  "Kode buku kosong",
  fn() => new Buku("   ", "Judul Buku", 2)
);

// Pengujian 2: judul kosong
ujiTidakValid(
  "Judul kosong",
  fn() => new Buku("BK003", "   ", 2)
);

// Pengujian 3: stok negatif
ujiTidakValid(
  "Stok awal negatif",
  fn() => new Buku("BK004", "Judul Buku", -1)
);

// Pengujian 4: tambah stok nol
ujiTidakValid(
  "Tambah stok nol",
  function () use ($buku1): void {
    $buku1->tambahStok(0);
  }
);

// Pengujian 5: pengurangan melebihi stok
ujiTidakValid(
  "Kurangi stok melebihi persediaan",
  function () use ($buku2): void {
    $buku2->kurangiStok(100);
  }
);