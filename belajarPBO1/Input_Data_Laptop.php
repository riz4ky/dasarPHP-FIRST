<?php
class Laptop
{
    public string $namaMahasiswa;
    public string $kelas;
    public string $merk;
    public string $jenis;
    public int $tahunProduksi;
    public string $prosesor;
    public int $ram;
    public int $penyimpanan;

    public function __construct(
        string $namaMahasiswa,
        string $kelas,
        string $merk,
        string $jenis,
        int $tahunProduksi,
        string $prosesor,
        int $ram,
        int $penyimpanan
    ) {
        $this->namaMahasiswa = $namaMahasiswa;
        $this->kelas = $kelas;
        $this->merk = $merk;
        $this->jenis = $jenis;
        $this->tahunProduksi = $tahunProduksi;
        $this->prosesor = $prosesor;
        $this->ram = $ram;
        $this->penyimpanan = $penyimpanan;
    }

    public function tampilData(): string
    {
        return $this->merk . " " . $this->jenis;
    }

    public function nyalakan(): string
    {
        return "Data laptop anda tersimpan dengan aman.";
    }
}

function aman(string $teks): string
{
    return htmlspecialchars($teks, ENT_QUOTES, 'UTF-8');
}

function formatTahun(int $tahun): string
{
    return (string) $tahun;
}

// Data contoh
$laptopList = [
    new Laptop(
        "Wirayudhabuana", "TI-3A", "ADVAN", "Heritage",
        2026, "AMD Ryzen 5", 16, 512
    ),
    new Laptop(
        "Muhammad Alif", "TI-3A", "Asus", "IdeaPad Slim",
        2025, "AMD Ryzen 3", 8, 512
    )
];

