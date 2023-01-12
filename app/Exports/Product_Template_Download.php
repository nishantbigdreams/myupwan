<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use App\Product;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class Product_Template_Download implements FromArray, WithHeadings, ShouldAutoSize
{
    public function array(): array
    {
        $data = array();

        $output = Product::whereNull('deleted_at')->get();
        foreach ($output as $key => $value) {
            array_push($data, array(
                $value->id,
                $value->sku,
                $value->model,
                $value->name,
                $value->category,
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
