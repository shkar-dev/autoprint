<?php

namespace App\Http\Controllers;

use App\Jobs\PrintCardJob;
use App\Jobs\PrintImageJob;
use App\Models\c;
use App\Http\Controllers\Controller;
use App\Models\UploadedImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AutoPrintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|array|image|mimes:jpeg,png,jpg',
        ]);
//        $path = $request->file('image')->store('uploads', 'public');

        // Get the uploaded file
        $image = $request->file('image');

        // Generate a unique filename for the uploaded image
        $filename = time() . '.'.  explode('/', $image->getMimeType())[1];

        // Move the image to the public/images.blade.php folder

        $uploadImage = UploadedImage::create([
            'name' => $filename,
            'user_session_id' => session()->getId(),
        ]);

        if ($uploadImage) {
            $image->move(public_path(), $filename);
            dispatch(new PrintImageJob( $filename));
            return back()->with('success', 'Image uploaded successfully! It will be printed in 10 seconds.');
        }
         return back()->with('failed', 'error while uploading image!');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function index()
    {
        $data = UploadedImage::where('user_session_id', session()->getId())->get();
        return view('index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function uploadMultipleImage(Request $request)
    {

        $request->validate([
            'image' => 'required|array',
            'image.*' => 'image|mimes:jpeg,png,jpg',
            'choice'=>'required'
        ]);

//        $path = $request->file('image')->store('uploads', 'public');
          if ($request->choice == 'document'){
            foreach ($request->file('image') as $image) {
                  $filename = time(). ''.rand(0,100) . '.'. explode('.', $image->getClientOriginalName())[1];
                 $uploadImage = UploadedImage::create([
                    'name' => $filename,
                    'user_session_id' => session()->getId(),
                ]);
                if ($uploadImage) {
                    $image->move(public_path(), $filename);
                    dispatch(new PrintImageJob( $filename));
                }
            }
            return back()->with('success', 'Image uploaded successfully! It will be printed in 10 seconds.');
        }else{
              $filenames=[];
              foreach ($request->file('image') as $image) {
                  $filename = time(). ''.rand(0,100) . '.'. explode('.', $image->getClientOriginalName())[1];
                  $uploadImage = UploadedImage::create([
                      'name' => $filename,
                      'user_session_id' => session()->getId(),
                  ]);
                  if ($uploadImage) {
                      $image->move(public_path(), $filename);
                  }
                 $filenames[] = $filename;
              }
              dispatch(new PrintCardJob($filenames[0],$filenames[1]));
              return back()->with('success', 'Image uploaded successfully! It will be printed in 10 seconds.');

        }







        return back()->with('failed', 'error while uploading image!');
    }

    /**
     * Display the specified resource.
     */
    public function show(c $c)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(c $c)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, c $c)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(c $c)
    {
        //
    }
}
