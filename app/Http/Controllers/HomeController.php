<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Page;

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::id();
        $pages = Page::where('user_id', $user_id)->get();
        return view('home', compact('pages'));
    }

    public function create()
    {
        return view('page_register');
    }

    public function store(Request $request, Page $page)
    {
        $user_id = Auth::id();
        $page->title = $request->title;
        $page->site_url = $request->site_url;
        $page->comment = $request->comment;
        $page->user_id = $user_id;
        $page->save();
        return redirect()->route('home');
    }

    public function show($pageid)
    {
        $page = Page::find($pageid);
        return view('page_show', compact('page'));
    }
}
