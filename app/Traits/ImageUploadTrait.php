<?php

namespace App\Traits;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

trait ImageUploadTrait
{

    public function uploadSingle(UploadedFile $uploadedFile, $folder = null, $filename = null, $disk = 'local')
     {
         $name = $filename ?? Str::random(25). '.'. $uploadedFile->getClientOriginalExtension();
         $options = [
             'visibility' => 'public'
         ];
         $file = Storage::putFileAs($folder, $uploadedFile, $name, $options);
         return $file;
     }


     public function uploadMutiple(UploadedFile $uploadedFile, $folder = null, $filename = null, $disk = 'local')
     {
         $name = $filename ?? Str::random(25). '.'. $uploadedFile->getClientOriginalExtension();
         $options = [
             'visibility' => 'public'
         ];
         $file = Storage::putFileAs($folder, $uploadedFile, $name, $options);
         return $file;
     }


    



    public function UploadImage(Request $request){

        //validating the image
        // $this->validate($request, [
        //     'image' => ['required', 'image', 'max:1024', 'mimes:jpeg,png,jpg,gif']
        // ]);

        //save the image
        //check if the request has a file

        //dd($request->file('images'));

        if($request->hasFile('image')){
            $image = $request->file('image');
            $new_name = rand() . '.' .$image->getClientOriginalExtension();
            $image->move(public_path('/uploads/profileimages'),$new_name);

            dd($new_name);
            return $new_name;

        }else{
            return response()->json('Image is empty');
        }

    }


//function for multiple images upload
    public function multipleUploads(Request $request){
         //validating the image
        //  $this->validate($request, [
        //     'images' => ['required', 'image',  'mimes:jpeg,png,jpg,gif']
        // ]);


        //$imagez = [];
        $imageName = '';

        if($request->hasFile('images')){
            $images = $request->file('images');
            // dd($images);
            foreach($images as $image){
                $new_names = rand(). '.' .$image->getClientOriginalExtension() ;
                $image->move(public_path('/uploads/images'),$new_names);
                $new_names = Storage::url($new_names);
                $imageName=$imageName.$new_names. " ,"; 
            }
            $imagedb=$imageName;

            // Storage::url($imagedb);
            return $imagedb;
        } else{
                return response()->json('images is null');
            }


       // $name = '';

        // if($request->hasFile('images')){
        //     $images = $request->file('images');

        //     //loop through the array
        //     foreach ($images as $image) {
        //         $images = $request->input('image');
        //         $new_name = rand(). '.' . $image->getClientOriginalExtension();
        //         $image->move(public_path('/uploads/images'),$new_name);

        //         $imageName = $name.$new_name;

        //         return $imageName;
        //     }


        // }else{
        //     return response()->json('Image is empty');
        // }

    }

    
}

