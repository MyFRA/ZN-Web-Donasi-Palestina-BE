<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\News\StoreRequest;
use App\Http\Requests\Panel\News\UpdateRequest;
use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $data = [
            'news' => News::orderBy('created_at', 'desc')->paginate(10),
        ];

        return view('panel.pages.news.index', $data);
    }

    public function create()
    {
        return view('panel.pages.news.create');
    }

    public function store(StoreRequest $request)
    {
        News::create([
            'slug' => Str::slug($request->title),
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'content' => $request->content,
        ]);

        return redirect('/panel/news')->with('success', 'Berita telah ditambahkan');
    }

    public function edit($id)
    {
        $data = [
            'news' => News::find($id)
        ];

        return view('panel.pages.news.edit', $data);
    }

    public function update(UpdateRequest $request, $id)
    {
        $news = News::find($id);

        $news->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'content' => $request->content,
        ]);

        return redirect('/panel/news')->with('success', 'Berita telah diupdate');
    }

    public function destroy($id)
    {
        News::destroy($id);

        return back()->with('success', 'Berita telah dihapus');
    }
}
