<?php

namespace Microboard\Http\Controllers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Microboard\Http\Requests\Media\StoreFormRequest;

class MediaLibraryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFormRequest $request
     * @param Filesystem $files
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreFormRequest $request, Filesystem $files)
    {
        $path = storage_path('tmp');

        if (! $files->isDirectory($path)) {
            $files->makeDirectory($path, 0777, true);
        }

        $file = $request->file('file');

        $file->move($path, $name = uniqid() . '_' . trim($file->getClientOriginalName()));

        return response()->json([
            'name' => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     */
    public function destroy(Request $request, Filesystem $files)
    {
        if ($request->has('name') && $files->exists($path = storage_path("tmp/{$request->input('name')}"))) {
            $files->delete($path);
        }

        return response('DONE');
    }
}
