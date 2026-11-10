<?php

declare(strict_types=1);

// Contoh 1: Masalah Ketika Property Bersifat Public
// Modul Praktikum PBO Pertemuan 5: Enkapsulasi


require_once __DIR__ . '/../libs/bootstrap.php';

// Model demonstrasi dengan properti publik
class MahasiswaPublik
{
  public function __construct(public int $semester)
  {
    if ($semester < 1 || $semester > 14) {
      throw new InvalidArgumentException("Semester tidak valid (harus 1-14).");
    }
  }
}

// Eksperimen 1: Pembentukan objek dengan nilai awal valid
$m = new MahasiswaPublik(3);
$nilaiAwal = $m->semester;

// Eksperimen 2: Pelanggaran aturan bisnis setelah inisialisasi
// Properti publik dapat ditimpa langsung dari luar class tanpa melalui validasi apapun
$m->semester = -7;
$nilaiSetelahBypass = $m->semester;
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contoh 1 - Masalah Property Public | PBO Pertemuan 05</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-slate-50 text-slate-800 p-4 md:p-8 font-sans min-h-screen">
  <div class="max-w-4xl mx-auto space-y-6">

    <?php renderNavPertemuan("05", "Contoh 1 - Masalah Property Public"); ?>

    <!-- Hero Card -->
    <div class="bg-blue-900 text-white p-6 md:p-8 rounded-2xl shadow-md space-y-3">
      <div
        class="inline-block bg-white/20 border border-white/30 text-white px-3 py-1 rounded-full text-xs font-semibold tracking-wide">
        Percobaan 5.1 &bull; Modul Enkapsulasi
      </div>
      <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">Kelemahan Property Publik</h1>
      <p class="text-blue-200 text-sm md:text-base leading-relaxed">
        Demonstrasi mengapa validasi pada konstruktor saja tidak mencukupi apabila properti tetap berstatus publik.
        Pihak luar dapat mengubah keadaan (state) objek kapan saja secara bebas.
      </p>
    </div>

    <!-- Panel Hasil Eksperimen -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
        <h2 class="text-base font-bold text-slate-900 border-l-4 border-blue-800 pl-3">Skenario Kode Program</h2>
        <div
          class="bg-slate-50 p-4 rounded-xl border border-slate-200 font-mono text-xs text-slate-700 leading-relaxed overflow-x-auto">
          <pre>&lt;?php
class MahasiswaPublik {
    public function __construct(public int $semester) {
        if ($semester &lt; 1 || $semester &gt; 14) {
            throw new InvalidArgumentException("Semester tidak valid");
        }
    }
}

$m = new MahasiswaPublik(3);
// Nilai awal: 3 (lulus validasi constructor)

$m-&gt;semester = -7; 
// Manipulasi berhasil karena properti bersifat public!
echo $m-&gt;semester; // Output: -7</pre>
        </div>
      </div>

      <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
        <h2 class="text-base font-bold text-slate-900 border-l-4 border-amber-600 pl-3">Output Eksekusi Langsung</h2>

        <div class="space-y-3">
          <div class="p-3 bg-blue-50 border border-blue-200 rounded-xl">
            <span class="text-xs font-semibold text-blue-900 block">Nilai Semester Saat Inisialisasi:</span>
            <span class="text-lg font-mono font-bold text-blue-800"><?php echo $nilaiAwal; ?> (Valid)</span>
          </div>

          <div class="p-3 bg-amber-50 border border-amber-200 rounded-xl">
            <span class="text-xs font-semibold text-amber-900 block">Nilai Semester Setelah Manipulasi Luar
              ($m-&gt;semester = -7):</span>
            <span class="text-lg font-mono font-bold text-amber-800"><?php echo $nilaiSetelahBypass; ?> (Anomali
              Bisnis)</span>
          </div>
        </div>

        <div class="p-4 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-600 leading-relaxed">
          <strong>Analisis Teknis:</strong> Walaupun konstruktor telah memeriksa bahwa semester harus berada pada
          rentang 1–14, properti publik tidak memiliki gerbang pelindung setelah instansiasi. Akibatnya, integritas
          aturan bisnis rusak karena objek dapat berada dalam keadaan korup (semester bernilai -7).
        </div>
      </div>
    </div>

    <!-- Footer -->
    <?php renderFooterLaboratorium(); ?>
  </div>
</body>

</html>