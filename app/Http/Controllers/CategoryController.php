<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\parentCategory;
use App\CategoriesSeo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class CategoryController extends Controller
{
   /* public function __construct()
    {
        $this->middleware('auth:admin');
    }*/

    public function index()
    {
        $categories = Category::orderBy('updated_at', 'DESC')->get();
        return view('admin.categories.index', compact('categories'));
    }


    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create()
    {
        $parentCategories =  parentCategory::all();
        return view ('admin.categories.create', compact('parentCategories'));
    }


    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store(Request $request)
    {
        $category_data = array();
        if (!$request->data || !$request->attribute) {
            return back()->withStatus('Please enter category type or attribute.')->withInput();
        }
        foreach ($request->data as $key => $data) {
            if ( isset($request->attribute[$key]) && count($request->attribute[$key]) > 0) {
                $attr_array = [];
                for($i = 0; $i < count($request->attribute[$key]); $i++){
                    array_push($attr_array, array(
                        'attribute' => $request->attribute[$key][$i],
                        'type' => $request->attribute_type[$key][$i],
                    ));
                }
                array_push($category_data,[ ['name' => $data[0]] , $attr_array]);
            }
        }
        $category = Category::create([
            'name' => $request->name,
            'data' => json_encode($category_data),
            'sku_initial' => $request->sku_initial,
            'parent_category_id' => $request->parent_category,
        ]);

        $category_id = $category->id;

        $categories_seo = CategoriesSeo::create([
            "category_id"=>$category_id,
            "focus_keyword"=>$request->focus_keywords,
            "lsi_keyword"=>$request->lsi_keywords,
            "content_section"=>$request->content_sections,
            "title_tag"=>$request->title_tag,
            "meta_description_tag"=>$request->meta_description_tag,
            "heading_tag"=>$request->h1_tag
        ]);

        return back()->withStatus('Category Added Successfully');

    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Category  $category
    * @return \Illuminate\Http\Response
    */
    public function show(Category $category)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Category  $category
    * @return \Illuminate\Http\Response
    */
    public function edit(Category $category)
    {
        $parentCategories =  parentCategory::all();
        $categories_seo = CategoriesSeo::where('category_id',$category->id)->get();
        return view('admin.categories.edit', compact('category','parentCategories','categories_seo'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Category  $category
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Category $category)
    {
         $category_id=$category->id;
        $category_image = new Category();
        $category_image = Category::findOrFail($category_id);


     
        $category_data = array();
         if ($request->hasFile('category_image')) {
            $file = $request->file('category_image');
            $timestamp = date('Ymdhis');
            $name = $timestamp . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/public/sliderimg/', $name);
            //Image::make(public_path().'/public/sliderimg/'.$name)->resize(1159, 398)->save(public_path().'/public/sliderimg/'.$name, 99);
            $category_image->category_image = $name;
                if (file_exists(public_path() . '/public/sliderimg/' . $request->category_image)) {
                unlink(public_path() . '/public/sliderimg/' . $request->category_image);
                }else{
              $category_image->category_image = $name;

                }
          }
                  $category_image->update();


        
        foreach ($request->data as $key => $data) {
            if ( isset($request->attribute[$key]) && count($request->attribute[$key]) > 0) {
                $attr_array = [];
                for($i = 0; $i < count($request->attribute[$key]); $i++){
                    array_push($attr_array, array(
                        'attribute' => $request->attribute[$key][$i],
                        'type' => $request->attribute_type[$key][$i],
                    ));
                }
                array_push($category_data,[ ['name' => $data[0]] , $attr_array]);
            }
        }

        $name = $category->name;

        $category->name = $request->name;
        $category->sku_initial = $request->sku_initial;
        $category->parent_category_id = $request->parent_category;
        $category->data = json_encode($category_data);
        $category->updated_at = Carbon::now()->toDateTimeString();
        $category->save();


    

        

        $category_id = $category->id;

        $products = Product::where('category',$name)->get();

        foreach($products as $product)
        {
            $product->category = $request->name;
            $product->save();               
        }

        if($request->categories_seo_id != '')
        {
            $categories_seo = CategoriesSeo::where('id',$request->categories_seo_id)->update([
                "category_id"=>$category_id,
                "focus_keyword"=>$request->focus_keywords,
                "lsi_keyword"=>$request->lsi_keywords,
                "content_section"=>$request->content_sections,
                "title_tag"=>$request->title_tag,
                "meta_description_tag"=>$request->meta_description_tag,
                "heading_tag"=>$request->h1_tag
            ]);
        }
        else
        {
            $categories_seo = CategoriesSeo::create([
            "category_id"=>$category_id,
            "focus_keyword"=>$request->focus_keywords,
            "lsi_keyword"=>$request->lsi_keywords,
            "content_section"=>$request->content_sections,
            "title_tag"=>$request->title_tag,
            "meta_description_tag"=>$request->meta_description_tag,
            "heading_tag"=>$request->h1_tag
        ]);
        }

        return redirect()->route('admin.category.index')
            ->withStatus('Category Update Successfully');
    
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Category  $category
    * @return \Illuminate\Http\Response
    */
    public function destroy(Category $category)
    {   

        $products = Product::where('category', $category->name)->get();
        $ids =Product::where('category', $category->name)->pluck('id')->toArray();
        
        if (count($products)) {
            Product::where('category', $category->name)->update([
                'category' => null
            ]);
            //remove from algolia search
            Product::where('category', $category->name)->unsearchable();

            if ($category->delete()) {
                return response()->json(true);
            } else {
                //rollback, delete failed
                Product::whereIn('id', $ids)->update([
                    'category' => $category->name
                ]);

                Product::where('category', $category->name)->searchable();

            }
        } else {
            //category doesn't have any products, just delete it
            if ($category->delete()) {
                return response()->json(true);
            }
        }
        
        return response()->json(false);
    }

    public function parentCategoryIndex()
    {
        return view ('admin.categories.parent');
    }
}
