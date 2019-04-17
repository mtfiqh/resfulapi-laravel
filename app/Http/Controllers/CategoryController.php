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
            return response([
                'msg' => 'Gagal menyimpan category baru di database'
            ],500);
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
        $category = \App\Category::find($id);
        if(!$category){

            return response([
                'msg' => 'Category tidak ditemukan'
            ],404);
        }

        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // find the id
        $category = \App\Category::find($id);
        if(!$category){

            return response([
                'msg' => 'Category tidak ditemukan'
            ],404);
        }
        
        // validate the request
        $this->validating($request);

        // set value to update
        $category->name = $request->name;
        $category->enable = (isset($request->enable) ? $request->enable : true);

        // save update
        if($category->save()){
            // return json
            return response(new CategoryResource($category),201);
        }else{
            return response([
                'msg' => "Category gagal di update",
                'data' => new CategoryResource($category),
            ],500);        
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category = \App\Category::find($id);

        if(!$category){
            return response([
                'msg' => "category tidak dapat ditemukan",
            ],404);
        }

        if($category->delete()){
            return response([
                'msg'=>"Category berhasil di hapus",
                'data' => new CategoryResource($category),
            ],200);
        }else{
            return response([
                'msg' => "category gagal di hapus",
                'data' => new CategoryResource($category),
            ],500);
        }
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
