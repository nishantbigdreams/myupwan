<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Slider;
use Image;
class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider = Slider::get();
        return view('admin.slider.index', compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slider = new Slider();


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $timestamp = date('Ymdhis');
            $name = $timestamp . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/public/sliderimg/', $name);
            $slider->image = $name;

        } else {
            $slider->image = public_path() . '/public/noimage.jpg';
        }
        $slider->text_1 = $request->text_1;
        $slider->text_2 = $request->text_2;
        $slider->priority = $request->priority;
        $slider->status = $request->status == null ? 0 : 1;
        $slider->created_at = Carbon::now();
        $slider->save();
        return redirect('admin/slider')->withStatus('Slider Added Successfully');

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
        $slider = Slider::where('id', $id)->get();
        return view('admin.slider.edit', compact('slider'));
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
        $slider = new Slider();
        $slider = Slider::findOrFail($id);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $timestamp = date('Ymdhis');
            $name = $timestamp . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/public/sliderimg/', $name);
            //Image::make(public_path().'/public/sliderimg/'.$name)->resize(1159, 398)->save(public_path().'/public/sliderimg/'.$name, 99);
            $slider->image = $name;
            if (file_exists(public_path() . '/public/sliderimg/' . $request->oldImage)) {
                unlink(public_path() . '/public/sliderimg/' . $request->oldImage);
            }
        } else {
            $slider->image = $request->oldImage;
        }

        $slider->text_1 = $request->text_1;
        $slider->text_2 = $request->text_2;
        $slider->priority = $request->priority;
        $slider->status = $request->status == null ? 0 : 1;
        $slider->created_at = Carbon::now();
        $slider->updated_at = Carbon::now();
        $slider->update();

        return redirect('admin/slider')->withStatus('Slider Updated Successfully');

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
    public function deleteslider(Request $request)
    {


        $slider=new Slider();
        $slider=Slider::findOrFail($request->id);

        $image_name = $slider->image;
        try {
            $slider->delete($request->id);
            if (file_exists(public_path() . '/public/sliderimg/' . $image_name) && $image_name !='') {
                unlink(public_path() . '/public/sliderimg/' . $image_name);
            }
            return response()->json(true);
        }
        catch (\Exception $e) {

            return response()->json(true);
        }
    }
}
