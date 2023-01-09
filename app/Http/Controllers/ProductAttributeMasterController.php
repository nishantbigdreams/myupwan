<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductAttributeMaster;
use Carbon\Carbon;
use Image;
use Validator;
use Illuminate\Support\Facades\Storage;

class ProductAttributeMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pro_att = ProductAttributeMaster::get();
        return view('admin.productattributemaster.index', compact('pro_att'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pro_att = ProductAttributeMaster::get();
        return view('admin.productattributemaster.create', compact('pro_att'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*   $message=[
               'image.required'=>'Choose Image',
               'name.required'=>'Name is Required'
           ];
           $validator=Validator::make($request->all(),['image'=>'required'],$message);
           if($validator->fails())
           {
               return redirect('admin/productattribute/create')
                   ->withErrors($validator)
                   ->withInput();
           }*/
        $pro_att = new ProductAttributeMaster();


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $timestamp = date('Ymdhis');
            $name = $timestamp . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/public/productattributeimg/', $name);
            $pro_att->image = $name;

        } else {
            $pro_att->image = public_path() . '/public/noimage.jpg';
        }
        $pro_att->name = $request->name;
/*        $pro_att->status = $request->status == null ? 0 : 1;*/
        $pro_att->created_at = Carbon::now();
        $pro_att->updated_at = Carbon::now();
        $pro_att->save();
        return redirect('admin/productattributemaster')->withStatus('Attribute Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pro_att = ProductAttributeMaster::where('id', $id)->get();
        return view('admin.productattributemaster.edit', compact('pro_att'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $pro_att = new ProductAttributeMaster();
        $pro_att = ProductAttributeMaster::findOrFail($id);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $timestamp = date('Ymdhis');
            $name = $timestamp . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/public/productattributeimg/', $name);
            //Image::make(public_path().'/public/productattributeimg/'.$name)->resize(1159, 398)->save(public_path().'/public/productattributeimg/'.$name, 99);
            $pro_att->image = $name;
            if (file_exists(public_path() . '/public/productattributeimg/' . $request->oldImage)) {
                unlink(public_path() . '/public/productattributeimg/' . $request->oldImage);
            }
        } else {
            $pro_att->image = $request->oldImage;
        }

        $pro_att->name = $request->name;
/*        $pro_att->status = $request->status == null ? 0 : 1;*/
        $pro_att->updated_at = Carbon::now();
        $pro_att->update();

        return redirect('admin/productattributemaster')->withStatus('Attribute Updated Successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deletepromasteratt(Request $request)
    {


        $pro_att=new ProductAttributeMaster();
        $pro_att=ProductAttributeMaster::findOrFail($request->id);

        $image_name = $pro_att->image;
        try {
            $pro_att->delete($request->id);
            if (file_exists(public_path() . '/public/productattributeimg/' . $image_name) && $image_name !='') {
                unlink(public_path() . '/public/productattributeimg/' . $image_name);
            }
            return response()->json(true);
        }
        catch (\Exception $e) {
        
            return response()->json(true);
        }
    }

}
