<?php

declare(strict_types=1);
abstract class Pegawai
{
  private string $id;
  private string $nama;
  private string $jenispekerjaan;
  public function __construct(string $id, string $nama, string $jenispekerjaan)
  {
    $id = trim($id);
    $nama = trim($nama);
    $jenispekerjaan = trim($jenispekerjaan);
    if ($id === '') {
      throw new InvalidArgumentException('ID wajib diisi.');
    }
    if ($nama === '') {
      throw new InvalidArgumentException('Nama wajib diisi.');
    }
    if ($jenispekerjaan === '') {
      throw new InvalidArgumentException('Jenis pekerjaan wajib diisi.');
    }
    $this->id = $id;
    $this->nama = $nama;
    $this->jenispekerjaan = $jenispekerjaan;
  }

  public function getId(): string
  {
    return $this->id;
  }

  public function getNama(): string
  {
    return $this->nama;
  }

  public function getJenisPekerjaan(): string
  {
    return $this->jenispekerjaan;
  }
  abstract public function hitungGaji(): int;
}
