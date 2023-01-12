<?php
namespace App\Imports;

use App\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;



class Import_Target implements ToCollection
{
    public $count = 0;
    public $num = 0;
   
    public function __construct()
    {
    }

    public function collection(Collection $rows)
    {
        $product = Product::withTrashed()->orderBy('id','DESC')->first();
        $num = $product->id;
        foreach ($rows as $row) 
        {
            // ++$num;
            if($this->count > 0)
            {
                Product::updateOrCreate(
                    [
                     'sku' => 'SKU-'.++$num,
                     'model' => $row[0],
                     'name' => $row[1],
                     'category' => $row[2],
                     'product_weight' => $row[3],
                    'description' => $row[4],
                    'status' => $row[5],
                    'in_stock' => $row[6],
                    'base_price' => $row[7],
                    'sell_price' => $row[8],
                    'delevery_charge' => $row[9],
                    'gst' => $row[10],
                    'price_without_gst' => $row[11],
                    'similar_products' => $row[12],
                    'is_variations' => $row[13],
                    'variation_data' => $row[14],
                    'used_variation' => $row[15],
                    'video_url' => $row[16],
                    'alt_name' => $row[17]
                ]);
            }

            $this->count++;

        }
    }
}