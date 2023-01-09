<?php

namespace App\Http\Controllers;

use App\parentCategory;
use Illuminate\Http\Request;

class ParentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.parent');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = parentCategory::create($request->only('name'));

        if ($category) {
            return response()->json([
                'status' => true
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\parentCategory  $parentCategory
     * @return \Illuminate\Http\Response
     */
    public function show(parentCategory $parentCategory)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\parentCategory  $parentCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(parentCategory $parentCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\parentCategory  $parentCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, parentCategory $parentCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\parentCategory  $parentCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(parentCategory $parentCategory)
    {
        $status = true;

        if ($parentCategory->subCategories->count()) {
            $status = $parentCategory->subCategories()->update(['parent_category_id' => null]);
        }

        if ($status) {
            if ($parentCategory->delete()) {
                return response()->json([
                    'status'=> true
                ]);
            }

            return response()->json([
                'status'=> false,
                'message' => 'Cant delete category'
            ]);
        }

        return response()->json([
            'status'=> false
        ]);
    }

    public function datatableIndex()
    {
        $data = array();
        foreach (parentCategory::with('subCategories')->get() as $key => $category) {
            array_push($data, array(
                '',
                $category->name,
                $category->subCategories->count(),
                "
                <a href='javascript:;' class='table-action-btn h3 delete' title='Delete' id='$category->id'>
                    <i class='fa fa-trash text-danger'></i>
                </a>
                ",
            ));
        }

        return response()->json([
            'data' => $data
        ]);
    }
}
