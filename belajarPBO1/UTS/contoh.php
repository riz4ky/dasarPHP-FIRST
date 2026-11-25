<?php
/**
 * Sistem Informasi Manajemen Kos Mandiri Jaya
 * Demonstrasi OOP PHP: Encapsulation, Inheritance, dan Polymorphism.
 * Catatan: versi praktikum ini menggunakan data demonstrasi dan session PHP,
 * belum melakukan koneksi/persistensi ke MySQL.
 */

declare(strict_types=1);

/**
 * Kelas induk untuk transaksi yang terjadi pada operasional kos.
 * Data umum transaksi diwariskan oleh kelas Penyewaan dan Pembayaran.
 */
abstract class TransaksiKos
{
    // protected: dapat diakses kelas turunan, tetapi tidak langsung dari luar kelas.
    protected int $idTransaksi;
    protected float $jumlah;

    // private: hanya dapat diakses melalui method di dalam kelas ini.
    private DateTimeImmutable $tanggalTransaksi;
    private string $status;
    private string $keterangan;

    public function __construct(
        int $idTransaksi,
        string $tanggalTransaksi,
        float $jumlah,
        string $status,
        string $keterangan
    ) {
        if ($idTransaksi <= 0) {
            throw new InvalidArgumentException('ID transaksi harus lebih besar dari 0.');
        }
        if ($jumlah < 0) {
            throw new InvalidArgumentException('Jumlah transaksi tidak boleh negatif.');
        }

        $this->idTransaksi = $idTransaksi;
        $this->tanggalTransaksi = new DateTimeImmutable($tanggalTransaksi);
        $this->jumlah = $jumlah;
        $this->setStatus($status);
        $this->setKeterangan($keterangan);
    }

    // Getter dan setter menjadi jalur akses terkontrol terhadap atribut private/protected.
    public function getIdTransaksi(): int
    {
        return $this->idTransaksi;
    }

    public function getTanggalTransaksi(): DateTimeImmutable
    {
        return $this->tanggalTransaksi;
    }

    public function getJumlah(): float
    {
        return $this->jumlah;
    }

    public function setJumlah(float $jumlah): void
    {
        if ($jumlah < 0) {
            throw new InvalidArgumentException('Jumlah transaksi tidak boleh negatif.');
        }
        $this->jumlah = $jumlah;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $status = trim($status);
        if ($status === '') {
            throw new InvalidArgumentException('Status transaksi wajib diisi.');
        }
        $this->status = $status;
    }

    public function getKeterangan(): string
    {
        return $this->keterangan;
    }

    public function setKeterangan(string $keterangan): void
    {
        $this->keterangan = trim($keterangan);
    }

    public function formatJumlah(): string
    {
        return 'Rp ' . number_format($this->jumlah, 0, ',', '.');
    }

    // Method abstrak wajib diimplementasikan oleh setiap kelas turunan.
    abstract public function getJenisTransaksi(): string;
}

/**
 * Kelas turunan pertama: merepresentasikan transaksi penyewaan kamar.
 * Satu objek Penyewaan menghubungkan satu penyewa dengan satu kamar pada periode tertentu.
 */
class Penyewaan extends TransaksiKos
{
    // Atribut spesifik penyewaan yang tidak dimiliki transaksi pembayaran.
    private int $idKamar;
    private int $idPenyewa;
    private string $nomorKamar;
    private string $tipeKamar;
    private string $namaPenyewa;
    private float $hargaBulanan;
    private DateTimeImmutable $tanggalSelesai;
    private ?DateTimeImmutable $tanggalCheckin;

    public function __construct(
        int $idPenyewaan,
        int $idKamar,
        int $idPenyewa,
        string $nomorKamar,
        string $tipeKamar,
        string $namaPenyewa,
        float $hargaBulanan,
        string $tanggalMulai,
        string $tanggalSelesai,
        ?string $tanggalCheckin,
        string $statusPenyewaan
    ) {
        if ($idKamar <= 0 || $idPenyewa <= 0) {
            throw new InvalidArgumentException('ID kamar dan ID penyewa harus valid.');
        }
        if ($hargaBulanan < 0) {
            throw new InvalidArgumentException('Harga bulanan tidak boleh negatif.');
        }

        $mulai = new DateTimeImmutable($tanggalMulai);
        $selesai = new DateTimeImmutable($tanggalSelesai);
        $checkin = $tanggalCheckin !== null ? new DateTimeImmutable($tanggalCheckin) : null;

        if ($selesai <= $mulai) {
            throw new InvalidArgumentException('Tanggal selesai harus setelah tanggal mulai.');
        }
        if ($checkin !== null && ($checkin < $mulai || $checkin > $selesai)) {
            throw new InvalidArgumentException('Tanggal check-in harus berada dalam periode sewa.');
        }

        // Data umum (ID, tanggal mulai, tarif, status, dan keterangan) dikirim ke konstruktor induk.
        parent::__construct(
            $idPenyewaan,
            $tanggalMulai,
            $hargaBulanan,
            $statusPenyewaan,
            'Penyewaan kamar ' . $nomorKamar . ' oleh ' . $namaPenyewa
        );

        $this->idKamar = $idKamar;
        $this->idPenyewa = $idPenyewa;
        $this->nomorKamar = $nomorKamar;
        $this->tipeKamar = $tipeKamar;
        $this->namaPenyewa = $namaPenyewa;
        $this->hargaBulanan = $hargaBulanan;
        $this->tanggalSelesai = $selesai;
        $this->tanggalCheckin = $checkin;
    }

