<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

// resource
use \App\Http\Resources\Category as CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //display 5 per page
        $categories = \App\Category::paginate(5);

        return new CategoryResource($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * 
     * use CategoryResource for the response
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate new category
        $this->validating($request);

        $category = new \App\Category;
        $category->name = $request->name;
        $category->enable = (isset($request->enable) ? $request->enable : true);
        
        if($category->save()){
            return new CategoryResource($category);
        }else{
            return response()->json([
                'msg' => 'Failed to store in database',
            ],503);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $category = \App\Category::findOrFail($id);

        return new CategoryResource($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }

    /**
     * validate function untuk category
     * @param Request $request
     * 
     */
    private function validating(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
    }
}
