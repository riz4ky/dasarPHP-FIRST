<?php

declare(strict_types=1);
require_once __DIR__ . '/pegawaiTetap.php';
require_once __DIR__ . '/pegawaiKontrak.php';

echo "=== Penghitungan Gaji Pegawai === <br>";
$tetap = new PegawaiTetap("P001", "Raden Muhammad Rizky", 6000000, "Dosen");
$kontrak = new PegawaiKontrak("P002", "Wirayudhabuana", 8000000, 72, "Data Analyst");

echo "------------------------------------------------------------ <br>";
echo "Pegawai Tetap : <br> " . $tetap->getId() .
  "<br> Nama : " . $tetap->getNama() .
  "<br>Jenis Pekerjaan: " . $tetap->getJenisPekerjaan() .
  "<br> Gaji : Rp" . number_format($tetap->hitungGaji(), 0, ',', '.') . "<br>";


echo "------------------------------------------------------------ <br>";
echo "Pegawai Kontrak: <br>" . $kontrak->getId() .
  "<br> Nama : " . $kontrak->getNama() .
  "<br>Jenis Pekerjaan: " . $kontrak->getJenisPekerjaan() .
  "<br> Gaji : Rp" . number_format($kontrak->hitungGaji(), 0, ',', '.') . " (" . $kontrak->getJamKerja() . " jam x Rp" . number_format($kontrak->getUpahPerJam(), 0, ',', '.') . ")";
