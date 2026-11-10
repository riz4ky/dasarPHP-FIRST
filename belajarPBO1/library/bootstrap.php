<?php
// Bootstrap dan konfigurasi umum praktikum PBO PHP
// Berkas ini di-require oleh setiap modul pertemuan laboratorium
// Muhamad Mulqi Adiyat Abdilah Ruswandi (2530521082) - Teknik Informatika 3C UMMI

// Data diri mahasiswa
$namaMahasiswa   = "Muhamad Mulqi Adiyat Abdilah Ruswandi";
$nimMahasiswa    = "2530521082";
$kelasMahasiswa  = "Teknik Informatika 3C";
$emailMahasiswa  = "muhamadmulqiaar@ummi.ac.id";
$dosenPengampu   = "Prajoko, M.Kom";
$programStudi    = "Teknik Informatika";
$fakultas        = "Sains dan Teknologi";
$universitas     = "Universitas Muhammadiyah Sukabumi";

// Informasi runtime PHP dan web server
$phpVersion      = phpversion();
$serverSoftware  = $_SERVER['SERVER_SOFTWARE'] ?? 'PHP CLI / Built-in Server';
$waktuAkses      = date("d F Y, H:i:s");

// Deteksi path direktori untuk penentuan tautan navigasi
$scriptName      = $_SERVER['SCRIPT_NAME'] ?? '';
$requestUri      = $_SERVER['REQUEST_URI'] ?? '';

// Periksa apakah berkas diakses dari subdirektori pertemuan
$isSubdirAccess  = (preg_match('#pertemuan-\d+#', $scriptName) === 1);

// Tentukan tautan kembali ke portal utama daftar pertemuan
$portalUrl       = $isSubdirAccess ? '../index.php' : null;

// Normalisasi URL jika diakses tanpa trailing slash agar tautan relatif tetap valid
if ($isSubdirAccess && !empty($requestUri)) {
  $uriPath = parse_url($requestUri, PHP_URL_PATH) ?? '';
  if (preg_match('#/(pertemuan-\d+)$#', $uriPath, $matches)) {
    $queryString = parse_url($requestUri, PHP_URL_QUERY);
    $redirectUrl = $uriPath . '/' . ($queryString ? '?' . $queryString : '');
    header('Location: ' . $redirectUrl);
    exit;
  }
}

/**
 * Menampilkan navigasi atas pada modul pertemuan
 * Memuat tombol kembali ke portal, breadcrumb, dan versi PHP aktif
 *
 * @param string $nomorPertemuan Contoh: "02"
 * @param string $judulModul     Contoh: "Pengenalan Tools & Sintaks Dasar PHP"
 * @return void
 */
function renderNavPertemuan(string $nomorPertemuan, string $judulModul): void
{
  global $portalUrl, $phpVersion;
?>
<nav
  class="bg-white border border-slate-200 rounded-2xl p-4 shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
  <div class="flex items-center gap-3">
    <?php if ($portalUrl): ?>
    <a href="<?php echo htmlspecialchars($portalUrl); ?>"
      class="inline-flex items-center gap-2 bg-blue-50 hover:bg-blue-100 text-blue-900 font-semibold text-xs md:text-sm px-3.5 py-2 rounded-xl transition border border-blue-200">
      Kembali ke Daftar Pertemuan
    </a>
    <?php else: ?>
    <span
      class="inline-flex items-center gap-1.5 bg-slate-100 text-slate-600 text-xs px-3 py-1.5 rounded-lg border border-slate-200">
      Standalone Mode
    </span>
    <?php endif; ?>

    <div class="flex items-center text-xs text-slate-500 gap-1.5">
      <?php if ($portalUrl): ?>
      <a href="<?php echo htmlspecialchars($portalUrl); ?>" class="hover:text-blue-800 transition">Portal PBO</a>
      <span>/</span>
      <?php endif; ?>
      <span class="font-bold text-slate-800">Pertemuan <?php echo htmlspecialchars($nomorPertemuan); ?></span>
    </div>
  </div>

  <div class="flex items-center gap-2 w-full sm:w-auto justify-between sm:justify-end">
    <span class="bg-slate-100 text-slate-700 text-xs px-2.5 py-1 rounded-md font-mono border border-slate-200">
      PHP <?php echo htmlspecialchars($phpVersion); ?>
    </span>
    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-1 rounded-md">
      Modul <?php echo htmlspecialchars($nomorPertemuan); ?>
    </span>
  </div>
</nav>
<?php
}

/**
 * Menampilkan footer identitas mahasiswa pada bagian bawah halaman
 *
 * @return void
 */
function renderFooterLaboratorium(): void
{
  global $namaMahasiswa, $nimMahasiswa, $kelasMahasiswa, $universitas;
?>
<footer class="pt-6 border-t border-slate-200 text-center text-xs text-slate-500 space-y-1">
  <p>Praktikum Pemrograman Berorientasi Objek &copy; <?php echo date('Y'); ?> -
    <?php echo htmlspecialchars($universitas); ?></p>
  <p><?php echo htmlspecialchars($namaMahasiswa); ?> (NIM: <?php echo htmlspecialchars($nimMahasiswa); ?>) -
    <?php echo htmlspecialchars($kelasMahasiswa); ?></p>
</footer>
<?php
}