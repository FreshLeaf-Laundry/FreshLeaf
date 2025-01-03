<?php

namespace App\Exports;

use App\Models\Schedule;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ScheduleExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return Collection
    */
    public function collection()
    {
        return Schedule::all();
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'ID',
            'ID Pesanan',
            'Tanggal Pickup',
            'Tanggal Delivery',
            'Status',
            'Tanggal Dibuat',
            'Terakhir Diupdate'
        ];
    }

    /**
    * @param mixed $schedule
    * @return array
    */
    public function map($schedule): array
    {
        return [
            $schedule->id,
            $schedule->order_id,
            $schedule->pickup_date,
            $schedule->delivery_date,
            $schedule->status,
            $schedule->created_at->format('d/m/Y H:i'),
            $schedule->updated_at->format('d/m/Y H:i')
        ];
    }
}