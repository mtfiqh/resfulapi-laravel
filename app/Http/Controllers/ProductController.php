<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
// resource
use \App\Http\Resources\Product as ProductResource;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\Product 
     */
    public function index()
    {
        //display 5 per page
        $products = \App\Product::paginate(5);
        // dd($products);
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\Product 
     */
    public function store(Request $request)
    {
        // validatiing request
        $this->validating($request);

        /**
         * save product to db first
         * 
         */
        $product = new \App\Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->enable = $request->has('enable') ? $request->enable : true;
        $product->save();

        // mengasumsikan category menggunakan select ajax search (jadi category sudah pasti ada).
        if($request->has('categories')){
            $product->categories()->sync($request->categories);
        }

        // check jika ada file images yang dikirim
        if($request->hasFile('images')){
            /**
             * Jika ada file image
             * save setiap data file image ke storage dan DB
             * lalu attach hubungan antara images dan product di table pivot nya
             */
            foreach($request->images as $image){
                $name = $image->getClientOriginalName();
                $path = $image->store('photos');

                $uploadImg = new \App\Image;
                $uploadImg->name=$name;
                $uploadImg->file=$path;
                $uploadImg->enable=true;
                $uploadImg->save();
                $product->images()->attach($uploadImg);
            }

        }

        /**
         * Jika photo dipilih berdasarkan ID dari database Images,
         * Untuk di sync dengan product
         * pada table pivot image_product
         */
        if($request->has('imagesId')){
            $product->images()->attach($request->imagesId);
        }
        
        if($product->save()){
            return new ProductResource($product);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \App\Http\Resources\Product 
     */
    public function show($id)
    {
        $product = \App\Product::findOrFail($id);

        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    private function validating(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'images.*' => 'image'
        ]);
    }
}
