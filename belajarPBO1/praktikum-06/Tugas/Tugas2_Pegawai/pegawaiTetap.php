<?php

declare(strict_types=1);
require_once __DIR__ . '/Pegawai.php';

final class PegawaiTetap extends Pegawai
{
  private int $gajiPokok;
  public function __construct(string $id, string $nama, int $gajiPokok, string $jenispekerjaan)
  {
    parent::__construct($id, $nama, $jenispekerjaan);
    if ($gajiPokok < 0) {
      throw new InvalidArgumentException('Gaji pokok tidak boleh negatif.');
    }
    $this->gajiPokok = $gajiPokok;
  }

  public function getGajiPokok(): int
  {
    return $this->gajiPokok;
  }

  #[Override]
  public function getJenisPekerjaan(): string
  {
    return parent::getJenisPekerjaan();
  }

  public function hitungGaji(): int
  {
    return $this->gajiPokok;
  }
}