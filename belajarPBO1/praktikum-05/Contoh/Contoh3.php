<?php

declare(strict_types=1);

// Contoh 3: Read-Only Property dari Sudut Pandang Pemakai Class
// Modul Praktikum PBO Pertemuan 5: Enkapsulasi

require_once __DIR__ . '/../libs/bootstrap.php';

class MahasiswaReadOnlyNim
{
  private string $nim;

  public function __construct(string $nim)
  {
    $nimBersih = trim($nim);
    if ($nimBersih === "") {
      throw new InvalidArgumentException("NIM wajib diisi.");
    }
    $this->nim = $nimBersih;
  }

  public function getNim(): string
  {
    return $this->nim;
  }

  // CATATAN ARSITEKTUR:
  // Tidak disediakan method setNim() agar identifier bersifat immutable (kekal)
}

$m = new MahasiswaReadOnlyNim("2530521082");
$nimTerdaftar = $m->getNim();
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contoh 3 - Read-Only Property | PBO Pertemuan 05</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-slate-50 text-slate-800 p-4 md:p-8 font-sans min-h-screen">
  <div class="max-w-4xl mx-auto space-y-6">

    <?php renderNavPertemuan("05", "Contoh 3 - Read-Only Property"); ?>

    <!-- Hero Card -->
    <div class="bg-blue-900 text-white p-6 md:p-8 rounded-2xl shadow-md space-y-3">
      <div
        class="inline-block bg-white/20 border border-white/30 text-white px-3 py-1 rounded-full text-xs font-semibold tracking-wide">
        Percobaan 5.3 &bull; Modul Enkapsulasi
      </div>
      <h1 class="text-2xl md:text-3xl font-extrabold tracking-tight">Immutability (Read-Only State)</h1>
      <p class="text-blue-200 text-sm md:text-base leading-relaxed">
        Menegaskan bahwa enkapsulasi tidak mengharuskan pembuatan pasangan getter dan setter untuk setiap properti.
        Properti pengenal unik seperti NIM dirancang tanpa setter guna mempertahankan konsistensi identitas objek.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
        <h2 class="text-base font-bold text-slate-900 border-l-4 border-blue-800 pl-3">Struktur Desain Tanpa Setter</h2>
        <div
          class="bg-slate-50 p-4 rounded-xl border border-slate-200 font-mono text-xs text-slate-700 leading-relaxed overflow-x-auto">
          <pre>&lt;?php
class MahasiswaReadOnlyNim {
    private string $nim;

    public function __construct(string $nim) {
        $nim = trim($nim);
        if ($nim === "") {
            throw new InvalidArgumentException("NIM wajib diisi");
        }
        $this-&gt;nim = $nim;
    }

    public function getNim(): string {
        return $this-&gt;nim;
    }
    // Tidak disediakan setNim()
}

$m = new MahasiswaReadOnlyNim("2530521082");
echo $m-&gt;getNim(); // 2530521082</pre>
        </div>
      </div>

      <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
        <h2 class="text-base font-bold text-slate-900 border-l-4 border-blue-800 pl-3">Analisis Arsitektural</h2>

        <div class="p-4 bg-blue-50 border border-blue-200 rounded-xl space-y-2">
          <span class="text-xs font-semibold text-blue-900 block">Identitas Mahasiswa Aktif:</span>
          <span class="text-lg font-mono font-bold text-blue-800"><?php echo htmlspecialchars($nimTerdaftar); ?></span>
          <p class="text-xs text-blue-700">
            Status Identitas: <strong>Immutable (Permanen sejak instansiasi)</strong>
          </p>
        </div>

        <div class="space-y-2 text-xs text-slate-600 leading-relaxed">
          <p>
            <strong>Manfaat Keamanan Sistem:</strong> Pada aplikasi nyata yang terhubung ke repositori atau basis data,
            NIM berfungsi sebagai <em>Primary Key</em>. Jika NIM dapat diubah sembarangan di tengah proses:
          </p>
          <ul class="list-disc pl-5 space-y-1 text-slate-700">
            <li>Kunci indeks pada array repositori ($data[$nim]) akan kehilangan relasi.</li>
            <li>Integritas riwayat akademik dan nilai mahasiswa berisiko putus (orphan record).</li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <?php renderFooterLaboratorium(); ?>
  </div>
</body>

</html>