    public function getJenisTransaksi(): string
    {
        return 'Penyewaan';
    }

    public function getIdPenyewaan(): int
    {
        return $this->idTransaksi; // Mengakses atribut protected yang diwarisi dari parent.
    }

    public function getIdKamar(): int
    {
        return $this->idKamar;
    }

    public function getIdPenyewa(): int
    {
        return $this->idPenyewa;
    }

    public function getNomorKamar(): string
    {
        return $this->nomorKamar;
    }

    public function getTipeKamar(): string
    {
        return $this->tipeKamar;
    }

    public function getNamaPenyewa(): string
    {
        return $this->namaPenyewa;
    }

    public function getHargaBulanan(): float
    {
        return $this->hargaBulanan;
    }

    public function getTanggalMulai(): DateTimeImmutable
    {
        return $this->getTanggalTransaksi();
    }

    public function getTanggalSelesai(): DateTimeImmutable
    {
        return $this->tanggalSelesai;
    }

    public function getTanggalCheckin(): ?DateTimeImmutable
    {
        return $this->tanggalCheckin;
    }

    public function getStatusPenyewaan(): string
    {
        return $this->getStatus();
    }

    public function ubahStatusPenyewaan(string $status): void
    {
        $this->setStatus($status);
    }

    /** Menghitung jumlah bulan sewa; sisa hari dihitung sebagai satu bulan berjalan. */
    public function hitungDurasiBulan(): int
    {
        $interval = $this->getTanggalMulai()->diff($this->tanggalSelesai);
        $bulan = ($interval->y * 12) + $interval->m;
        if ($interval->d > 0) {
            $bulan++;
        }
        return max(1, $bulan);
    }

    public function validasiPeriode(): bool
    {
        return $this->tanggalSelesai > $this->getTanggalMulai();
    }

    public function ringkasanPenyewaan(): string
    {
        return sprintf(
            'Penyewaan #%d | Kamar %s (%s) | Penyewa: %s | %d bulan | %s/bulan | Status: %s',
            $this->getIdPenyewaan(),
            $this->nomorKamar,
            $this->tipeKamar,
            $this->namaPenyewa,
            $this->hitungDurasiBulan(),
            $this->formatJumlah(),
            $this->getStatusPenyewaan()
        );
    }
}

/**
 * Kelas turunan kedua: merepresentasikan pembayaran atas suatu penyewaan.
 * Satu penyewaan dapat memiliki beberapa catatan pembayaran.
 */
class Pembayaran extends TransaksiKos
{
    // Atribut khusus pembayaran.
    private int $idPenyewaan;
    private string $periodeBulan;
    private string $metodePembayaran;
    private string $namaPenyewa;
    private string $nomorKamar;

    public function __construct(
        int $idPembayaran,
        int $idPenyewaan,
        string $tanggalPembayaran,
        string $periodeBulan,
        float $jumlahPembayaran,
        string $metodePembayaran,
        string $statusPembayaran,
        string $namaPenyewa,
        string $nomorKamar
    ) {
        if ($idPenyewaan <= 0) {
            throw new InvalidArgumentException('ID penyewaan harus valid.');
        }
        if (!preg_match('/^\d{4}-(0[1-9]|1[0-2])$/', $periodeBulan)) {
            throw new InvalidArgumentException('Periode pembayaran harus berformat YYYY-MM.');
        }

        // Atribut umum pembayaran juga disimpan pada kelas induk TransaksiKos.
        parent::__construct(
            $idPembayaran,
            $tanggalPembayaran,
            $jumlahPembayaran,
            $statusPembayaran,
            'Pembayaran sewa kamar ' . $nomorKamar . ' oleh ' . $namaPenyewa
        );

        $this->idPenyewaan = $idPenyewaan;
        $this->periodeBulan = $periodeBulan;
        $this->metodePembayaran = trim($metodePembayaran);
        $this->namaPenyewa = trim($namaPenyewa);
        $this->nomorKamar = trim($nomorKamar);
    }

    public function getJenisTransaksi(): string
    {
        return 'Pembayaran';
    }

    public function getIdPembayaran(): int
    {
        return $this->idTransaksi;
    }

    public function getIdPenyewaan(): int
    {
        return $this->idPenyewaan;
    }

    public function getPeriodeBulan(): string
    {
        return $this->periodeBulan;
    }

    public function getMetodePembayaran(): string
    {
        return $this->metodePembayaran;
    }

    public function setMetodePembayaran(string $metode): void
    {
        $metode = trim($metode);
        if ($metode === '') {
            throw new InvalidArgumentException('Metode pembayaran wajib diisi.');
        }
        $this->metodePembayaran = $metode;
    }

    public function getNamaPenyewa(): string
    {
        return $this->namaPenyewa;
    }

