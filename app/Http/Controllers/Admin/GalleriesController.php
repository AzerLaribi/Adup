<?php

namespace App\Http\Controllers\Admin;

use App\Gallery;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyGalleryRequest;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GalleriesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    { $user = \Auth::user();
        $roleuser=$user->roles->first()->title;
        abort_if(Gate::denies('gallery_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $galleries = Gallery::all();

        return view('admin.galleries.index', compact('galleries','roleuser'));
    }

    public function create()
    {
        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;
        abort_if(Gate::denies('gallery_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.galleries.create',compact('roleuser'));
    }

    public function store(StoreGalleryRequest $request)
    {
        $gallery = Gallery::create($request->all());

        foreach ($request->input('photos', []) as $file) {
            $gallery->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photos');
        }

        return redirect()->route('admin.galleries.index');
    }

    public function edit(Gallery $gallery)
    {
        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;
        abort_if(Gate::denies('gallery_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.galleries.edit', compact('gallery','roleuser'));
    }

    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        $gallery->update($request->all());

        if (count($gallery->photos) > 0) {
            foreach ($gallery->photos as $media) {
                if (!in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }

        $media = $gallery->photos->pluck('file_name')->toArray();

        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $gallery->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('photos');
            }
        }

        return redirect()->route('admin.galleries.index');
    }

    public function show(Gallery $gallery)
    {
        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;
        abort_if(Gate::denies('gallery_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.galleries.show', compact('gallery','roleuser'));
    }

    public function destroy(Gallery $gallery)
    {
        
        abort_if(Gate::denies('gallery_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gallery->delete();

        return back();
    }

    public function massDestroy(MassDestroyGalleryRequest $request)
    {
        Gallery::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
