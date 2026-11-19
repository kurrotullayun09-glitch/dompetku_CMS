<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

// Dashboard & anggaran
$routes->get('dashboard', 'Dashboard::index');
$routes->post('dashboard/anggaran', 'Dashboard::simpanAnggaran');

// CRUD pengeluaran
$routes->get('pengeluaran', 'Pengeluaran::index');
$routes->get('pengeluaran/export', 'Pengeluaran::export');
$routes->get('pengeluaran/tambah', 'Pengeluaran::tambah');
$routes->post('pengeluaran/simpan', 'Pengeluaran::simpan');
$routes->get('pengeluaran/ubah/(:num)', 'Pengeluaran::ubah/$1');
$routes->post('pengeluaran/perbarui/(:num)', 'Pengeluaran::perbarui/$1');
$routes->post('pengeluaran/hapus/(:num)', 'Pengeluaran::hapus/$1');