    public function getNomorKamar(): string
    {
        return $this->nomorKamar;
    }

    public function getTanggalPembayaran(): DateTimeImmutable
    {
        return $this->getTanggalTransaksi();
    }

    public function getStatusPembayaran(): string
    {
        return $this->getStatus();
    }

    public function tandaiLunas(): void
    {
        $this->setStatus('Lunas');
    }

    public function tandaiMenunggu(): void
    {
        $this->setStatus('Menunggu');
    }

    public function isLunas(): bool
    {
        return strtolower($this->getStatusPembayaran()) === 'lunas';
    }

    public function ringkasanPembayaran(): string
    {
        return sprintf(
            'Pembayaran #%d | Penyewaan #%d | %s | %s | %s | %s',
            $this->getIdPembayaran(),
            $this->idPenyewaan,
            $this->periodeBulan,
            $this->formatJumlah(),
            $this->metodePembayaran,
            $this->getStatusPembayaran()
        );
    }
}

/** Mengubah tanggal menjadi format Indonesia tanpa bergantung pada locale server. */
function tanggalIndonesia(DateTimeImmutable $tanggal): string
{
    $bulan = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    return $tanggal->format('d') . ' ' . $bulan[(int) $tanggal->format('n')] . ' ' . $tanggal->format('Y');
}

/** Mengamankan teks sebelum ditampilkan ke HTML. */
function e(string|int|float|null $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

// -----------------------------------------------------------------------------
// MAIN PROGRAM: session, objek, dan demonstrasi pemanggilan method kelas turunan.
// -----------------------------------------------------------------------------
session_start();

// Token sederhana untuk melindungi form POST dari request lintas situs.
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Tombol "Tandai Lunas" mengubah status demo dan menyimpannya pada session.
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $tokenForm = (string) ($_POST['csrf_token'] ?? '');
    if (!hash_equals($_SESSION['csrf_token'], $tokenForm)) {
        http_response_code(403);
        exit('Permintaan tidak valid. Silakan muat ulang halaman.');
    }

    if (($_POST['aksi'] ?? '') === 'tandai_lunas' && (int) ($_POST['id_pembayaran'] ?? 0) === 502) {
        $_SESSION['status_pembayaran_demo_502'] = 'Lunas';
        $_SESSION['flash_message'] = 'Pembayaran #502 berhasil ditandai lunas pada sesi demo.';
        header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?') . '#pembayaran');
        exit;
    }
}

$statusPembayaranDemo = $_SESSION['status_pembayaran_demo_502'] ?? 'Menunggu';

// Dua objek Penyewaan dibuat dari kelas anak yang sama.
$penyewaan1 = new Penyewaan(
    301, 11, 201, 'A-01', 'Standard', 'Andi Pratama', 850000,
    '2026-11-01', '2027-01-01', '2026-11-01', 'Aktif'
);
$penyewaan2 = new Penyewaan(
    302, 12, 202, 'A-02', 'Deluxe', 'Siti Rahma', 1100000,
    '2026-10-15', '2027-01-15', '2026-10-15', 'Aktif'
);

// Dua objek Pembayaran dibuat dari kelas anak kedua.
$pembayaran1 = new Pembayaran(
    501, 301, '2026-11-02', '2026-11', 850000,
    'Transfer Bank', 'Lunas', 'Andi Pratama', 'A-01'
);
$pembayaran2 = new Pembayaran(
    502, 302, '2026-11-05', '2026-11', 1100000,
    'QRIS', $statusPembayaranDemo, 'Siti Rahma', 'A-02'
);

// Data kamar berikut adalah data contoh untuk keperluan demonstrasi tampilan.
$daftarKamar = [
    ['nomor' => 'A-01', 'tipe' => 'Standard', 'harga' => 850000, 'status' => 'Terisi'],
    ['nomor' => 'A-02', 'tipe' => 'Deluxe', 'harga' => 1100000, 'status' => 'Terisi'],
    ['nomor' => 'B-01', 'tipe' => 'Standard', 'harga' => 800000, 'status' => 'Tersedia'],
    ['nomor' => 'B-02', 'tipe' => 'Standard', 'harga' => 800000, 'status' => 'Dalam Perbaikan'],
];
$daftarPenyewaan = [$penyewaan1, $penyewaan2];
$daftarPembayaran = [$pembayaran1, $pembayaran2];

$totalKamar = count($daftarKamar);
$totalTerisi = count(array_filter($daftarKamar, fn ($kamar) => $kamar['status'] === 'Terisi'));
$totalTersedia = count(array_filter($daftarKamar, fn ($kamar) => $kamar['status'] === 'Tersedia'));
$totalPerbaikan = count(array_filter($daftarKamar, fn ($kamar) => $kamar['status'] === 'Dalam Perbaikan'));
$totalLunas = array_sum(array_map(fn (Pembayaran $p) => $p->isLunas() ? $p->getJumlah() : 0, $daftarPembayaran));
$totalMenunggu = array_sum(array_map(fn (Pembayaran $p) => !$p->isLunas() ? $p->getJumlah() : 0, $daftarPembayaran));
$flashMessage = $_SESSION['flash_message'] ?? null;
unset($_SESSION['flash_message']);

