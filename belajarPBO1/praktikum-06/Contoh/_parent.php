<?php
trait BisaCetak
{
  public function cetak(): string
  {
    return 'Siap dicetak';
  }
}
class Mahasiswa
{
  public function label(): string
  {
    return 'Mahasiswa';
  }
}
class MahasiswaReguler extends Mahasiswa
{
  use BisaCetak;
  public function label(): string
  {
    return parent::label() . ' Reguler';
  }
}
// $m = new MahasiswaReguler();
// echo $m->label() . ' - ' . $m->cetak();

// parent::label() memanggil implementasi milik parent. Trait menyisipkan method
// yang dapat digunakan kembali; ini tidak berarti child memiliki dua parent. PHP hanya
// mengizinkan satu class parent pada extends.
// Hasil yang diharapkan: Mahasiswa Reguler - Siap dicetak