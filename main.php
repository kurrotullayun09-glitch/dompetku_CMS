<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($judul ?? 'Beranda') ?> | DompetKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php $uri = uri_string(); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= base_url('/') ?>"><i class="bi bi-wallet2"></i> DompetKu</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu"
                aria-controls="menu" aria-expanded="false" aria-label="Buka menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link <?= $uri === '' ? 'active' : '' ?>" href="<?= base_url('/') ?>">Beranda</a></li>
                <li class="nav-item"><a class="nav-link <?= str_starts_with($uri, 'dashboard') ? 'active' : '' ?>" href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link <?= str_starts_with($uri, 'pengeluaran') ? 'active' : '' ?>" href="<?= base_url('pengeluaran') ?>">Pengeluaran</a></li>
            </ul>
        </div>
    </div>
</nav>

<main class="container pb-5">
    <?php if (session()->getFlashdata('pesan')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> <?= esc(session()->getFlashdata('pesan')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('galat')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle"></i> <?= esc(session()->getFlashdata('galat')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    <?php endif; ?>

    <?= $this->renderSection('content') ?>
</main>

<footer class="text-center text-muted small py-3 border-top">
    DompetKu &copy; <?= date('Y') ?> — Tugas Pengembangan Aplikasi Web (CodeIgniter 4)
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?= $this->renderSection('scripts') ?>
</body>
</html>
