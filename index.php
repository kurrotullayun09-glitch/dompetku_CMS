<?php
use App\Models\PengeluaranModel;
$kategoriList = PengeluaranModel::KATEGORI;
$queryExport  = http_build_query(array_filter(['q' => $q, 'kategori' => $kategori, 'bulan' => $bulan]));
?>
<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <h3 class="mb-0">Daftar Pengeluaran</h3>
    <div class="d-flex gap-2">
        <a href="<?= base_url('pengeluaran/export') . ($queryExport ? '?' . $queryExport : '') ?>" class="btn btn-outline-success">
            <i class="bi bi-filetype-csv"></i> Ekspor CSV
        </a>
        <a href="<?= base_url('pengeluaran/tambah') ?>" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah</a>
    </div>
</div>

<form method="get" action="<?= base_url('pengeluaran') ?>" class="row g-2 mb-3">
    <div class="col-12 col-md-4">
        <input type="text" name="q" class="form-control" placeholder="Cari keterangan..." value="<?= esc($q) ?>">
    </div>
    <div class="col-6 col-md-3">
        <select name="kategori" class="form-select">
            <option value="">Semua kategori</option>
            <?php foreach ($kategoriList as $k): ?>
                <option value="<?= esc($k) ?>" <?= $kategori === $k ? 'selected' : '' ?>><?= esc($k) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-6 col-md-3">
        <input type="month" name="bulan" class="form-control" value="<?= esc($bulan) ?>">
    </div>
    <div class="col-12 col-md-2 d-grid d-md-flex gap-2">
        <button class="btn btn-secondary" type="submit">Filter</button>
        <a href="<?= base_url('pengeluaran') ?>" class="btn btn-outline-secondary">Reset</a>
    </div>
</form>

<div class="card shadow-sm">
    <div class="card-body">
        <p class="mb-3">Total (sesuai filter): <strong class="text-primary">Rp <?= number_format($total, 0, ',', '.') ?></strong></p>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th><th>Tanggal</th><th>Kategori</th><th>Keterangan</th>
                        <th class="text-end">Nominal</th><th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($daftar)): ?>
                    <tr><td colspan="6" class="text-center text-muted py-4">Belum ada data.</td></tr>
                <?php endif; ?>
                <?php foreach ($daftar as $i => $row): ?>
                    <tr>
                        <td><?= $mulai + $i + 1 ?></td>
                        <td><?= esc(date('d/m/Y', strtotime($row['tanggal']))) ?></td>
                        <td><span class="badge text-bg-secondary"><?= esc($row['kategori']) ?></span></td>
                        <td><?= esc($row['keterangan']) ?></td>
                        <td class="text-end">Rp <?= number_format($row['nominal'], 0, ',', '.') ?></td>
                        <td class="text-center text-nowrap">
                            <a href="<?= base_url('pengeluaran/ubah/' . $row['id']) ?>" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i> Ubah
                            </a>
                            <form action="<?= base_url('pengeluaran/hapus/' . $row['id']) ?>" method="post" class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini? Tindakan tidak dapat dibatalkan.');">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?= $pager->links('default', 'bootstrap') ?>
    </div>
</div>
<?= $this->endSection() ?>
