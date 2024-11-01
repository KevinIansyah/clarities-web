<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\PageView;
use App\Models\Pelatihan;
use Illuminate\Http\Request;

class FrontBlogController extends Controller
{
    function index()
    {
        $pageView = PageView::first();
        if (!$pageView) {
            $pageView = PageView::create(['views' => 0]);
        }
        $pageView->increment('views');

        $banner_blogs = Blog::where('status', 'active')->orderBy('id', 'desc')->limit(5)->get();
        $blogs = Blog::where('status', 'active')->orderBy('created_at', 'desc')->paginate(12);
        $pelatihan = Pelatihan::where('highlight', 'active')->first();

        return view('index', compact('banner_blogs', 'blogs', 'pelatihan', 'pageView'));
    }

    function search(Request $request)
    {
        $blogs = Blog::where('status', 'active')->orderBy('created_at', 'desc');

        if ($request->search) {
            $blogs->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->tag) {
            $blogs->where('tag', 'like', '%' . $request->tag . '%');
        }

        $blogs = $blogs->paginate(12);

        return view('blog.search', compact('blogs'));
    }

    function show($slug)
    {
        $latestBlogs = Blog::where('status', 'active')->orderBy('id', 'desc')->limit(5)->get();
        $blog = Blog::with('user')->where('slug', $slug)->firstOrFail();

        $blog->increment('view');

        return view('blog.index', compact('blog', 'latestBlogs'));
    }
}
