<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use \App\Http\Resources\Image as ImageResource;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = \App\Image::paginate(5);
        // dd($products);
        return new ImageResource($images);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validating
        $this->validating($request);

        $imageNew = new \App\Image;
        $name = $request->image->getClientOriginalName();
        $path = $request->image->store('photos');

        $imageNew->name = $request->name ? $request->name : $name;
        $imageNew->file = $path;
        $imageNew->enable = $request->enable ? $request->enable : true;

        if($imageNew->save()){
            return new ImageResource($imageNew);
        }else{
            return response([
                'msg' => 'Failed to store image',
            ],403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $image = Image::find($id);
        if(!$image){
            return response([
                'msg' => "Image not found",
            ],404);
        }

        return new ImageResource($image);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $image = Image::find($id);
        if(!$image){
            return response([
                'msg' => 'Image not found',
            ], 404);
        }

        $this->validating($request);
        $name = $image->name;
        /**
         * check apakah ada file image
         * jika tidak, maka tidak akan mengubah file
         */
        if($request->hasFile('image')){
            Storage::delete($image->file);
            $name = $request->image->getClientOriginalName();
            $path = $request->image->store('photos');
            $image->file = $path;
        }
        
        $image->name = $request->name ? $request->name : $image->name;
        $image->enable = $request->enable ? $request->enable : true;

        if($image->save()){
            return new ImageResource($image);
        }else{
            return response([
                'msg' => 'some error',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }

    private function validating(Request $request){
        $this->validate($request, [
            'image' => 'image'
        ]);
    }
}
