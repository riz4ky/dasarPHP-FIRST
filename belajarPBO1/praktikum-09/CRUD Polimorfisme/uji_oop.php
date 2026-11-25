<?php

// Mengaktifkan mode debug
define('DEBUG_PBO', true);

// Memanggil class mahasiswa
require 'Mahasiswa.php';

// Membuat objek mahasiswa reguler
$m = new MahasiswaReguler('003', 'Budi', 'TI');

// Menguji overloading
echo $m->tampil() . '<br>';
echo $m->tampil('lengkap') . '<br>';

// Mengubah nama mahasiswa
$m->setNama('Budi Baru');
echo $m->getNama() . '<br>';

// Membuat objek mahasiswa beasiswa
$b = new MahasiswaBeasiswa('004', 'Rina', 'TI');

// Menguji polimorfisme
foreach ([$m, $b] as $objek) {
    echo tampilUKT($objek) . '<br>';
}

// Menghancurkan objek
unset($objek, $m, $b);

?>