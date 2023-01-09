<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use App\Product;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class Flipcart_Template_Download implements FromArray, WithHeadings, ShouldAutoSize
{
    public function array(): array
    {
        $data = array();

        $output = Product::withTrashed()->get();
        foreach ($output as $key => $value) {
            array_push($data, array(
                $value->id,
                $value->sku,
                $value->model,
                $value->name,
                $value->category,
                strip_tags($value->description),
                $value->product_weight,
                (double)$value->in_stock,
                $value->base_price,
                $value->sell_price,
                $value->delevery_charge,
                $value->gst,
                $value->price_without_gst
            ));
        }
        return $data;
    }


    public function headings(): array
    {
        return [
            'Id(Do not Edit)',
            'Sku Code(Do not Edit)',
            'Model(Do not Edit)',
            'Name(Do not Edit)',
            'Category(Do not Edit)',
            'Product Description',
            'Product Weight',
            'In Stock',
            'Base Price',
            'Sell Price',
            'Delevery Charge',
            'GST',
            'Price without GST'
        ];
    }

}