// Mode CLI menampilkan simulasi output agar pemanggilan method mudah diuji dari terminal.
if (PHP_SAPI === 'cli') {
    echo "=== SISTEM MANAJEMEN KOS MANDIRI JAYA (DEMO OOP) ===\n";
    echo "Pemilik: Pak Yana | Properti: Kos Mandiri Jaya\n\n";
    echo "-- DATA PENYEWAAN --\n";
    echo $penyewaan1->ringkasanPenyewaan() . "\n";
    echo $penyewaan2->ringkasanPenyewaan() . "\n";
    echo "Validasi periode sewa #301: " . ($penyewaan1->validasiPeriode() ? 'Valid' : 'Tidak valid') . "\n";
    echo "-- DATA PEMBAYARAN --\n";
    echo $pembayaran1->ringkasanPembayaran() . "\n";
    echo $pembayaran2->ringkasanPembayaran() . "\n";
    echo "Jumlah pembayaran lunas: Rp " . number_format($totalLunas, 0, ',', '.') . "\n";
    echo "Jumlah pembayaran menunggu: Rp " . number_format($totalMenunggu, 0, ',', '.') . "\n";
    exit;
}
?>
<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#102a26">
  <title>Kos Mandiri Jaya | Dashboard Manajemen</title>

  <!-- Tailwind CSS untuk utility layout dan Bootstrap untuk komponen/tabel/form. -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          forest: {
            950: '#102a26',
            900: '#173b34',
            800: '#205247',
            700: '#2d6a59'
          },
          sand: {
            50: '#fbf8f1',
            100: '#f4eddf',
            200: '#e8dcc5'
          },
          brass: '#c49a54'
        },
        boxShadow: {
          soft: '0 18px 50px rgba(16, 42, 38, .08)'
        }
      }
    }
  };
  </script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap"
    rel="stylesheet">
  <style>
  :root {
    --forest: #173b34;
    --forest-dark: #102a26;
    --sand: #fbf8f1;
    --brass: #c49a54;
  }

  * {
    scroll-behavior: smooth;
  }

  body {
    font-family: 'DM Sans', sans-serif;
    background: #f7f8f6;
    color: #26332f;
  }

  h1,
  h2,
  h3,
  .brand-serif {
    font-family: 'Playfair Display', serif;
  }

  .navbar-kos {
    background: rgba(16, 42, 38, .96);
    backdrop-filter: blur(14px);
  }

  .hero-panel {
    background: radial-gradient(circle at 82% 12%, rgba(196, 154, 84, .25), transparent 28%), linear-gradient(125deg, #102a26 0%, #173b34 58%, #245a4b 100%);
  }

  .hero-orb {
    position: absolute;
    width: 340px;
    height: 340px;
    right: 5%;
    top: 12%;
    border: 1px solid rgba(255, 255, 255, .12);
    border-radius: 50%;
    box-shadow: 0 0 0 35px rgba(255, 255, 255, .025), 0 0 0 75px rgba(255, 255, 255, .018);
    pointer-events: none;
  }

  .stat-card,
  .panel-card {
    border: 1px solid #e9ede9;
    border-radius: 20px;
    background: #fff;
    box-shadow: 0 12px 38px rgba(27, 48, 41, .045);
  }

  .stat-icon {
    width: 44px;
    height: 44px;
    border-radius: 14px;
    display: grid;
    place-items: center;
    background: #edf5f0;
    color: #245a4b;
    font-size: 1.2rem;
  }

  .section-kicker {
    color: #9b773b;
    letter-spacing: .16em;
    text-transform: uppercase;
    font-size: .72rem;
    font-weight: 700;
  }

  .btn-brass {
    background: var(--brass);
    border-color: var(--brass);
    color: #172d27;
    font-weight: 700;
  }

  .btn-brass:hover {
    background: #d2ad70;
    border-color: #d2ad70;
    color: #172d27;
  }

  .btn-outline-light:hover {
    color: var(--forest-dark);
  }

  .table thead th {
    color: #728078;
    background: #f7f9f7;
    border-bottom: 1px solid #e8eee9;
    font-size: .72rem;
    text-transform: uppercase;
    letter-spacing: .07em;
    font-weight: 700;
    white-space: nowrap;
  }

  .table tbody td {
    padding-top: 1rem;
    padding-bottom: 1rem;
    border-color: #eff2ef;
    vertical-align: middle;
  }

  .badge-status {
    border-radius: 999px;
    padding: .45rem .7rem;
    font-weight: 600;
    font-size: .72rem;
  }

  .status-terisi,
  .status-lunas,
  .status-aktif {
    color: #176044;
    background: #e5f4eb;
  }

  .status-tersedia {
    color: #2457a6;
    background: #eaf1ff;
  }

  .status-perbaikan,
  .status-menunggu {
    color: #966117;
    background: #fff3dc;
  }

  .nav-link-kos {
    color: rgba(255, 255, 255, .72);
    text-decoration: none;
    font-size: .9rem;
  }

  .nav-link-kos:hover {
    color: #fff;
  }

  .form-control:focus {
    border-color: #9bb8a8;
    box-shadow: 0 0 0 .2rem rgba(45, 106, 89, .12);
  }

  .footer-line {
    border-top: 1px solid #e7ece8;
  }

  @media print {

    .navbar-kos,
    .no-print,
    .hero-actions,
    form {
      display: none !important;
    }

    body {
      background: #fff;
    }

    .stat-card,
    .panel-card {
      box-shadow: none;
    }
  }
  </style>
</head>

<body>

  <!-- Navigasi utama -->
  <nav class="navbar-kos sticky-top z-50">
    <div class="container-xl py-3 d-flex align-items-center justify-content-between gap-3">
      <a href="#beranda" class="d-flex align-items-center gap-3 text-decoration-none">
        <span class="rounded-3 d-grid place-items-center text-forest-950"
          style="width:42px;height:42px;background:#d7bd8e;display:grid;place-items:center"><i
            class="bi bi-house-heart-fill fs-5"></i></span>
        <span class="text-white lh-sm">
          <span class="d-block fw-bold">Mandiri Jaya</span>
          <span class="d-block text-white-50" style="font-size:.68rem;letter-spacing:.11em">KOS MANAGEMENT</span>
        </span>
      </a>
      <div class="d-none d-lg-flex align-items-center gap-4">
        <a class="nav-link-kos" href="#ringkasan">Ringkasan</a>
        <a class="nav-link-kos" href="#kamar">Data Kamar</a>
        <a class="nav-link-kos" href="#penyewaan">Penyewaan</a>
        <a class="nav-link-kos" href="#pembayaran">Pembayaran</a>
      </div>
      <a href="#ringkasan" class="btn btn-brass btn-sm rounded-pill px-3">Buka Dashboard <i
          class="bi bi-arrow-up-right ms-1"></i></a>
    </div>
  </nav>

  <!-- Hero / landing page -->
  <header id="beranda" class="hero-panel text-white position-relative overflow-hidden">
    <div class="hero-orb"></div>
    <div class="container-xl position-relative py-5 py-lg-6" style="z-index:1">
      <div class="row align-items-center g-5 py-lg-5">
        <div class="col-lg-7 py-3">
          <div class="d-inline-flex align-items-center gap-2 rounded-pill px-3 py-2 mb-4"
            style="background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.14)">
            <span class="rounded-circle" style="width:7px;height:7px;background:#d7bd8e"></span>
            <span class="text-white-50 small">Sistem Informasi Manajemen Kos</span>
          </div>
          <p class="section-kicker mb-3" style="color:#dfbd80">Ruang Kelola yang Lebih Tertata</p>
          <h1 class="display-4 fw-bold lh-sm mb-4">Mengelola hunian,<br><span style="color:#d7bd8e">dengan lebih
              tenang.</span></h1>
          <p class="text-white-50 fs-6 lh-lg mb-4" style="max-width:590px">Pantau kamar, data penyewa, periode sewa, dan
            pembayaran Kos Mandiri Jaya melalui satu dashboard administrasi yang rapi dan mudah digunakan.</p>
          <div class="d-flex flex-wrap gap-3 hero-actions">
            <a href="#ringkasan" class="btn btn-brass rounded-pill px-4 py-2">Lihat Ringkasan <i
                class="bi bi-arrow-down-right ms-2"></i></a>
            <a href="#kamar" class="btn btn-outline-light rounded-pill px-4 py-2">Jelajahi Data Kamar</a>
          </div>
          <div class="d-flex flex-wrap gap-4 mt-5 text-white-50 small">
            <span><i class="bi bi-shield-check me-2" style="color:#d7bd8e"></i>Data administrasi terstruktur</span>
            <span><i class="bi bi-calendar2-check me-2" style="color:#d7bd8e"></i>Riwayat masa sewa</span>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="rounded-4 p-4 p-lg-5"
            style="background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.14);backdrop-filter:blur(12px)">
            <div class="d-flex align-items-start justify-content-between mb-4">
              <div>
                <p class="text-white-50 small mb-1">Properti yang dikelola</p>
                <h2 class="h3 mb-0 text-white">Kos Mandiri Jaya</h2>
              </div>
              <span class="rounded-3 p-2" style="background:rgba(215,189,142,.16);color:#e4c991"><i
                  class="bi bi-buildings fs-4"></i></span>
            </div>
            <div class="d-flex justify-content-between py-3" style="border-top:1px solid rgba(255,255,255,.14)"><span
                class="text-white-50">Pemilik</span><strong>Pak Yana</strong></div>
            <div class="d-flex justify-content-between py-3" style="border-top:1px solid rgba(255,255,255,.14)"><span
                class="text-white-50">Total kamar demo</span><strong><?= e($totalKamar) ?> unit</strong></div>
            <div class="d-flex justify-content-between py-3" style="border-top:1px solid rgba(255,255,255,.14)"><span
                class="text-white-50">Penyewaan aktif</span><strong><?= e(count($daftarPenyewaan)) ?> transaksi</strong>
            </div>
            <div class="mt-3 p-3 rounded-3" style="background:rgba(12,28,25,.34)">
              <p class="small text-white-50 mb-1">Catatan sistem</p>
              <p class="small mb-0">Angka dan identitas penyewa di halaman ini merupakan data simulasi untuk demonstrasi
                OOP PHP.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <main class="container-xl py-5">
    <!-- Ringkasan dashboard -->
    <section id="ringkasan" class="mb-5 pt-2">
      <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-4">
        <div>
          <p class="section-kicker mb-2">Dashboard Overview</p>
          <h2 class="h2 fw-bold mb-1">Ringkasan operasional</h2>
          <p class="text-secondary mb-0">Gambaran singkat kondisi data Kos Mandiri Jaya.</p>
        </div>
        <button type="button" onclick="window.print()" class="btn btn-outline-secondary rounded-pill px-3 no-print"><i
            class="bi bi-printer me-2"></i>Cetak ringkasan</button>
      </div>
      <div class="row g-3">
        <div class="col-6 col-xl-3">
          <div class="stat-card p-4 h-100">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <p class="text-secondary small mb-2">Total Kamar</p>
                <p class="h2 fw-bold mb-0"><?= e($totalKamar) ?></p>
              </div><span class="stat-icon"><i class="bi bi-door-closed"></i></span>
            </div>
            <p class="text-secondary small mt-3 mb-0">Unit pada data demo</p>
          </div>
        </div>
        <div class="col-6 col-xl-3">
          <div class="stat-card p-4 h-100">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <p class="text-secondary small mb-2">Kamar Terisi</p>
                <p class="h2 fw-bold mb-0"><?= e($totalTerisi) ?></p>
              </div><span class="stat-icon"><i class="bi bi-house-check"></i></span>
            </div>
            <p class="text-secondary small mt-3 mb-0">Sedang ditempati</p>
          </div>
        </div>
        <div class="col-6 col-xl-3">
          <div class="stat-card p-4 h-100">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <p class="text-secondary small mb-2">Kamar Tersedia</p>
                <p class="h2 fw-bold mb-0"><?= e($totalTersedia) ?></p>
              </div><span class="stat-icon"><i class="bi bi-key"></i></span>
            </div>
            <p class="text-secondary small mt-3 mb-0">Dapat ditawarkan</p>
          </div>
        </div>
        <div class="col-6 col-xl-3">
          <div class="stat-card p-4 h-100">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <p class="text-secondary small mb-2">Dalam Perbaikan</p>
                <p class="h2 fw-bold mb-0"><?= e($totalPerbaikan) ?></p>
              </div><span class="stat-icon"><i class="bi bi-tools"></i></span>
            </div>
            <p class="text-secondary small mt-3 mb-0">Belum dapat disewakan</p>
          </div>
        </div>
      </div>
      <div class="row g-3 mt-1">
        <div class="col-lg-6">
          <div class="panel-card p-4 h-100">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                <p class="text-secondary small mb-1">Pembayaran tercatat lunas</p>
                <p class="h3 fw-bold mb-0">Rp <?= e(number_format($totalLunas, 0, ',', '.')) ?></p>
              </div><span class="stat-icon"><i class="bi bi-wallet2"></i></span>
            </div>
            <div class="progress mt-4" style="height:7px">
              <div class="progress-bar" role="progressbar"
                style="width:<?= ($totalLunas + $totalMenunggu) > 0 ? e(($totalLunas / ($totalLunas + $totalMenunggu)) * 100) : 0 ?>%;background:#2d6a59">
              </div>
            </div>
            <p class="small text-secondary mt-2 mb-0">Nilai pembayaran berstatus lunas pada data demo.</p>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="panel-card p-4 h-100">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                <p class="text-secondary small mb-1">Pembayaran menunggu</p>
                <p class="h3 fw-bold mb-0">Rp <?= e(number_format($totalMenunggu, 0, ',', '.')) ?></p>
              </div><span class="stat-icon"><i class="bi bi-hourglass-split"></i></span>
            </div>
            <div class="mt-4 d-flex align-items-center gap-2"><span class="badge-status status-menunggu">Perlu
                diperiksa</span><span class="small text-secondary">Status dapat diperbarui melalui tabel
                pembayaran.</span></div>
          </div>
        </div>
      </div>
    </section>

    <!-- Daftar kamar -->
    <section id="kamar" class="mb-5 pt-3">
      <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-4">
        <div>
          <p class="section-kicker mb-2">Inventory Kamar</p>
          <h2 class="h2 fw-bold mb-1">Data kamar kos</h2>
          <p class="text-secondary mb-0">Status mengikuti kategori tersedia, terisi, dan dalam perbaikan.</p>
        </div>
        <div class="input-group no-print" style="max-width:280px"><span
            class="input-group-text bg-white border-end-0"><i class="bi bi-search text-secondary"></i></span><input
            id="roomSearch" class="form-control border-start-0" type="search"
            placeholder="Cari nomor atau tipe kamar..."></div>
      </div>
      <div class="panel-card overflow-hidden">
        <div class="d-flex flex-wrap align-items-center justify-content-between p-3 p-md-4 gap-3">
          <div class="d-flex flex-wrap gap-2 no-print">
            <button class="btn btn-sm btn-success rounded-pill room-filter" data-filter="Semua">Semua</button>
            <button class="btn btn-sm btn-outline-secondary rounded-pill room-filter"
              data-filter="Tersedia">Tersedia</button>
            <button class="btn btn-sm btn-outline-secondary rounded-pill room-filter"
              data-filter="Terisi">Terisi</button>
            <button class="btn btn-sm btn-outline-secondary rounded-pill room-filter"
              data-filter="Dalam Perbaikan">Perbaikan</button>
          </div>
          <span class="small text-secondary">Menampilkan <?= e($totalKamar) ?> data kamar contoh</span>
        </div>
        <div class="table-responsive">
          <table class="table mb-0 align-middle" id="roomTable">
            <thead>
              <tr>
                <th class="ps-4">Nomor Kamar</th>
                <th>Tipe</th>
                <th>Harga / Bulan</th>
                <th>Status Ketersediaan</th>
                <th class="pe-4">Keterangan</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($daftarKamar as $kamar): ?>
              <tr data-status="<?= e($kamar['status']) ?>"
                data-search="<?= e(strtolower($kamar['nomor'] . ' ' . $kamar['tipe'])) ?>">
                <td class="ps-4 fw-semibold"><?= e($kamar['nomor']) ?></td>
                <td><?= e($kamar['tipe']) ?></td>
                <td>Rp <?= e(number_format($kamar['harga'], 0, ',', '.')) ?></td>
                <td><span
                    class="badge-status <?= $kamar['status'] === 'Terisi' ? 'status-terisi' : ($kamar['status'] === 'Tersedia' ? 'status-tersedia' : 'status-perbaikan') ?>"><?= e($kamar['status']) ?></span>
                </td>
                <td class="pe-4 text-secondary small">
                  <?= $kamar['status'] === 'Tersedia' ? 'Siap ditawarkan' : ($kamar['status'] === 'Terisi' ? 'Sedang ditempati' : 'Perlu penanganan') ?>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <div id="roomEmpty" class="text-center text-secondary py-4 d-none">Tidak ada kamar yang sesuai dengan pencarian.
        </div>
      </div>
    </section>

    <!-- Daftar penyewaan -->
    <section id="penyewaan" class="mb-5 pt-3">
      <div class="mb-4">
        <p class="section-kicker mb-2">Rental Records</p>
        <h2 class="h2 fw-bold mb-1">Data penyewaan</h2>
        <p class="text-secondary mb-0">Penyewaan menghubungkan satu penyewa dengan satu kamar pada periode tertentu.</p>
      </div>
      <div class="panel-card overflow-hidden">
        <div class="table-responsive">
          <table class="table mb-0 align-middle">
            <thead>
              <tr>
                <th class="ps-4">ID Sewa</th>
                <th>Penyewa</th>
                <th>Kamar</th>
                <th>Periode</th>
                <th>Durasi</th>
                <th>Tarif Bulanan</th>
                <th class="pe-4">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($daftarPenyewaan as $sewa): ?>
              <tr>
                <td class="ps-4 fw-semibold">#<?= e($sewa->getIdPenyewaan()) ?></td>
                <td>
                  <div class="fw-semibold"><?= e($sewa->getNamaPenyewa()) ?></div>
                  <div class="small text-secondary">ID Penyewa: <?= e($sewa->getIdPenyewa()) ?></div>
                </td>
                <td><?= e($sewa->getNomorKamar()) ?><div class="small text-secondary"><?= e($sewa->getTipeKamar()) ?>
                  </div>
                </td>
                <td>
                  <div><?= e(tanggalIndonesia($sewa->getTanggalMulai())) ?></div>
                  <div class="small text-secondary">s.d. <?= e(tanggalIndonesia($sewa->getTanggalSelesai())) ?></div>
                </td>
                <td><?= e($sewa->hitungDurasiBulan()) ?> bulan</td>
                <td>Rp <?= e(number_format($sewa->getHargaBulanan(), 0, ',', '.')) ?></td>
                <td class="pe-4"><span class="badge-status status-aktif"><?= e($sewa->getStatusPenyewaan()) ?></span>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- Daftar pembayaran -->
    <section id="pembayaran" class="mb-5 pt-3">
      <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-4">
        <div>
          <p class="section-kicker mb-2">Payment Monitoring</p>
          <h2 class="h2 fw-bold mb-1">Data pembayaran</h2>
          <p class="text-secondary mb-0">Satu penyewaan dapat mempunyai beberapa catatan pembayaran.</p>
        </div>
        <span class="small text-secondary">Aksi status menggunakan PHP session (simulasi).</span>
      </div>
      <div class="panel-card overflow-hidden">
        <div class="table-responsive">
          <table class="table mb-0 align-middle">
            <thead>
              <tr>
                <th class="ps-4">ID Bayar</th>
                <th>Penyewa / Kamar</th>
                <th>Periode</th>
                <th>Tanggal Bayar</th>
                <th>Metode</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th class="pe-4">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($daftarPembayaran as $bayar): ?>
              <tr>
                <td class="ps-4 fw-semibold">#<?= e($bayar->getIdPembayaran()) ?></td>
                <td>
                  <div class="fw-semibold"><?= e($bayar->getNamaPenyewa()) ?></div>
                  <div class="small text-secondary">Kamar <?= e($bayar->getNomorKamar()) ?></div>
                </td>
                <td><?= e($bayar->getPeriodeBulan()) ?></td>
                <td><?= e(tanggalIndonesia($bayar->getTanggalPembayaran())) ?></td>
                <td><?= e($bayar->getMetodePembayaran()) ?></td>
                <td class="fw-semibold">Rp <?= e(number_format($bayar->getJumlah(), 0, ',', '.')) ?></td>
                <td><span
                    class="badge-status <?= $bayar->isLunas() ? 'status-lunas' : 'status-menunggu' ?>"><?= e($bayar->getStatusPembayaran()) ?></span>
                </td>
                <td class="pe-4">
                  <?php if (!$bayar->isLunas()): ?>
                  <form method="post" class="m-0">
                    <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token']) ?>">
                    <input type="hidden" name="aksi" value="tandai_lunas">
                    <input type="hidden" name="id_pembayaran" value="<?= e($bayar->getIdPembayaran()) ?>">
                    <button type="submit" class="btn btn-sm btn-brass rounded-pill px-3">Tandai lunas</button>
                  </form>
                  <?php else: ?>
                  <span class="small text-success fw-semibold"><i class="bi bi-check-circle-fill me-1"></i>Terverifikasi
                    demo</span>
                  <?php endif; ?>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- Panel informasi konsep OOP -->
    <section class="mb-5">
      <div class="rounded-4 p-4 p-lg-5 text-white" style="background:#173b34">
        <div class="row align-items-center g-4">
          <div class="col-lg-8">
            <p class="section-kicker mb-2" style="color:#d7bd8e">Behind the Application</p>
            <h2 class="h2 mb-3">Dibangun dengan konsep OOP PHP</h2>
            <p class="text-white-50 mb-0 lh-lg">TransaksiKos menjadi kelas induk yang menyimpan data umum transaksi.
              Kelas Penyewaan dan Pembayaran mewarisi struktur tersebut, lalu menambahkan atribut serta perilaku khusus
              sesuai entitas pada rancangan basis data.</p>
          </div>
          <div class="col-lg-4">
            <div class="d-flex flex-wrap gap-2"><span class="badge rounded-pill px-3 py-2"
                style="background:#315e51">Encapsulation</span><span class="badge rounded-pill px-3 py-2"
                style="background:#315e51">Inheritance</span><span class="badge rounded-pill px-3 py-2"
                style="background:#315e51">Abstraction</span><span class="badge rounded-pill px-3 py-2"
                style="background:#315e51">Object</span></div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer class="footer-line bg-white">
    <div class="container-xl py-4 d-flex flex-wrap justify-content-between align-items-center gap-2">
      <div><strong class="text-forest-900">Kos Mandiri Jaya</strong>
        <div class="small text-secondary">Sistem demonstrasi praktikum OOP PHP</div>
      </div>
      <div class="small text-secondary">© <?= date('Y') ?> · Dibuat untuk pembelajaran pemrograman berorientasi objek
      </div>
    </div>
  </footer>

  <?php if ($flashMessage !== null): ?>
  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="statusToast" class="toast show border-0 shadow" role="status" aria-live="polite" aria-atomic="true">
      <div class="toast-body d-flex align-items-center gap-2"><i
          class="bi bi-check-circle-fill text-success fs-5"></i><?= e($flashMessage) ?></div>
    </div>
  </div>
  <?php endif; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
  // Pencarian kamar dan filter status dilakukan di sisi browser tanpa reload halaman.
  const roomSearch = document.getElementById('roomSearch');
  const roomRows = [...document.querySelectorAll('#roomTable tbody tr')];
  const filterButtons = [...document.querySelectorAll('.room-filter')];
  const roomEmpty = document.getElementById('roomEmpty');
  let activeFilter = 'Semua';

  function filterRooms() {
    const keyword = (roomSearch?.value || '').toLowerCase().trim();
    let visibleCount = 0;
    roomRows.forEach((row) => {
      const matchStatus = activeFilter === 'Semua' || row.dataset.status === activeFilter;
      const matchSearch = row.dataset.search.includes(keyword);
      const visible = matchStatus && matchSearch;
      row.classList.toggle('d-none', !visible);
      if (visible) visibleCount++;
    });
    roomEmpty?.classList.toggle('d-none', visibleCount !== 0);
  }

  roomSearch?.addEventListener('input', filterRooms);
  filterButtons.forEach((button) => {
    button.addEventListener('click', () => {
      activeFilter = button.dataset.filter;
      filterButtons.forEach((item) => {
        item.classList.remove('btn-success');
        item.classList.add('btn-outline-secondary');
      });
      button.classList.add('btn-success');
      button.classList.remove('btn-outline-secondary');
      filterRooms();
    });
  });

  // Hilangkan notifikasi setelah beberapa saat agar tidak menutupi konten.
  const toastElement = document.getElementById('statusToast');
  if (toastElement && window.bootstrap) {
    window.setTimeout(() => {
      const toast = bootstrap.Toast.getOrCreateInstance(toastElement, {
        delay: 4000
      });
      toast.hide();
    }, 2500);
  }
  </script>
</body>

</html>