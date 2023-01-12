<?php
namespace App\Imports;

use App\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;



class Import_Product_Target implements ToCollection
{
    public $count = 0;
   
    public function __construct()
    {
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            if($this->count > 0)
            {
                $id = (int)$row[0];
                $product = Product::withTrashed()->findOrFail($id);
                $product->sku = $row[1];
                $product->model = $row[2];
                $product->name = $row[3];
                $product->category = $row[4];
                $product->product_weight = $row[5];
                $product->in_stock = $row[6] ?? 0.00;
                $product->base_price = $row[7];
                $product->sell_price = $row[8];
                $product->delevery_charge = $row[9];
                $product->gst = $row[10];
                $product->price_without_gst = $row[11];
                $product->save();
            }

            $this->count++;

        }
    }
}