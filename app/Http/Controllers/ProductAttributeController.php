<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductAttributeMaster;
use Illuminate\Http\Request;
use App\ProductAttribute;
use Carbon\Carbon;
use Image;
use Validator;

class ProductAttributeController extends Controller
{

    public function index()
    {

        $attributemasters = ProductAttribute::get();
        $products = Product::get();
        return view('admin.productattribute.index', compact('attributemasters','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attributemasters = ProductAttributeMaster::get();
        $products = Product::get();
        return view('admin.productattribute.create', compact('attributemasters','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pro_att = new ProductAttribute();

        $pro_att->text = $request->text;
        $pro_att->p_id = $request->p_id;
        $pro_att->patt_id = $request->patt_id;
        $pro_att->created_at = Carbon::now();
        $pro_att->updated_at = Carbon::now();
        $pro_att->save();
        return redirect('admin/productattibute')->withStatus('Attribute Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pro_att1 = ProductAttribute::findOrFail($id)->get();
        $products = Product::all();
        $products_attribute = ProductAttributeMaster::get();
        return view('admin.productattribute.edit', compact('pro_att1','products_attribute', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pro_att = new ProductAttribute();
        $pro_att = ProductAttribute::findOrFail($id);

        $pro_att->text = $request->text;
        $pro_att->p_id = $request->p_id;
        $pro_att->patt_id = $request->patt_id;
        $pro_att->updated_at = Carbon::now();
        $pro_att->update();

        return redirect('admin/productattibute')->withStatus('Attribute Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function deleteattribute(Request $request)
    {


        $pro_att=new ProductAttribute();
        $pro_att=ProductAttribute::findOrFail($request->id);

        $image_name = $pro_att->image;
        try {
            $pro_att->delete($request->id);

            return response()->json(true);
        }
        catch (\Exception $e) {

            return response()->json(true);
        }
    }

}
