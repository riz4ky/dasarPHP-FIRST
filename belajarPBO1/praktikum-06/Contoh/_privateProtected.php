<?php
class Mahasiswa
{
  private string $nim = '23001';
  protected string $kategori = 'Mahasiswa';
  public function getNim(): string
  {
    return $this->nim;
  }
}
class MahasiswaReguler extends Mahasiswa
{
  public function info(): string
  {
    // return $this->nim; // SALAH: private milik parent
    return $this->getNim() . ' / ' . $this->kategori;
  }
}
// echo (new MahasiswaReguler())->info();

//  Property private pada parent tidak dapat diakses langsung dari child; gunakan
// method public/protected yang disediakan. Protected dapat diakses langsung dari child, tetapi
// tetap tidak bisa diakses langsung dari kode luar.
// Hasil yang diharapkan: 23001 / Mahasiswa