$pesan = "";
$statusPesan = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = trim($_POST["namaMahasiswa"] ?? "");
    $kelas = trim($_POST["kelas"] ?? "");
    $merk = trim($_POST["merk"] ?? "");
    $jenis = trim($_POST["jenis"] ?? "");
    $prosesor = trim($_POST["prosesor"] ?? "");

    $tahun = filter_var($_POST["tahun"] ?? "", FILTER_VALIDATE_INT);
    $ram = filter_var($_POST["ram"] ?? "", FILTER_VALIDATE_INT);
    $penyimpanan = filter_var(
        $_POST["penyimpanan"] ?? "",
        FILTER_VALIDATE_INT
    );

    if (
        $nama !== "" && $kelas !== "" &&
        $merk !== "" && $jenis !== "" &&
        $prosesor !== "" &&
        $tahun !== false &&
        $tahun >= 1990 && $tahun <= (int) date("Y") &&
        $ram !== false && $ram > 0 &&
        $penyimpanan !== false && $penyimpanan > 0
    ) {
        $laptopList[] = new Laptop(
            $nama, $kelas, $merk, $jenis,
            $tahun, $prosesor, $ram, $penyimpanan
        );

        $pesan = "Data laptop berhasil ditambahkan!";
        $statusPesan = "success";
    } else {
        $pesan = "Data tidak valid. Periksa kembali formulir.";
        $statusPesan = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laptop Mahasiswa | Data Perangkat</title>
  <style>
  :root {
    --blue: #2454e8;
    --blue-dark: #173baf;
    --navy: #111a30;
    --text: #182238;
    --muted: #64748b;
    --border: #dce4ef;
    --bg: #f6f8fc;
    --orange: #cf3d08;
  }

  * {
    box-sizing: border-box;
  }

  body {
    margin: 0;
    background: var(--bg);
    color: var(--text);
    font-family: Inter, "Segoe UI", Arial, sans-serif;
    line-height: 1.6;
  }

  .container {
    width: min(1250px, calc(100% - 48px));
    margin: auto;
  }

  /* NAVBAR */
  .navbar {
    background: #fff;
    border-bottom: 1px solid #e2e8f0;
    position: relative;
  }

  .nav-inner {
    min-height: 82px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
  }

  .brand {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    color: var(--navy);
    flex-shrink: 0;
  }

  .brand-icon {
    width: 48px;
    height: 48px;
    display: grid;
    place-items: center;
    border-radius: 14px;
    background: linear-gradient(135deg, #1649ed, #008ce6);
    color: white;
    font-size: 25px;
    box-shadow: 0 4px 8px #2454e833;
  }

  .brand-name {
    font-size: 19px;
    font-weight: 900;
    line-height: 1.2;
    letter-spacing: -.5px;
  }

  .brand-sub {
    color: var(--muted);
    font-size: 10px;
    letter-spacing: .7px;
    margin-top: 4px;
  }

  .nav-links {
    display: flex;
    align-items: center;
    gap: 26px;
  }

  .nav-links a {
    color: #475569;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
  }

  .nav-links a:hover,
  .nav-links a.active {
    color: var(--blue);
  }

  .nav-button {
    padding: 11px 18px;
    border-radius: 9px;
    background: var(--orange);
    color: white;
    text-decoration: none;
    font-size: 14px;
    font-weight: 700;
    white-space: nowrap;
  }

  .nav-button:hover {
    background: #ad3206;
  }

  /* HERO */
  .hero {
    padding: 65px 0 55px;
  }

  .hero-grid {
    display: grid;
    grid-template-columns: 1.15fr .85fr;
    gap: 65px;
    align-items: center;
  }

  .badge {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    border: 1px solid #bfdbfe;
    background: #e7f0ff;
    color: var(--blue);
    border-radius: 30px;
    padding: 7px 14px;
    font-size: 13px;
    font-weight: 650;
  }

  .hero h1 {
    margin: 22px 0 18px;
    font-size: clamp(36px, 4vw, 57px);
    line-height: 1.12;
    letter-spacing: -2px;
    font-weight: 900;
  }

  .hero h1 span {
    color: var(--blue);
  }

  .hero-description {
    color: #53647f;
    font-size: 17px;
    margin-bottom: 24px;
  }

  .features {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin: 22px 0 28px;
  }

  .feature {
    background: white;
    border: 1px solid var(--border);
    border-radius: 9px;
    padding: 8px 12px;
    font-size: 12px;
    font-weight: 600;
    box-shadow: 0 2px 3px #0f172a05;
  }

  .feature span {
    color: var(--blue);
    margin-right: 5px;
  }

  .hero-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
  }

  .btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    padding: 14px 20px;
    border-radius: 9px;
    font-size: 14px;
    font-weight: 750;
    text-decoration: none;
    transition: .2s;
    cursor: pointer;
  }

  .btn-primary {
    background: var(--blue);
    color: white;
    border: 1px solid var(--blue);
    box-shadow: 0 5px 12px #2454e826;
  }

  .btn-primary:hover {
    background: var(--blue-dark);
    transform: translateY(-1px);
  }

  .btn-secondary {
    background: white;
    color: var(--navy);
    border: 1px solid #cbd5e1;
  }

  .btn-secondary:hover {
    border-color: var(--blue);
    color: var(--blue);
  }

  /* HERO CARD */
  .hero-card {
    background: linear-gradient(150deg, #172540, #080e20);
    color: white;
    border-radius: 20px;
    padding: 26px;
    min-height: 390px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-shadow: 0 24px 45px #0f172a20;
    position: relative;
    overflow: hidden;
  }

  .hero-card::before {
    content: "</>";
    position: absolute;
    top: 65px;
    right: -5px;
    font-size: 155px;
    font-weight: 900;
    color: #ffffff08;
  }

  .hero-card-top,
  .hero-card-bottom {
    position: relative;
    z-index: 1;
  }

  .mini-label {
    display: inline-block;
    background: #2454e8;
    padding: 5px 10px;
    border-radius: 6px;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .6px;
  }

  .hero-card h2 {
    color: white;
    margin: 14px 0 8px;
    font-size: 24px;
  }

  .hero-card p {
    color: #cbd5e1;
    font-size: 13px;
    margin: 5px 0;
  }

  .code-line {
    border-top: 1px solid #ffffff20;
    margin-top: 25px;
    padding-top: 18px;
    color: #7dd3fc;
    font-family: monospace;
    font-size: 12px;
  }

  /* SECTION */
  .section {
    padding: 45px 0;
  }

  .section-heading {
    margin-bottom: 26px;
  }

  .section-heading h2 {
    font-size: clamp(25px, 3vw, 34px);
    line-height: 1.2;
    letter-spacing: -.8px;
    margin: 10px 0;
  }

  .section-heading p {
    color: var(--muted);
    margin: 0;
    font-size: 15px;
  }

  .eyebrow {
    color: var(--blue);
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 1px;
    text-transform: uppercase;
  }

  /* FORM */
  .form-panel {
    background: white;
    border: 1px solid #e5eaf2;
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 8px 30px #0f172a06;
  }

  .form-title {
    display: flex;
    align-items: center;
    gap: 13px;
    margin-bottom: 25px;
  }

  .form-icon {
    width: 45px;
    height: 45px;
    border-radius: 12px;
    display: grid;
    place-items: center;
    background: #e8efff;
    color: var(--blue);
    font-size: 22px;
  }

  .form-title h3 {
    margin: 0;
    font-size: 20px;
  }

  .form-title p {
    color: var(--muted);
    font-size: 13px;
    margin: 2px 0 0;
  }

  .form-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 20px;
  }

  .field label {
    display: block;
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 7px;
  }

  .field input {
    width: 100%;
    min-height: 46px;
    border: 1px solid #d6deea;
    border-radius: 8px;
    padding: 11px 13px;
    font-size: 14px;
    color: var(--text);
    background: #fff;
    outline: none;
    transition: .2s;
  }

  .field input::placeholder {
    color: #9aa6b8;
  }

  .field input:focus {
    border-color: var(--blue);
    box-shadow: 0 0 0 3px #2454e817;
  }

  .form-footer {
    border-top: 1px solid #edf0f5;
    margin-top: 25px;
    padding-top: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
  }

  .form-note {
    color: var(--muted);
    font-size: 12px;
  }

  /* MESSAGE */
  .alert {
    padding: 13px 16px;
    border-radius: 9px;
    margin-bottom: 20px;
    font-size: 14px;
    font-weight: 600;
  }

  .success {
    background: #dcfce7;
    color: #166534;
  }

  .error {
    background: #fee2e2;
    color: #991b1b;
  }

  /* LAPTOP LIST */
  .list-top {
    display: flex;
    align-items: end;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 24px;
  }

  .count {
    background: #e7efff;
    color: var(--blue);
    padding: 8px 13px;
    border-radius: 9px;
    font-size: 13px;
    font-weight: 800;
    white-space: nowrap;
  }

  .laptop-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 22px;
  }

  .laptop-card {
    background: white;
    border: 1px solid #e0e7f0;
    border-radius: 15px;
    padding: 23px;
    box-shadow: 0 5px 20px #0f172a05;
    transition: .2s;
    min-width: 0;
  }

  .laptop-card:hover {
    border-color: #b9ccff;
    box-shadow: 0 10px 25px #2454e80c;
    transform: translateY(-2px);
  }

  .laptop-head {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    margin-bottom: 20px;
  }

  .laptop-icon {
    flex-shrink: 0;
    width: 51px;
    height: 51px;
    border-radius: 13px;
    background: #eaf0ff;
    display: grid;
    place-items: center;
    color: var(--blue);
    font-size: 25px;
  }

  .laptop-head h3 {
    font-size: 18px;
    line-height: 1.35;
    margin: 2px 0 5px;
    overflow-wrap: anywhere;
  }

  .laptop-head p {
    color: var(--muted);
    font-size: 12px;
    margin: 0;
  }

  .student-info {
    background: #f5f8ff;
    border: 1px solid #e4ebff;
    border-radius: 10px;
    padding: 13px;
    margin-bottom: 18px;
  }

  .info-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
    padding: 5px 0;
    font-size: 13px;
  }

  .info-row span {
    color: var(--muted);
  }

  .info-row strong {
    text-align: right;
    overflow-wrap: anywhere;
  }

  .specs {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 11px;
  }

  .spec {
    background: #f8fafc;
    border: 1px solid #edf0f5;
    border-radius: 9px;
    padding: 12px;
    min-width: 0;
  }

  .spec span {
    display: block;
    color: var(--muted);
    font-size: 11px;
    margin-bottom: 4px;
  }

  .spec strong {
    display: block;
    font-size: 13px;
    overflow-wrap: anywhere;
  }

  .status {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 18px;
    padding: 11px 12px;
    background: #ecfdf5;
    border-radius: 8px;
    color: #047857;
    font-size: 12px;
    font-weight: 650;
  }

  .status-dot {
    width: 8px;
    height: 8px;
    background: #10b981;
    border-radius: 50%;
    flex-shrink: 0;
  }

  .empty {
    padding: 25px;
    border: 1px dashed #cbd5e1;
    border-radius: 12px;
    color: var(--muted);
    text-align: center;
  }

  footer {
    margin-top: 35px;
    border-top: 1px solid #e2e8f0;
    background: white;
    padding: 25px 0;
    color: var(--muted);
    font-size: 12px;
  }

  .footer-inner {
    display: flex;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: wrap;
  }

  footer p {
    margin: 0;
  }

  @media (max-width: 950px) {
    .nav-inner {
      flex-wrap: wrap;
      padding: 15px 0;
    }

    .nav-links {
      order: 3;
      width: 100%;
      justify-content: center;
      gap: 20px;
      flex-wrap: wrap;
    }

    .hero-grid {
      grid-template-columns: 1fr;
      gap: 30px;
    }

    .hero-card {
      min-height: 300px;
    }
  }

  @media (max-width: 600px) {
    .container {
      width: calc(100% - 30px);
    }

    .nav-button {
      font-size: 12px;
      padding: 10px 12px;
    }

    .brand-name {
      font-size: 16px;
    }

    .brand-sub {
      font-size: 8px;
    }

    .nav-links {
      gap: 12px;
    }

    .nav-links a {
      font-size: 12px;
    }

    .hero {
      padding: 40px 0;
    }

    .hero h1 {
      letter-spacing: -1.2px;
    }

    .hero-description {
      font-size: 15px;
    }

    .hero-actions .btn {
      width: 100%;
    }

    .form-panel {
      padding: 19px;
    }

    .form-grid,
    .laptop-grid {
      grid-template-columns: 1fr;
    }

    .list-top {
      align-items: flex-start;
    }

    .section {
      padding: 30px 0;
    }

    .hero-card {
      padding: 22px;
    }
  }
  </style>
