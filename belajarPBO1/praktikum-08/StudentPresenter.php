<?php

declare(strict_types=1);

class StudentPresenter
{
    public function __call(
        string $name,
        array $args
    ): string {

        // Memeriksa nama method
        if ($name !== 'showData') {
            throw new BadMethodCallException(
                "Method tidak ditemukan: {$name}"
            );
        }

        // Memeriksa jumlah argumen
        if (count($args) !== 3) {
            throw new InvalidArgumentException(
                "showData harus menerima tepat 3 argumen."
            );
        }

        // Memeriksa tipe data ketiga argumen
        foreach ($args as $arg) {
            if (!is_string($arg)) {
                throw new InvalidArgumentException(
                    "Semua argumen harus bertipe string."
                );
            }
        }

        // Mengambil data mahasiswa
        [$id, $name, $major] = $args;

        // Mengembalikan informasi mahasiswa
        return "ID: {$id}, Nama: {$name}, Prodi: {$major}";
    }
}

// Membuat objek
$presenter = new StudentPresenter();

// Pemanggilan yang benar
echo $presenter->showData(
    "2026001",
    "Ahmad",
    "Informatika"
);

?>