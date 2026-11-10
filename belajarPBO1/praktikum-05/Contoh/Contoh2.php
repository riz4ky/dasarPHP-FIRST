<?php

declare(strict_types=1);

// Contoh 2: Private, Getter, dan Setter
// Modul Praktikum PBO Pertemuan 5: Enkapsulasi


require_once __DIR__ . '/../libs/bootstrap.php';

class MahasiswaTerenkapsulasi
{
  private int $semester;

  public function __construct(int $semester)
  {
    $this->setSemester($semester);
  }

  public function getSemester(): int
  {
    return $this->semester;
  }

  public function setSemester(int $semester): void
  {
    if ($semester < 1 || $semester > 14) {
      throw new InvalidArgumentException("Semester harus berupa angka antara 1 sampai 14.");
    }
    $this->semester = $semester;
  }
}

// Inisialisasi objek valid
$m = new MahasiswaTerenkapsulasi(3);
$nilaiAwal = $m->getSemester();

// Perubahan valid via setter
$m->setSemester(5);
$nilaiSetelahUbah = $m->getSemester();

// Percobaan perubahan tidak valid via setter
$pesanEksepsi = "";
$statusTertangkap = false;
try {
  $m->setSemester(-7);
} catch (InvalidArgumentException $e) {
  $pesanEksepsi = $e->getMessage();
  $statusTertangkap = true;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contoh 2 - Private, Getter & Setter | PBO Pertemuan 05</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-slate-50 text-slate-800 p-4 md:p-8 font-sans min-h-screen">
  <div class="max-w-4xl mx-auto space-y-6">

    <?php renderNavPertemuan("05", "Contoh 2 - Private, Getter, dan Setter"); ?>

    <!-- Hero Card -->
    <div class="bg-blue-900 text-white p-6 md:p-8 rounded-2xl shadow-md space-y-3">
      <div
        class="inline-block bg-white/20 border border-white/30 text-white px-3 py-1 rounded-full text-xs font-semibold tracking-wide">
        Percobaan 5.2 &bull; Modul Enkapsulasi
      </div>
      <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">Proteksi State dengan Setter & Getter</h1>
      <p class="text-blue-200 text-sm md:text-base leading-relaxed">
        Menerapkan visibility private pada atribut serta menyediakan getter sebagai gerbang pembacaan dan setter sebagai
        gerbang pengujian aturan bisnis sebelum nilai disimpan ke dalam memori.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
        <h2 class="text-base font-bold text-slate-900 border-l-4 border-blue-800 pl-3">Struktur Kode Terenkapsulasi</h2>
        <div
          class="bg-slate-50 p-4 rounded-xl border border-slate-200 font-mono text-xs text-slate-700 leading-relaxed overflow-x-auto">
          <pre>&lt;?php
class MahasiswaTerenkapsulasi {
    private int $semester;

    public function __construct(int $semester) {
        $this-&gt;setSemester($semester);
    }

    public function getSemester(): int {
        return $this-&gt;semester;
    }

    public function setSemester(int $semester): void {
        if ($semester &lt; 1 || $semester &gt; 14) {
            throw new InvalidArgumentException(
                "Semester harus berupa angka antara 1 sampai 14."
            );
        }
        $this-&gt;semester = $semester;
    }
}

$m = new MahasiswaTerenkapsulasi(3);
$m-&gt;setSemester(5); // Nilai berubah menjadi 5
// $m-&gt;semester = -7; // Fatal error jika dicoba langsung
// $m-&gt;setSemester(-7); // Memicu InvalidArgumentException</pre>
        </div>
      </div>

      <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
        <h2 class="text-base font-bold text-slate-900 border-l-4 border-emerald-600 pl-3">Pengujian & Hasil Eksekusi
        </h2>

        <div class="space-y-3">
          <div class="p-3 bg-blue-50 border border-blue-200 rounded-xl">
            <span class="text-xs font-semibold text-blue-900 block">Nilai Awal (Constructor):</span>
            <span class="text-base font-mono font-bold text-blue-800"><?php echo $nilaiAwal; ?></span>
          </div>

          <div class="p-3 bg-emerald-50 border border-emerald-200 rounded-xl">
            <span class="text-xs font-semibold text-emerald-900 block">Setelah $m-&gt;setSemester(5):</span>
            <span class="text-base font-mono font-bold text-emerald-800"><?php echo $nilaiSetelahUbah; ?> (Berhasil
              Diperbarui)</span>
          </div>

          <div class="p-3 bg-rose-50 border border-rose-200 rounded-xl">
            <span class="text-xs font-semibold text-rose-900 block">Uji Input Ilegal $m-&gt;setSemester(-7):</span>
            <span class="text-xs font-mono text-rose-700 block mt-1">
              <?php if ($statusTertangkap): ?>
                Status: <strong>Ditolak Sistem</strong><br>
                Eksepsi: <em><?php echo htmlspecialchars($pesanEksepsi); ?></em><br>
                Nilai Tetap Terlindungi: <strong><?php echo $m->getSemester(); ?></strong>
              <?php endif; ?>
            </span>
          </div>
        </div>

        <div class="p-4 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-600 leading-relaxed">
          <strong>Poin Inti:</strong> Nilai state objek tetap bernilai 5 karena setter menolak masukan -7 dan
          melemparkan eksepsi, sehingga objek terlindung dari kerusakan data.
        </div>
      </div>
    </div>

    <!-- Footer -->
    <?php renderFooterLaboratorium(); ?>
  </div>
</body>

</html>