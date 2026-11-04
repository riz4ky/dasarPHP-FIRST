<?php
class Mahasiswa
{
  public function hitungBiaya(): int
  {
    return 5000000;
  }
}
class MahasiswaBeasiswa extends Mahasiswa
{
  public function hitungBiaya(): int
  {
    return 2000000;
  }
}
// $a = new Mahasiswa();
// $b = new MahasiswaBeasiswa();
// echo $a->hitungBiaya() . ' | ' . $b->hitungBiaya();

// Method dengan nama yang sama pada child menggantikan implementasi parent
// ketika dipanggil melalui object child. Ini disebut overriding, bukan overloading PHP. Perhatikan
// kompatibilitas signature method saat overriding.
// Hasil yang diharapkan: 5000000 | 2000000