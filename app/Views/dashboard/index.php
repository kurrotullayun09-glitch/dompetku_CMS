<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <h3 class="mb-0">Dashboard</h3>
    <form method="get" action="<?= base_url('dashboard') ?>" class="d-flex gap-2">
        <input type="month" name="bulan" class="form-control" value="<?= esc($bulan) ?>">
        <button class="btn btn-secondary">Lihat</button>
    </form>
</div>

<?php if ($batas > 0 && $persen >= 100): ?>
    <div class="alert alert-danger"><i class="bi bi-exclamation-octagon"></i>
        Anggaran terlampaui! Pengeluaran sudah melebihi batas sebesar Rp <?= number_format(abs($sisa), 0, ',', '.') ?>.</div>
<?php elseif ($batas > 0 && $persen >= 70): ?>
    <div class="alert alert-warning"><i class="bi bi-exclamation-triangle"></i>
        Hati-hati, pengeluaran sudah <?= $persen ?>% dari anggaran bulan ini.</div>
<?php elseif ($batas === 0): ?>
    <div class="alert alert-info"><i class="bi bi-info-circle"></i>
        Anggaran bulan ini belum diatur. Isi batas anggaran di bawah untuk mengaktifkan peringatan.</div>
<?php endif; ?>

<div class="row g-3 mb-3">
    <div class="col-12 col-md-4"><div class="card text-bg-primary h-100"><div class="card-body">
        <div class="small">Total Pengeluaran</div>
        <div class="fs-4 fw-bold">Rp <?= number_format($total, 0, ',', '.') ?></div>
    </div></div></div>
    <div class="col-6 col-md-4"><div class="card h-100"><div class="card-body">
        <div class="small text-muted">Anggaran Bulan Ini</div>
        <div class="fs-4 fw-bold">Rp <?= number_format($batas, 0, ',', '.') ?></div>
    </div></div></div>
    <div class="col-6 col-md-4"><div class="card h-100"><div class="card-body">
        <div class="small text-muted">Sisa Anggaran</div>
        <div class="fs-4 fw-bold <?= $sisa < 0 && $batas > 0 ? 'text-danger' : 'text-success' ?>">
            <?= $batas > 0 ? 'Rp ' . number_format($sisa, 0, ',', '.') : '-' ?>
        </div>
    </div></div></div>
</div>

<?php if ($batas > 0): ?>
<div class="card mb-3"><div class="card-body">
    <div class="d-flex justify-content-between small mb-1"><span>Pemakaian anggaran</span><span><?= $persen ?>%</span></div>
    <div class="progress" style="height: 22px;" role="progressbar" aria-valuenow="<?= min($persen, 100) ?>" aria-valuemin="0" aria-valuemax="100">
        <div class="progress-bar bg-<?= $warna ?>" style="width: <?= min($persen, 100) ?>%"><?= $persen ?>%</div>
    </div>
</div></div>
<?php endif; ?>

<div class="row g-3">
    <div class="col-12 col-lg-6"><div class="card h-100"><div class="card-body">
        <h5>Pengeluaran per Kategori</h5>
        <?php if (empty($perKategori)): ?>
            <p class="text-muted mb-0">Belum ada data pada bulan ini.</p>
        <?php else: ?>
            <canvas id="grafik" style="max-height: 300px;"></canvas>
        <?php endif; ?>
    </div></div></div>

    <div class="col-12 col-lg-6"><div class="card h-100"><div class="card-body">
        <h5>Atur Anggaran Bulan Ini</h5>
        <form action="<?= base_url('dashboard/anggaran') ?>" method="post" class="row g-2 mb-4">
            <?= csrf_field() ?>
            <input type="hidden" name="bulan" value="<?= esc($bulan) ?>">
            <div class="col-8"><input type="number" name="batas" min="1" class="form-control" placeholder="Contoh: 500000"
                                       value="<?= $batas > 0 ? $batas : '' ?>" required></div>
            <div class="col-4 d-grid"><button class="btn btn-primary">Simpan</button></div>
        </form>

        <h5>5 Transaksi Terakhir</h5>
        <ul class="list-group list-group-flush">
            <?php if (empty($terbaru)): ?><li class="list-group-item text-muted">Belum ada data.</li><?php endif; ?>
            <?php foreach ($terbaru as $row): ?>
                <li class="list-group-item d-flex justify-content-between">
                    <span><?= esc($row['keterangan']) ?> <small class="text-muted">(<?= esc($row['kategori']) ?>)</small></span>
                    <strong>Rp <?= number_format($row['nominal'], 0, ',', '.') ?></strong>
                </li>
            <?php endforeach; ?>
        </ul>
    </div></div></div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?php if (! empty($perKategori)): ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script>
    const labels = <?= json_encode(array_column($perKategori, 'kategori'), JSON_HEX_TAG) ?>;
    const nilai  = <?= json_encode(array_map('intval', array_column($perKategori, 'total'))) ?>;
    new Chart(document.getElementById('grafik'), {
        type: 'doughnut',
        data: { labels: labels, datasets: [{ data: nilai }] }
    });
</script>
<?php endif; ?>
<?= $this->endSection() ?>
