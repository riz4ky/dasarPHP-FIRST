<?php
class Mahasiswa
{
  public function __construct(private string $nama) {}
  public function getNama(): string
  {
    return $this->nama;
  }
}
class MahasiswaReguler extends Mahasiswa //MahasiswaReguler merupakan turunan dari class Mahasiswa
{
  public function jenis(): string
  {
    return 'Reguler';
  }
}
$m = new MahasiswaReguler('Andi');
echo $m->getNama() . ' - ' . $m->jenis();

// Pembahasan: MahasiswaReguler tidak mendefinisikan getNama(), tetapi dapat memanggil
// method public yang diwariskan dari Mahasiswa. Constructor parent otomatis diwarisi jika child
// tidak mendefinisikan constructor sendiri.
// Hasil yang diharapkan: Andi - Reguler