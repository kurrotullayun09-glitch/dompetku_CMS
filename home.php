<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="p-4 p-md-5 mb-4 bg-white rounded-3 shadow-sm text-center">
    <h1 class="display-5 fw-bold"><i class="bi bi-wallet2 text-primary"></i> DompetKu</h1>
    <p class="lead text-muted">Aplikasi Pencatatan Pengeluaran Mahasiswa</p>
    <p>Catat tanggal, kategori, keterangan, dan nominal pengeluaran. Pantau anggaran bulananmu sebelum uang habis.</p>
    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <a href="<?= base_url('dashboard') ?>" class="btn btn-primary btn-lg">Buka Dashboard</a>
        <a href="<?= base_url('pengeluaran') ?>" class="btn btn-outline-primary btn-lg">Lihat Data</a>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-4"><div class="card h-100"><div class="card-body">
        <h5><i class="bi bi-journal-plus text-primary"></i> Catat Cepat</h5>
        <p class="mb-0 text-muted">Tambah, ubah, dan hapus pengeluaran dengan form sederhana.</p>
    </div></div></div>
    <div class="col-md-4"><div class="card h-100"><div class="card-body">
        <h5><i class="bi bi-pie-chart text-primary"></i> Dashboard & Grafik</h5>
        <p class="mb-0 text-muted">Lihat ke mana uangmu pergi setiap bulan.</p>
    </div></div></div>
    <div class="col-md-4"><div class="card h-100"><div class="card-body">
        <h5><i class="bi bi-bell text-primary"></i> Peringatan Anggaran</h5>
        <p class="mb-0 text-muted">Atur batas bulanan dan dapatkan peringatan otomatis.</p>
    </div></div></div>
</div>

<p class="text-center text-muted mt-4 mb-0">
    Dikembangkan oleh: <strong>[Nama Anda]</strong> — NIM: <strong>[NIM Anda]</strong> — [Mata Kuliah / Kelas]
</p>
<?= $this->endSection() ?>
