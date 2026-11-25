<?php

echo "File konfigurasi PHP: ";
echo php_ini_loaded_file();

echo "<br><br>";

echo "Lokasi log PHP: ";
echo ini_get('error_log');

echo "<br><br>";

error_log("Ini adalah percobaan log PHP Laragon.");

echo "Pengujian selesai.";
?>