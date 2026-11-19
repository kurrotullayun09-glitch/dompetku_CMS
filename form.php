<?php
use App\Models\PengeluaranModel;
$errors = session()->getFlashdata('errors') ?? [];
$kategoriPilihan = old('kategori', $item['kategori'] ?? '');
?>
<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header bg-white"><h4 class="mb-0"><?= esc($judul) ?></h4></div>
            <div class="card-body">
                <form action="<?= $aksi ?>" method="post" novalidate>
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" id="tanggal" name="tanggal"
                               class="form-control <?= isset($errors['tanggal']) ? 'is-invalid' : '' ?>"
                               value="<?= old('tanggal', $item['tanggal'] ?? date('Y-m-d')) ?>">
                        <div class="invalid-feedback"><?= esc($errors['tanggal'] ?? '') ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select id="kategori" name="kategori" class="form-select <?= isset($errors['kategori']) ? 'is-invalid' : '' ?>">
                            <option value="">-- Pilih kategori --</option>
                            <?php foreach (PengeluaranModel::KATEGORI as $k): ?>
                                <option value="<?= esc($k) ?>" <?= $kategoriPilihan === $k ? 'selected' : '' ?>><?= esc($k) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= esc($errors['kategori'] ?? '') ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan <span class="text-danger">*</span></label>
                        <input type="text" id="keterangan" name="keterangan" maxlength="150"
                               class="form-control <?= isset($errors['keterangan']) ? 'is-invalid' : '' ?>"
                               value="<?= old('keterangan', $item['keterangan'] ?? '') ?>"
                               placeholder="Contoh: Makan siang warteg">
                        <div class="invalid-feedback"><?= esc($errors['keterangan'] ?? '') ?></div>
                    </div>

                    <div class="mb-4">
                        <label for="nominal" class="form-label">Nominal (Rp) <span class="text-danger">*</span></label>
                        <input type="number" id="nominal" name="nominal" min="1"
                               class="form-control <?= isset($errors['nominal']) ? 'is-invalid' : '' ?>"
                               value="<?= old('nominal', $item['nominal'] ?? '') ?>" placeholder="15000">
                        <div class="invalid-feedback"><?= esc($errors['nominal'] ?? '') ?></div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                        <a href="<?= base_url('pengeluaran') ?>" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
