<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Article;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Container\Container|mixed|object
     */
    public function index(SearchRequest $request)
    {
        $search = $request->input('search_text');

        $articles = Article::when($search, function ($query, $search) {
            return $query->where('title', 'like', '%'.$search.'%')
                ->orWhere('content', 'like', '%'.$search.'%');
        })
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        if ($request->ajax()) {
            return view('partials.articles-table', compact('articles'))->render();
        }

        return view('home', compact('articles'));
    }
}
