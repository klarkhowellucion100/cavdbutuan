<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $news = News::orderBy("published_at","desc")->paginate(10);
        $search = $request->input('search');

        $newsListQuery = DB::table('news as a');

        if ($search) {
            $newsListQuery->where(function ($query) use ($search) {
                $query->where('a.title', 'like', '%' . $search . '%')
                    ->orWhere('a.content', 'like', '%' . $search . '%');
            });
        }

        $news = $newsListQuery
            ->select('a.*')
            ->orderBy('a.published_at', 'desc')
            ->paginate(10, ['*'], 'news_page');

        return view('userviews.news.index',[
            'news' => $news
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('userviews.news.create');
    }

   public function store(Request $request){
         $data = $request->validate([
            'title' => ['required'],
            'published_at' => ['required'],
            'content' => ['required'],
            'image' => ['required', File::types(['png', 'jpg', 'webp', 'pdf'])->max(200048)],
        ]);

        $data['user_id'] = Auth::id();
        $data['code'] = Str::uuid();

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadNewsImage($request->file('image'));
        } else {
            $data['image'] = null; // Set to null if no file is uploaded
        }

        $record = News::create($data);

        return redirect()->route(
            'news.user.create'
        )->with('success', 'News successfully published!');
    }

     public function uploadNewsImage($file)
    {
        if (!$file) {
            return null; // Handle case when no file is provided
        }

        $extension = $file->getClientOriginalExtension();
        $filename = time() . '_' . uniqid() . '.' . $extension;

        if ($extension === 'pdf') {
            $path = $file->storeAs('news_pdfs', $filename, 'public');
        } else {
            $path = $file->storeAs('news', $filename, 'public');
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
            $records = DB::table('news')->whereIn('id', $ids)->get();

            foreach ($records as $record) {
                if ($record->image) {
                    $filePath = storage_path('app/public/' . $record->image);
                    if (file_exists($filePath)) {
                        unlink($filePath); // Direct file deletion
                    }
                }
            }

            DB::table('news')->whereIn('id', $ids)->delete();
        }

        return redirect()->back()->with('success', 'Selected news and their files deleted successfully.');
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('userviews.news.edit', [
            'news' => $news
        ]);
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $data = $request->validate([
            'title' => ['required'],
            'published_at' => ['required'],
            'content' => ['required']
        ]);

        $news->update($data);

        return redirect()->back()->with('success', 'News successfully updated!');
    }

    public function editpic($id)
    {
        $news = News::findOrFail($id);
        return view('userviews.news.editpic', [
            'news' => $news
        ]);
    }

    public function updatepic(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $data = $request->validate([
            'image' => ['required', File::types(['png', 'jpg', 'webp', 'pdf'])->max(2000)], // 2000 KB = ~2MB
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($news->image && Storage::disk('public')->exists($news->image)) {
                Storage::disk('public')->delete($news->image);
            }

            // Upload new image
            $data['image'] = $this->uploadUpdatedNewsImage($request->file('image'));
        }

        $news->update($data);

        return redirect()->back()->with('success', 'News image successfully updated!');
    }

    public function uploadUpdatedNewsImage($file)
    {
        if (!$file) {
            return null;
        }

        $extension = $file->getClientOriginalExtension();
        $filename = time() . '_' . uniqid() . '.' . $extension;

        $folder = $extension === 'pdf' ? 'news_pdfs' : 'news';

        $path = $file->storeAs($folder, $filename, 'public');

        if (!$path) {
            throw new \Exception('Failed to store the file.');
        }

        return $path; // e.g., news/filename.jpg
    }

}
