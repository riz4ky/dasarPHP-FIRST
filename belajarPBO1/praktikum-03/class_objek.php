<?php
class mahasiswa
{
  public string $nama = "";
  public function sapa(): string
  {
    return "Hallo, nama saya " . $this->nama;
  }
}

$mahasiswa1 = new mahasiswa("Mahasiswa baru");
$mahasiswa1->nama = "Raden";
echo $mahasiswa1->sapa();
