<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;

/**
 * Class LibraryController
 * @package App\Http\Controllers
 */
class LibraryController extends Controller
{
    /**
     * LibraryController constructor.
     */
    public function __construct()
    {

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $imageService = \App::make(\App\Services\ImageService::class);
        $images = $imageService->getAll();

        return view('library', ['images' => $images]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newImage()
    {
        return view('newImage');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function uploadImage(Request $request)
    {
        $image = $request->file('image');

        $request->validate([
            'image' => 'required',
            'caption' => 'required',
            'description' => 'required',
            'alternative' => 'required',
        ]);

        // Generating thumbnail
        $imageThumb = Image::make($image->getRealPath());
        $imageMime = $imageThumb->mime();

        $imageThumb->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        });
        $imageThumbName = 'thumb_200x200_'.$image->getClientOriginalName();
        $imageThumbTempPath = storage_path().'/'.$imageThumbName;
        $imageThumb->save($imageThumbTempPath);

        // Uploading image and thumb to AWS
        $s3 = \Storage::disk('s3');
        $s3->put($imageThumbName, file_get_contents($imageThumbTempPath));
        unlink($imageThumbTempPath);
        $s3->put($image->getClientOriginalName(), file_get_contents($image));

        // Creating record in database
        $imageService = \App::make(\App\Services\ImageService::class);
        $imageService->save(array_merge($request->all(),[
            'name' => $image->getClientOriginalName(),
            'mime' => $imageMime,
            ]));

        return redirect('/');
    }
}
