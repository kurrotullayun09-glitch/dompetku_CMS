<?php

namespace App\Models;

use CodeIgniter\Model;

class PengeluaranModel extends Model
{
    public const KATEGORI = ['Makanan', 'Transportasi', 'Pendidikan', 'Hiburan', 'Kesehatan', 'Lainnya'];

    protected $table         = 'pengeluaran';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['tanggal', 'kategori', 'keterangan', 'nominal'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /** Terapkan pencarian & filter. Mengembalikan model agar bisa dirangkai. */
    public function filter(?string $keyword, ?string $kategori, ?string $bulan): self
    {
        if (! empty($keyword)) {
            $this->like('keterangan', $keyword);
        }
        if (! empty($kategori)) {
            $this->where('kategori', $kategori);
        }
        if (! empty($bulan) && preg_match('/^\d{4}-\d{2}$/', $bulan)) {
            $awal  = $bulan . '-01';
            $akhir = date('Y-m-t', strtotime($awal));
            $this->where('tanggal >=', $awal)->where('tanggal <=', $akhir);
        }

        return $this;
    }

    /** Jumlah nominal dari query yang sedang dirangkai. */
    public function totalNominal(): int
    {
        $row = $this->builder()->selectSum('nominal', 'total')->get()->getRow();

        return (int) ($row->total ?? 0);
    }

    /** Total pengeluaran per kategori pada satu bulan (untuk grafik). */
    public function totalPerKategori(string $bulan): array
    {
        return $this->filter(null, null, $bulan)
            ->builder()
            ->select('kategori, SUM(nominal) AS total')
            ->groupBy('kategori')
            ->orderBy('total', 'DESC')
            ->get()
            ->getResultArray();
    }
}
