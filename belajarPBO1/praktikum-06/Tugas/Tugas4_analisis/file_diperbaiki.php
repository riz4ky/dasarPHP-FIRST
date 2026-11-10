<?php
class Alamat
{
  public function __construct(
    private string $jalan,
    private string $kota
  ) {}
  public function getFullAlamat(): string
  {
    return "{$this->jalan}, {$this->kota}";
  }
}

abstract class Mahasiswa
{
  private Alamat $alamat; // Komposisi (has-a)

  public function __construct(string $nim, string $nama, Alamat $alamat)
  {
    $this->alamat = $alamat;
  }
}
