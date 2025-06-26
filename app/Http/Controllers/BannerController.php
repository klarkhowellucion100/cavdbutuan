<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\File;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::orderBy('created_at','desc')->paginate(10);

        return view('userviews.banners.index', [
            'banners' => $banners
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('userviews.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $bannerUpload = $request->validate([
            'banner_picture' => ['nullable', File::types(['png', 'jpg', 'webp', 'pdf'])->max(200048)],
        ]);

        if ($request->hasFile('banner_picture')) {
            $bannerUpload['banner_picture'] = $this->uploadBanner($request->file('banner_picture'));
        } else {
            $bannerUpload['banner_picture'] = null; // Set to null if no file is uploaded
        }

        Banner::create($bannerUpload);
        return redirect()->back()->with('success', 'Banner uploaded successfully!');
    }

    public function uploadBanner($file)
    {
        if (!$file) {
            return null; // Handle case when no file is provided
        }

        $extension = $file->getClientOriginalExtension();
        $filename = time() . '_' . uniqid() . '.' . $extension;

        if ($extension === 'pdf') {
            $path = $file->storeAs('banner_pdfs', $filename, 'public');
        } else {
            $path = $file->storeAs('banner', $filename, 'public');
        }

        if (!$path) {
            throw new \Exception('Failed to store the file.');
        }

        return $path;
    }

    public function bulkdelete(Request $request)
    {
         $ids = $request->input('selected_ids');

        if ($ids) {
            $records = DB::table('banners')->whereIn('id', $ids)->get();

            foreach ($records as $record) {
                if ($record->banner_picture) {
                    $filePath = storage_path('app/public/' . $record->banner_picture);
                    if (file_exists($filePath)) {
                        unlink($filePath); // Direct file deletion
                    }
                }
            }

            DB::table('banners')->whereIn('id', $ids)->delete();
        }

        return redirect()->back()->with('success', 'Selected records and their files deleted successfully.');
    }
    public function view($id)
    {
        $banner = Banner::findOrFail($id);
        return view('userviews.banners.view', [
            'banner' => $banner
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        //
    }
}
