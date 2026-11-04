<?php
class MahasiswaDinamis
{
  // Menyimpan atribut tambahan
  private array $atributTambahan = [];

  // Constructor
  public function __construct(
    public string $nim,
    public string $nama
  ) {}

  // Magic method __set()
  public function __set(string $key, mixed $value): void
  {
    // Atribut yang diizinkan
    $diizinkan = ['hobi'];
    if (!in_array($key, $diizinkan, true)) {
      throw new InvalidArgumentException(
        "Atribut tidak diizinkan: $key"
      );
    }
    $this->atributTambahan[$key] = $value;
  }

  // Magic method __get()
  public function __get(string $key): mixed
  {
    if (!array_key_exists($key, $this->atributTambahan)) {
      throw new OutOfBoundsException(
        "Atribut tidak ditemukan: $key"
      );
    }
    return $this->atributTambahan[$key];
  }

  // Magic method __isset()
  public function __isset(string $key): bool
  {
    return isset($this->atributTambahan[$key]);
  }

  // Magic method __unset()
  public function __unset(string $key): void
  {
    unset($this->atributTambahan[$key]);
  }
}

// Membuat objek mahasiswa
$mhs = new MahasiswaDinamis(
  "2530521005",
  "Raden Muhammad Rizky"
);

// Menguji __set()
$mhs->hobi = "Membaca";
echo "<h3>Pengujian Magic Methods</h3>";

// Menguji __get()
echo "Nama: " . $mhs->nama . "<br>";
echo "NIM: " . $mhs->nim . "<br>";
echo "Hobi: " . $mhs->hobi . "<br><br>";

// Menguji __isset()
if (isset($mhs->hobi)) {
  echo "Hobi tersedia.<br>";
} else {
  echo "Hobi tidak tersedia.<br>";
}

// Menguji __unset()
unset($mhs->hobi);

// Memeriksa kembali setelah dihapus
if (isset($mhs->hobi)) {
  echo "Hobi masih tersedia.<br>";
} else {
  echo "Hobi berhasil dihapus.<br>";
}
