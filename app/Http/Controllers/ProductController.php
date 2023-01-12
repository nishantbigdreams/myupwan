<?php

namespace App\Http\Controllers;

use App\User;
use App\Media;
use App\Charge;
use App\Product;
use App\Category;
use App\PincodeShipping;
use Illuminate\Http\Request;
use App\Imports\Import_Target;
use App\Exports\Template_Download;
use App\Imports\Import_Product_Target;
use App\Exports\Product_Template_Download;
use App\Exports\Flipcart_Template_Download;
use Excel;
use App\Jobs\sendNewProductNewsLetter;
use Illuminate\Support\Facades\Storage;
use DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $categories = Category::all();
        $charges = Charge::take(3)->get();
        return view('admin.product.index', compact('categories', 'charges'));
    }

    public function pincode_index()
    {
        return view('admin.pincode');
    }
    public function review_index(){
        return view('admin.review');
    }

    public function get_pincode()
    {
        $pincode_shipping = PincodeShipping::all();

        $data = array();


        foreach ($pincode_shipping as $key => $temp) {

            array_push($data, array(
                $key,
                '<p class="form-control pincode_name" readonly="">' . $temp->pincode . '</p>',
                '<input type="checkbox" name="" class="form-control pincode_block" ' . ($temp->block == 1 ? "checked" : "") . '>',
                '<input type="checkbox" name="" class="form-control pincode_cod" ' . ($temp->cod_block == 1 ? "checked" : "") . '>',
                '<input type="checkbox" name="" class="form-control pincode_refund" ' . ($temp->refund_block == 1 ? "checked" : "") . '>',
                '<button type="button" name="" class="form-control save_pincode">Save</button>'
            ));

        }

        // dd($data);

        return response()->json([
            'data' => $data
        ]);
    }

    public function get_review(){
        
                                $review=DB::table('review')
                                ->select('review.*','users.name as user_name' ,'products.name')
                                ->join('users','users.id','=','review.user_id')
                                ->join('products','products.id','=','review.product_id')
                                ->orderBy('review.id','desc')
                                ->get();

        $data               = array();


        foreach ($review as $key => $temp) {


            if($temp->approve == 0){
                $status      =   '<p > Not Approved</p>';
                $action     =   '<button type="button"  class="btn-success" onclick="change_status('.$temp->id.',0)">Do Approve</button>';
            }else{
                $status      =   '<p >Approved</p>';
                $action     =   '<button type="button"  class="btn-danger" onclick="change_status('.$temp->id.',1)">Do Reject</button>';
            }

            array_push($data, array(
                $key,
                '<p  >' . $temp->name . '</p>',
                '<p  >' . $temp->user_name . '</p>',
                '<p  >' . $temp->review . '</p>',
                '<p  >' . $temp->rating . '</p>',
                '<p  >' . $temp->create_date . '</p>',
                $status,
                $action
            ));

        }

        // dd($data);

        return response()->json([
            'data' => $data
        ]);

    }

    public function update_pincode_status(Request $request)
    {

        $pincode = PincodeShipping::where("pincode", $request->pincode)->update([
            'block' => $request->pincode_block,
            'cod_block' => $request->pincode_cod,
            'refund_block' => $request->pincode_refund
        ]);

        return "true";

    }
    public function update_review_status(Request $request)
    {   
        $review_id      =       $request->review_id;
        $status         =       $request->status;
        $date           =       date('Y-m-s');
        if($status == 0){
            $status = 1;

        }else{
            $status = 0;
        }
        
        $flag =DB::table('review')
        ->where('id', $review_id)  // find your user by their email
        ->update(array('approve' => $status,'update_date'=>$date));

        if($flag){
            return "true";

        }else{
            return "false";

        }


        
        

        //return "true";

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $news_letter_member = User::where('subcribe_to_newsletter', 'yes')->count();
        $categories = Category::all();
        $product    =  array();
        $product["name"]    =   "empty";
        $product            =   (object) $product;
        return view('admin.product.create', compact('product','categories', 'news_letter_member'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
// dd($request->details);

        $categories             =   json_encode($request->category);
        $details                = $request->details;
        $home_best_sellers      = $request->home_best_sellers == null ? 0 : 1;
        $home_recent_arrivals   = $request->home_recent_arrivals == null ? 0 : 1;
        // $this->validate($request,[
        //     'sku_code' => 'required',
        //     'model' => 'required',
        //     'name' => 'required',
        //     'description' => 'required',
        //     'base_price' => 'required|numeric',
        //     'sell_price' => 'nullable|numeric',
        //     'combo_qty.*' => 'nullable|numeric',
        //     'combo_discount.*' => 'nullable|numeric',
        // ]);

        $data_array = $request->except([
            '_token', 'media_token', 'name', 'model', 'description', 'files', 'sku_code',
            'send_news_letter', 'similar_products', 'base_price', 'sell_price', 'similar_products', 'combo_qty', 'combo_discount', 'product_gst', 'video_url', 'is_variations', 'variant_name', 'sku', 'product_weight',
        ]);
        $variation_data = $request->only(['sku', 'variant_name']);

        $variant_name = $request->variant_name ?? [];

        $used_variation = NULL;


        if ($request->is_variations) {

            $used_variation = $variant_name[array_search($request->sku_code, $request->sku)] ?? NULL;

        }


        if (count($data_array) > 2) {
            $data_array = $this->changeNameOfAttributes($data_array);

        }
        $product_price = $request->sell_price ?? $request->base_price;
        $product_gst = $request->product_gst ?? 0;


        $product = Product::create([
            'sku' => $request->sku_code,
            'home_best_sellers' => $home_best_sellers,
            'home_recent_arrivals' => $home_recent_arrivals,
            'model' => $request->model,
            'name' => $request->name,
            'category' => $categories,
            'video_url' => $request->video_url,
            'description' => $request->description,
            'details' => $details,
            'base_price' => $request->base_price,
            'alt_name' => $request->alt_name,
            'sell_price' => $product_price * (100 / ($product_gst + 100)),
            'similar_products' => $request->similar_products,
            'data' => json_encode($data_array),
            'combo_qty' => $request->combo_qty ? json_encode($request->combo_qty) : null,
            'combo_discount' => $request->combo_discount ? json_encode($request->combo_discount) : null,
            'delevery_charge' => $request->delevery_charge,
            'gst' => $product_gst,
            'price_without_gst' => $product_price,
            'is_variations' => $request->is_variations == 'true' ? 1 : 0,
            'variation_data' => !empty($request->is_variations) ? json_encode($variation_data) : NULL,
            'used_variation' => !empty($used_variation) ? $used_variation : NULL,
            'product_weight' => $request->product_weight,
            'unit' => $request->unit,
        ]);
        Media::where('token', $request->media_token)->update([
            'product_id' => $product->id,
            'token' => null,
        ]);

        if ($request->send_news_letter) {
            sendNewProductNewsLetter::dispatch($product);
        }
        // dd($product);
        return redirect()->route('admin.product.index')->withStatus('Listing Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {   
        $product->load('gallerImages');
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        
        $details= $request->details;
        $home_best_sellers = $request->home_best_sellers == null ? 0 : 1;
        $home_recent_arrivals = $request->home_recent_arrivals == null ? 0 : 1;
        //dd($details);
        
        /*$this->validate($request, [
            'sku_code' => 'required',
            'model' => 'required',
            'name' => 'required',
            'description' => 'required',
            'details' => 'required',
            'base_price' => 'required|numeric',
            'sell_price' => 'nullable|numeric',
            // 'in_stock' => 'numeric',
            'combo_qty.*' => 'nullable|numeric',
            'combo_discount.*' => 'nullable|numeric',
            'video_url' => 'nullable|url'
        ]);*/
        


        if ($request->category) {
            $data_array = $request->except([
                '_token', 'media_token', '_method', 'name', 'model', 'description','details','files', 'sku_code',
                'send_news_letter', 'similar_products', 'base_price', 'sell_price', 'similar_products', 'combo_qty', 'combo_discount', 'product_gst', 'video_url', 'is_variations', 'variant_name', 'sku', 'product_weight',
            ]);

            if (count($data_array) > 2) {
                $data_array = $this->changeNameOfAttributes($data_array);

            }
            $product->category = json_encode($request->category);
            
            $product->data = json_encode($data_array);

        }

        $variation_data = $request->only(['sku', 'variant_name']);

        $variant_name = $request->variant_name ?? [];

        $used_variation = NULL;

        if ($request->is_variations) {

            $used_variation = $variant_name[array_search($request->sku_code, $request->sku)] ?? NULL;

        }
        

        $product->details                           = $details;
        $product->sku                               = $request->sku_code;
        $product->home_best_sellers                 = $home_best_sellers;
        $product->home_recent_arrivals              = $home_recent_arrivals;
        $product->category                          = json_encode($request->category);
        $product->unit                              = $request->unit;
        $product->model                             = $request->model;
        $product->name                              = $request->name;
        $product->description                       = $request->description;
        $product->base_price                        = $request->base_price;
        $product->video_url                         = $request->video_url;
        $product->product_weight                    = $request->product_weight;
        $product_price                              = $request->sell_price ?? $request->base_price;
        $product_gst                                = $request->product_gst ?? 0;
        $product->sell_price                        = $product_price * (100 / ($product_gst + 100));
        $product->delevery_charge                   = $request->delevery_charge;
        $product->alt_name                          = $request->alt_name;
        $product->gst                               = $product_gst;
        $product->price_without_gst                 = $product_price;
        $product->in_stock                          = $request->in_stock ? number_format($request->in_stock) : null;
        $product->similar_products                  = $request->similar_products;
        $product->combo_qty                         = $request->combo_qty ? json_encode($request->combo_qty) : null;
        $product->combo_discount                    = $request->combo_qty ? json_encode($request->combo_discount) : null;
        $product->is_variations                     = $request->is_variations == 'true' ? 1 : 0;
        $product->variation_data                    = !empty($request->is_variations) ? json_encode($variation_data) : NULL;
        $product->used_variation                    = !empty($used_variation) ? $used_variation : NULL;
        $product->updated_at                        = now();
        // dd($product);
        $product->save();

        Media::where('token', $request->media_token)->update([
            'product_id' => $product->id,
            'token' => null,
        ]);

        $product->searchable();
        return redirect()->route('admin.product.index')->withStatus('Listing Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function deletePermanent(Request $request)
    {
        $product = Product::withTrashed()->findOrFail($request->product);
        $product->parmanent_deleted_at = now();
        $product->save();
        return response()->json(true);
    }

    public function checkSkuCode(Request $request)
    {
        if (Product::where('sku', $request->sku)->count()) {
            return response()->json('sku not available');
        }
        return response()->json('sku available');
    }

    public function mediaUploads(Request $request)
    {
        if ($request->hasFile('file')) {

            Media::create([
                'url' => $request->file->store('public/' . $request->type),
                'type' => $request->type,
                'token' => $request->media_token,
            ]);
            $file = $request->file('file');
            $timestamp = date('Ymdhis');
            $name = $request->file->store('public/' . $request->type);

            $file->move(public_path() . '/public/' . $request->type, $name);
        }
    }

    public function deleteMedia(Request $request)
    {
        $media = Media::findOrFail($request->media);
        $tmp = explode('public', $media->url);
        $file = 'public/' . $tmp[1];
        Storage::delete($file);
        if ($media->delete()) {
            return response()->json(true);
        }
        return response()->json(false);
    }

    public function updateStock(Request $request, Product $product)
    {
        if ($request->type == 'stock') {
            $product->in_stock = $request->value;
        } else {
            $product->price_without_gst = $request->value;
        }

        if ($product->save()) {

            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'success'
                ]);
            }
            return back()->withStatus('Price Updated');

        } else {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'failed'
                ]);
            }
            return back()->withStatus('Price Updated failed !!');
        }
    }

    public function unarchiveProduct(Request $request)
    {
        $product = Product::onlyTrashed()->findOrFail($request->product);
        if ($product->restore()) {
            return response()->json('success');
        }
        return response()->json(['error']);
    }

    public function archiveProduct(Request $request)
    {
        $product = Product::findOrFail($request->product);
        if ($product->delete()) {
            return response()->json('success');
        }
        return response()->json(['error']);
    }

    public function cloneProduct(Product $product)
    {

        $new_product = $product->replicate();

        if ($new_product->save()) {
            $categories = Category::all();
            return view('admin.product.edit', compact('categories'))
                ->withProduct($new_product);
        }
        return back()->withStatus('Error!! <br> Something went wrong');
    }

    public function replace_key($arr, $oldkey, $newkey)
    {
        if (array_key_exists($oldkey, $arr)) {
            $keys = array_keys($arr);
            $keys[array_search($oldkey, $keys)] = $newkey;
            return array_combine($keys, $arr);
        }
        return $arr;
    }

    public function changeNameOfAttributes($data_array)
    {
        $data_array_keys = array_keys($data_array);
        $data_array_keys = array_slice($data_array_keys, 2);
        $data_array_new_keys = array_map(function ($val) {
            return str_replace('_', ' ', $val);
        }, $data_array_keys);
        foreach ($data_array_keys as $index => $key) {
            $data_array = $this->replace_key($data_array, $key, $data_array_new_keys[$index]);

        }
        return $data_array;
    }

    public function showExcel()
    {
        $categories = Category::all();
        $charges = Charge::take(3)->get();
        return view('admin.product.excel', compact('categories', 'charges'));
    }

    public function downloadTemplate()
    {
        return Excel::download(new Template_Download, 'template.xlsx');
    }

    public function uploadTemplate(Request $request)
    {
        Excel::import(new Import_Target(), request()->file('target_excel'));
        return redirect()->back();
    }

    public function downloadProductTemplate()
    {
        return Excel::download(new Product_Template_Download, 'product_template.xlsx');
    }

    public function uploadProductTemplate(Request $request)
    {
        Excel::import(new Import_Product_Target(), request()->file('target_product_excel'));
        return redirect()->back();
    }

    public function downloadForFlipcartTemplate()
    {
        return Excel::download(new Flipcart_Template_Download, 'product_for_flipcart_template.xlsx');
    }
}