</head>

<body>
  <!-- NAVBAR -->
  <header class="navbar">
    <div class="container nav-inner">
      <a class="brand" href="#beranda">
        <div class="brand-icon">⌘</div>
        <div>
          <div class="brand-name">LAPTOP ANAK ANAK TI</div>
          <div class="brand-sub">DATA & SPESIFIKASI PERANGKAT LAPTOP</div>
        </div>
      </a>

      <nav class="nav-links">
        <a href="#beranda" class="active">Beranda</a>
        <a href="#input">Input Data</a>
        <a href="#daftar">Daftar Laptop</a>
        <a href="#tentang">Tentang</a>
      </nav>
      <a href="#input" class="nav-button">+ Tambah Data</a>
    </div>
  </header>

  <!-- HERO -->
  <section class="hero" id="beranda">
    <div class="container hero-grid">
      <div>
        <div class="badge">
          <span>✦</span>
          Pendataan Laptop Bisa dilakukan dengan mudah
        </div>
        <h1>
          Kelola Data Laptop
          <span>Anda dengan Aman!</span>
        </h1>

        <p class="hero-description">
          Platform sederhana untuk mendata identitas mahasiswa
          dan spesifikasi laptop yang digunakan untuk kegiatan
          belajar, pemrograman, dan perkuliahan.
        </p>

        <div class="features">
          <div class="feature"><span>✓</span> Input Data Mudah</div>
          <div class="feature"><span>✓</span> Spesifikasi Laptop Lengkap</div>
          <div class="feature"><span>✓</span> Data disimpan dengan aman</div>
        </div>

        <div class="hero-actions">
          <a href="#input" class="btn btn-primary">
            Input Laptop Sekarang <span>→</span>
          </a>

          <a href="#daftar" class="btn btn-secondary">
            ▤ Lihat Daftar Laptop
          </a>
        </div>
      </div>

      <div class="hero-card">
        <div class="hero-card-top">
          <span class="mini-label">SISTEM PENDATAAN</span>
          <h2>Semua Data Laptop<br>Dalam Satu Tempat.</h2>
          <p>
            Melalui website ini, Pendataan nama mahasiswa, kelas, dan spesifikasi
            perangkat secara terstruktur.
          </p>
        </div>

        <div class="hero-card-bottom">
          <div class="code-line">
            class Laptop {<br>
            &nbsp;&nbsp;public function tampilData() { ... }<br>
            &nbsp;&nbsp;public function nyalakan() { ... }<br>
            }
          </div>
          <p>● Sistem sederhana untuk mahasiswa</p>
        </div>
      </div>

    </div>
  </section>

  <!-- FORM INPUT -->
  <section class="section" id="input">
    <div class="container">
      <div class="section-heading">
        <span class="eyebrow">Formulir Pendataan</span>
        <h2>Tambahkan Data Laptop Anda</h2>
        <p>Lengkapi informasi mahasiswa dan perangkat yang digunakan.</p>
      </div>
      <div class="form-panel">
        <div class="form-title">
          <div class="form-icon">▣</div>
          <div>
            <h3>Informasi Mahasiswa & Laptop</h3>
            <p>Kolom bertanda wajib harus diisi.</p>
          </div>
        </div>

        <?php if ($pesan !== ""): ?>
        <div class="alert <?= aman($statusPesan) ?>">
          <?= aman($pesan) ?>
        </div>
        <?php endif; ?>

        <form method="POST" action="#daftar">
          <div class="form-grid">
            <div class="field">
              <label for="namaMahasiswa">Nama Mahasiswa *</label>
              <input type="text" id="namaMahasiswa" name="namaMahasiswa" placeholder="Contoh: Rizky Pratama"
                maxlength="100" required>
            </div>
            <div class="field">
              <label for="kelas">Kelas *</label>
              <input type="text" id="kelas" name="kelas" placeholder="Contoh: TI-2A" maxlength="50" required>
            </div>
            <div class="field">
              <label for="merk">Merek Laptop *</label>
              <input type="text" id="merk" name="merk" placeholder="Contoh: ASUS" maxlength="100" required>
            </div>
            <div class="field">
              <label for="jenis">Jenis / Model Laptop *</label>
              <input type="text" id="jenis" name="jenis" placeholder="Contoh: Vivobook" maxlength="100" required>
            </div>
            <div class="field">
              <label for="tahun">Tahun Produksi *</label>
              <input type="number" id="tahun" name="tahun" min="1990" max="<?= date('Y') ?>" placeholder="Contoh: 2023"
                required>
            </div>
            <div class="field">
              <label for="prosesor">Spesifikasi Prosesor *</label>
              <input type="text" id="prosesor" name="prosesor" placeholder="Contoh: AMD Ryzen 5" maxlength="100"
                required>
            </div>
            <div class="field">
              <label for="ram">RAM (GB) *</label>
              <input type="number" id="ram" name="ram" min="1" placeholder="Contoh: 8" required>
            </div>
            <div class="field">
              <label for="penyimpanan">Penyimpanan (GB) *</label>
              <input type="number" id="penyimpanan" name="penyimpanan" min="1" placeholder="Contoh: 512" required>
            </div>
          </div>

          <div class="form-footer">
            <span class="form-note">
              * Pastikan informasi yang dimasukkan benar.
            </span>
            <button type="submit" class="btn btn-primary">
              + Simpan Data Laptop
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>

  <!-- DAFTAR LAPTOP -->
  <section class="section" id="daftar">
    <div class="container">
      <div class="list-top">
        <div class="section-heading" style="margin-bottom:0">
          <span class="eyebrow">Data Perangkat</span>
          <h2>Daftar Laptop Mahasiswa</h2>
          <p>Informasi identitas dan spesifikasi setiap laptop.</p>
        </div>

        <div class="count">
          <?= count($laptopList) ?> Laptop
        </div>
      </div>

      <?php if (count($laptopList) > 0): ?>
      <div class="laptop-grid">
        <?php foreach ($laptopList as $index => $laptop): ?>
        <article class="laptop-card">
          <div class="laptop-head">
            <div class="laptop-icon">▣</div>
            <div>
              <h3>
                <?= aman($laptop->tampilData()) ?>
              </h3>
              <p>
                Laptop #<?= $index + 1 ?>
                · Produksi
                <?= aman(formatTahun($laptop->tahunProduksi)) ?>
              </p>
            </div>
          </div>

          <div class="student-info">
            <div class="info-row">
              <span>Nama mahasiswa</span>
              <strong>
                <?= aman($laptop->namaMahasiswa) ?>
              </strong>
            </div>

            <div class="info-row">
              <span>Kelas</span>
              <strong><?= aman($laptop->kelas) ?></strong>
            </div>
          </div>

          <div class="specs">
            <div class="spec">
              <span>MEREK</span>
              <strong><?= aman($laptop->merk) ?></strong>
            </div>

            <div class="spec">
              <span>JENIS LAPTOP</span>
              <strong><?= aman($laptop->jenis) ?></strong>
            </div>

            <div class="spec">
              <span>PROSESOR</span>
              <strong><?= aman($laptop->prosesor) ?></strong>
            </div>

            <div class="spec">
              <span>RAM</span>
              <strong><?= $laptop->ram ?> GB</strong>
            </div>

            <div class="spec">
              <span>PENYIMPANAN</span>
              <strong><?= $laptop->penyimpanan ?> GB</strong>
            </div>

            <div class="spec">
              <span>TAHUN PRODUKSI</span>
              <strong>
                <?= aman(formatTahun($laptop->tahunProduksi)) ?>
              </strong>
            </div>
          </div>

          <div class="status">
            <span class="status-dot"></span>
            <?= aman($laptop->nyalakan()) ?>
          </div>

        </article>
        <?php endforeach; ?>

      </div>
      <?php else: ?>
      <div class="empty">
        Belum ada data laptop yang tersedia.
      </div>
      <?php endif; ?>

    </div>
  </section>

  <!-- TENTANG -->
  <section class="section" id="tentang">
    <div class="container">
      <div class="form-panel">
        <span class="eyebrow">Tentang Program</span>
        <h2>Belajar PHP Object-Oriented Programming</h2>
        <p>
          Website ini dibuat untuk mempelajari penerapan class,
          object, atribut, method, constructor, function,
          percabangan, dan perulangan menggunakan PHP.
          Class Laptop digunakan sebagai cetak biru untuk
          membentuk object yang berisi data mahasiswa
          beserta spesifikasi laptopnya.
        </p>
      </div>
    </div>
  </section>

  <footer>
    <div class="container footer-inner">
      <p><strong>Laptop Mahasiswa</strong> · Praktikum Pemrograman Web</p>
      <p>Dibangun menggunakan PHP OOP & HTML/CSS</p>
    </div>
  </footer>
</body>

</html>