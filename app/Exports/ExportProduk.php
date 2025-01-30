<?php


namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportProduk implements FromCollection, WithHeadings, WithMapping
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    // Koleksi data yang akan diekspor
    public function collection()
    {
        return $this->data;
    }

    // Header kolom untuk file Excel
    public function headings(): array
    {
        return [
            'No',          // Tambahkan kolom nomor
            'Nama Produk',
            'Kategori',
            'Harga Beli',
            'Harga Jual',
            'Stok',
        ];
    }

    // Map data untuk setiap baris dengan nomor otomatis
    public function map($row): array
    {
        static $index = 1; // Inisialisasi nomor otomatis
        return [
            $index++,       // Kolom nomor
            $row->nama_produk,
            $row->kategori,
            $row->harga_beli,
            $row->harga_jual,
            $row->stok,
        ];
    }
}

