<?php

namespace App\Exports;

use App\Models\Voucher;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VouchersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return Collection
    */
    public function collection()
    {
        return Voucher::all();
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'ID',
            'Kode Voucher',
            'Diskon (%)',
            'Tanggal Kadaluarsa',
            'Tanggal Dibuat',
            'Terakhir Diupdate'
        ];
    }

    /**
    * @param mixed $voucher
    * @return array
    */
    public function map($voucher): array
    {
        return [
            $voucher->id,
            $voucher->code,
            $voucher->discount,
            $voucher->expiry_date->format('d/m/Y'),
            $voucher->created_at->format('d/m/Y H:i'),
            $voucher->updated_at->format('d/m/Y H:i')
        ];
    }
} 