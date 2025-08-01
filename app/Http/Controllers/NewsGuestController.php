<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsGuestController extends Controller
{
    public function index(Request $request)
    {
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
            ->paginate(8, ['*'], 'news_page');

        return view('guestviews.news.index',[
            'news' => $news
        ]);
    }

    public function show($id)
    {
        $news = DB::table('news')->find($id);

        if (!$news) {
            abort(404);
        }

        return view('guestviews.news.show', [
            'news' => $news
        ]);
    }
}
