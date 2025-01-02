<?php

namespace App\Exports;

use App\Models\ItemsStore;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ItemsstoreExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ItemsStore::select('name', 'description', 'price', 'stock', 'image_path', 'created_at')->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Description',
            'Price',
            'Stock',
            'Image Path',
            'Created At'
        ];
    }
}
