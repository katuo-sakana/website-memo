<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Page;
use App\Tag;

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
        return view('page_list', compact('pages'));
    }

    public function tagsList($tag_name)
    {
        $user_id = Auth::id();
        $pages = Page::where('user_id', $user_id)->whereTag($tag_name)->get();
        return view('page_list', compact('pages', 'tag_name'));
    }

    public function create()
    {
        // タグ情報自動保管のためにタグ情報を全取得
        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('page_register', compact('allTagNames'));
    }

    public function store(Request $request, Page $page)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'site_image' => [
                // アップロードされたファイルであること
                'file',
                // 画像ファイルであること
                'image',
                // MIMEタイプを指定
                'mimes:jpeg,png',
            ],
            'tags' => 'json|regex:/^(?!.*\s).+$/u|regex:/^(?!.*\/).*$/u',
        ]);

        $file_name = '';
        if (isset($request->site_image)) {
            $image_path = $request->site_image->store('public');
            $file_name = basename($image_path); // 「public/」を削除して画像名だけを残す
        }

        $user_id = Auth::id();
        $page->title = $request->title;
        $page->site_url = $request->site_url;
        $page->site_image = $file_name;
        $page->comment = $request->comment;
        $page->user_id = $user_id;
        $page->save();

        $tags = collect(json_decode($request->tags))
            ->slice(0, 5) // コレクションの要素が6個以上あったとしても、最初の5個だけが残る
            ->map(function ($requestTag) {
                return $requestTag->text; // key(text)だけの形に変換する。
            });
        $tags->each(function ($tagName) use ($page) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $page->tags()->attach($tag); // page_tagテーブルへのレコードの保存
        });

        return redirect()->route('page_show', ['pageid' => $page->id]);
    }

    public function show($pageid)
    {
        $page = Page::find($pageid);

        // タグ情報取得
        $tagNames = $page->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });
        $user_id = Auth::id();
        // 同じタグが設定してある記事一覧を取得
        $relationTagpages = Page::where('user_id', $user_id)->whereTagPage($tagNames)->get();

        return view('page_show', compact('page', 'relationTagpages'));
    }

    public function edit($pageid)
    {
        $page = Page::find($pageid);

        // タグ情報取得
        $tagNames = $page->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });

        // タグ情報自動補完のためにタグ情報を全取得
        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('page_register', compact('page', 'tagNames', 'allTagNames'));
    }

    public function update(Request $request, $pageid)
    {
        $page = Page::find($pageid);

        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'site_image' => [
                // アップロードされたファイルであること
                'file',
                // 画像ファイルであること
                'image',
                // MIMEタイプを指定
                'mimes:jpeg,png',
            ],
            'tags' => 'json|regex:/^(?!.*\s).+$/u|regex:/^(?!.*\/).*$/u',
        ]);

        if (isset($request->site_image)) {
            $image_path = $request->site_image->store('public');
            $file_name = basename($image_path); // 「public/」を削除して画像名だけを残す
            $page->site_image = $file_name;
        }

        $page->title = $request->title;
        $page->site_url = $request->site_url;
        $page->comment = $request->comment;
        $page->save();

        $page->tags()->detach();
        $tags = collect(json_decode($request->tags))
            ->slice(0, 5) // コレクションの要素が6個以上あったとしても、最初の5個だけが残る
            ->map(function ($requestTag) {
                return $requestTag->text; // key(text)だけの形に変換する。
            });
        $tags->each(function ($tagName) use ($page) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $page->tags()->attach($tag);
        });

        return redirect()->route('page_show', ['pageid' => $page->id]);
    }
}
