<?php

namespace App\Controllers;

use App\Models\PengeluaranModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Pengeluaran extends BaseController
{
    private const PER_HALAMAN = 10;

    protected PengeluaranModel $model;

    public function __construct()
    {
        $this->model = new PengeluaranModel();
    }

    // ---------- READ: daftar + cari + filter + pagination ----------
    public function index(): string
    {
        $q        = $this->request->getGet('q');
        $kategori = $this->request->getGet('kategori');
        $bulan    = $this->request->getGet('bulan');

        $total  = $this->model->filter($q, $kategori, $bulan)->totalNominal();
        $daftar = $this->model->filter($q, $kategori, $bulan)
            ->orderBy('tanggal', 'DESC')
            ->orderBy('id', 'DESC')
            ->paginate(self::PER_HALAMAN);

        return view('pengeluaran/index', [
            'judul'    => 'Daftar Pengeluaran',
            'daftar'   => $daftar,
            'pager'    => $this->model->pager,
            'mulai'    => ($this->model->pager->getCurrentPage() - 1) * self::PER_HALAMAN,
            'total'    => $total,
            'q'        => $q,
            'kategori' => $kategori,
            'bulan'    => $bulan,
        ]);
    }

    // ---------- CREATE ----------
    public function tambah(): string
    {
        return view('pengeluaran/form', [
            'judul' => 'Tambah Pengeluaran',
            'aksi'  => base_url('pengeluaran/simpan'),
            'item'  => null,
        ]);
    }

    public function simpan()
    {
        if (! $this->validate($this->aturan(), $this->pesan())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->insert($this->request->getPost(['tanggal', 'kategori', 'keterangan', 'nominal']));

        return redirect()->to('/pengeluaran')->with('pesan', 'Data pengeluaran berhasil ditambahkan.');
    }

    // ---------- UPDATE ----------
    public function ubah(int $id): string
    {
        $item = $this->model->find($id) ?? throw PageNotFoundException::forPageNotFound();

        return view('pengeluaran/form', [
            'judul' => 'Ubah Pengeluaran',
            'aksi'  => base_url('pengeluaran/perbarui/' . $id),
            'item'  => $item,
        ]);
    }

    public function perbarui(int $id)
    {
        $this->model->find($id) ?? throw PageNotFoundException::forPageNotFound();

        if (! $this->validate($this->aturan(), $this->pesan())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->update($id, $this->request->getPost(['tanggal', 'kategori', 'keterangan', 'nominal']));

        return redirect()->to('/pengeluaran')->with('pesan', 'Data pengeluaran berhasil diubah.');
    }

    // ---------- DELETE ----------
    public function hapus(int $id)
    {
        $this->model->find($id) ?? throw PageNotFoundException::forPageNotFound();
        $this->model->delete($id);

        return redirect()->to('/pengeluaran')->with('pesan', 'Data pengeluaran berhasil dihapus.');
    }

    // ---------- Fitur tambahan: ekspor CSV ----------
    public function export()
    {
        $data = $this->model
            ->filter(
                $this->request->getGet('q'),
                $this->request->getGet('kategori'),
                $this->request->getGet('bulan')
            )
            ->orderBy('tanggal', 'DESC')
            ->findAll();

        $out = fopen('php://temp', 'r+');
        fwrite($out, "\xEF\xBB\xBF"); // BOM agar Excel membaca UTF-8
        fputcsv($out, ['Tanggal', 'Kategori', 'Keterangan', 'Nominal'], ',', '"', '\\');
        foreach ($data as $baris) {
            fputcsv($out, [$baris['tanggal'], $baris['kategori'], $baris['keterangan'], $baris['nominal']], ',', '"', '\\');
        }
        rewind($out);
        $csv = stream_get_contents($out);
        fclose($out);

        return $this->response
            ->setHeader('Content-Type', 'text/csv; charset=UTF-8')
            ->setHeader('Content-Disposition', 'attachment; filename="pengeluaran-' . date('Ymd') . '.csv"')
            ->setBody($csv);
    }

    // ---------- Aturan validasi ----------
    private function aturan(): array
    {
        return [
            'tanggal'    => 'required|valid_date[Y-m-d]',
            'kategori'   => 'required|in_list[' . implode(',', PengeluaranModel::KATEGORI) . ']',
            'keterangan' => 'required|min_length[3]|max_length[150]',
            'nominal'    => 'required|is_natural_no_zero|less_than_equal_to[1000000000]',
        ];
    }

    private function pesan(): array
    {
        return [
            'tanggal' => [
                'required'   => 'Tanggal wajib diisi.',
                'valid_date' => 'Format tanggal tidak valid.',
            ],
            'kategori' => [
                'required' => 'Kategori wajib dipilih.',
                'in_list'  => 'Kategori tidak valid.',
            ],
            'keterangan' => [
                'required'   => 'Keterangan wajib diisi.',
                'min_length' => 'Keterangan minimal 3 karakter.',
                'max_length' => 'Keterangan maksimal 150 karakter.',
            ],
            'nominal' => [
                'required'              => 'Nominal wajib diisi.',
                'is_natural_no_zero'    => 'Nominal harus berupa angka bulat lebih dari 0.',
                'less_than_equal_to'    => 'Nominal terlalu besar.',
            ],
        ];
    }
}
