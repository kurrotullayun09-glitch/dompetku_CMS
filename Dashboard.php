<?php

namespace App\Controllers;

use App\Models\AnggaranModel;
use App\Models\PengeluaranModel;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $bulan = $this->request->getGet('bulan');
        if (! $bulan || ! preg_match('/^\d{4}-\d{2}$/', $bulan)) {
            $bulan = date('Y-m');
        }

        $pengeluaran = new PengeluaranModel();
        $anggaran    = new AnggaranModel();

        $total       = $pengeluaran->filter(null, null, $bulan)->totalNominal();
        $perKategori = $pengeluaran->totalPerKategori($bulan);
        $terbaru     = $pengeluaran->filter(null, null, $bulan)
            ->orderBy('tanggal', 'DESC')->orderBy('id', 'DESC')->findAll(5);

        $batas  = (int) ($anggaran->where('bulan', $bulan)->first()['batas'] ?? 0);
        $persen = $batas > 0 ? (int) round($total / $batas * 100) : 0;
        $warna  = $persen >= 100 ? 'danger' : ($persen >= 70 ? 'warning' : 'success');

        return view('dashboard/index', [
            'judul'       => 'Dashboard',
            'bulan'       => $bulan,
            'total'       => $total,
            'batas'       => $batas,
            'sisa'        => $batas - $total,
            'persen'      => $persen,
            'warna'       => $warna,
            'perKategori' => $perKategori,
            'terbaru'     => $terbaru,
        ]);
    }

    public function simpanAnggaran()
    {
        $aturan = [
            'bulan' => 'required|regex_match[/^\d{4}-\d{2}$/]',
            'batas' => 'required|is_natural_no_zero|less_than_equal_to[1000000000]',
        ];
        $pesan = [
            'bulan' => ['required' => 'Bulan wajib diisi.', 'regex_match' => 'Format bulan tidak valid.'],
            'batas' => [
                'required'           => 'Batas anggaran wajib diisi.',
                'is_natural_no_zero' => 'Batas anggaran harus angka bulat lebih dari 0.',
                'less_than_equal_to' => 'Batas anggaran terlalu besar.',
            ],
        ];

        $bulan = (string) $this->request->getPost('bulan');

        if (! $this->validate($aturan, $pesan)) {
            return redirect()->to('/dashboard?bulan=' . urlencode($bulan))
                ->with('galat', implode(' ', $this->validator->getErrors()));
        }

        $model = new AnggaranModel();
        $batas = (int) $this->request->getPost('batas');
        $ada   = $model->where('bulan', $bulan)->first();

        $ada ? $model->update($ada['id'], ['batas' => $batas])
             : $model->insert(['bulan' => $bulan, 'batas' => $batas]);

        return redirect()->to('/dashboard?bulan=' . urlencode($bulan))
            ->with('pesan', 'Anggaran bulanan berhasil disimpan.');
    }
}
