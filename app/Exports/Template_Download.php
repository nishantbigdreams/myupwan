<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class Template_Download implements FromArray, WithHeadings, ShouldAutoSize
{
    public function array(): array
    {
        $data = array();

        return $data;
    }


    public function headings(): array
    {
        return [
            'Model',
            'Name',
            'Category',
            'Product Weight',
            'Description',
            'Status',
            'In Stock',
            'Base Price',
            'Sell Price',
            'Delevery Charge',
            'GST',
            'Price without GST',
            'Similar Products',
            'Is Variations',
            'Variation Data',
            'Used Variation',
            'Video Url',
            'Alt Name',
        ];
    }

}
