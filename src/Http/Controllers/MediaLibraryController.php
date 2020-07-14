<?php

namespace Microboard\Http\Controllers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Microboard\Http\Requests\Media\StoreFormRequest;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaLibraryController extends Controller
{
    /**
     * @param StoreFormRequest $request
     * @param Filesystem $files
     * @return JsonResponse
     */
    public function upload(StoreFormRequest $request, Filesystem $files)
    {
        $path = storage_path('tmp');

        if (!$files->isDirectory($path)) {
            $files->makeDirectory($path, 0777, true);
        }

        $file = $request->file('file');

        $file->move($path, $name = uniqid() . '_' . trim($file->getClientOriginalName()));

        return response()->json([
            'name' => $name,
            'original_name' => $file->getClientOriginalName(),
        ], 201);
    }

    /**
     * @param StoreFormRequest $request
     * @return JsonResponse
     */
    public function store(StoreFormRequest $request)
    {
        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $image = Image::make($file)->stream('jpg', 80);

        Storage::disk(config('media-library.disk_name'))->put("editor/{$name}", $image);

        return response()->json([
            'url' => asset("storage/editor/{$name}"),
            'name' => $name
        ], 201);
    }

    /**
     * @param Request $request
     * @param Filesystem $files
     * @return Response
     */
    public function delete(Request $request, Filesystem $files)
    {
        if ($request->has('name')) {
            $path = '';

            if ($files->exists($tmp = storage_path("tmp/{$request->input('name')}"))) {
                $path = $tmp;
            }

            elseif ($files->exists($editor = storage_path("app/public/editor/{$request->input('name')}"))) {
                $path = $editor;
            }

            elseif ($media = Media::where('file_name', $request->input('name'))->first()) {
                $path = $media->getPath();
                $media->delete();
            }

            if ($path) {
                $files->delete($path);
            }

            return response('resource deleted successfully', 201);
        }

        return response('Not exists', 500);
    }
}
