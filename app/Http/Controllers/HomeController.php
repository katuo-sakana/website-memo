<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PagePostRequest;
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
        $pages = $pages->sortByDesc('created_at')->values()->all(); // 降順にソート
        return view('page_list', compact('pages'));
    }

    public function tagsList($tag_name)
    {
        $user_id = Auth::id();
        $pages = Page::where('user_id', $user_id)->whereTag($tag_name)->get();
        $pages = $pages->sortByDesc('created_at')->values()->all(); // 降順にソート
        return view('page_list', compact('pages', 'tag_name'));
    }

    public function create()
    {
        $user_id = Auth::id();
        // タグ情報自動補完のためにログインしているユーザーのタグ報を全取得
        $allTagNames = Tag::where('user_id', $user_id)->get()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('page_register', compact('allTagNames'));
    }

    public function store(PagePostRequest $request, Page $page)
    {
        $user_id = Auth::id();
        $this->upsert($request, $page); // storeとupdateの共通処理関数（返り値：$page->save後の$page）

        $tags = collect(json_decode($request->tags))
            ->slice(0, 5) // コレクションの要素が6個以上あったとしても、最初の5個だけが残る
            ->map(function ($requestTag) {
                return $requestTag->text; // key(text)だけの形に変換する。
            });
        $tags->each(function ($tagName) use ($page, $user_id) {
            $tag = Tag::firstOrCreate(['name' => $tagName, 'user_id' => $user_id]);
            $page->tags()->attach($tag); // page_tagテーブルへのレコードの保存
        });

        return redirect()->route('page_show', ['pageid' => $page->id]);
    }

    public function show($pageid)
    {
        $user_id = Auth::id();
        $page = Page::find($pageid);

        // タグ情報取得
        $tagNames = $page->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });
        // 同じタグが設定してある記事一覧を取得
        $relationTagpages = Page::where('user_id', $user_id)->whereTagPage($tagNames)->get();

        return view('page_show', compact('page', 'relationTagpages'));
    }

    public function edit($pageid)
    {
        $user_id = Auth::id();
        $page = Page::find($pageid);

        // タグ情報取得
        $tagNames = $page->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });

        // タグ情報自動補完のためにログインしているユーザーのタグ報を全取得
        $allTagNames = Tag::where('user_id', $user_id)->get()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('page_register', compact('page', 'tagNames', 'allTagNames'));
    }

    public function update(PagePostRequest $request, $pageid)
    {
        $user_id = Auth::id();
        $page = Page::find($pageid);

        $this->upsert($request, $page); // storeとupdateの共通処理関数（返り値：$page->save後の$page）

        $page->tags()->detach();
        $tags = collect(json_decode($request->tags))
            ->slice(0, 5) // コレクションの要素が6個以上あったとしても、最初の5個だけが残る
            ->map(function ($requestTag) {
                return $requestTag->text; // key(text)だけの形に変換する。
            });
        $tags->each(function ($tagName) use ($page, $user_id) {
            $tag = Tag::firstOrCreate(['name' => $tagName, 'user_id' => $user_id]);
            $page->tags()->attach($tag);
        });

        return redirect()->route('page_show', ['pageid' => $page->id]);
    }

    public function upsert($request, $page)
    {
        $file_name = null;
        $user_id = Auth::id();

        if (isset($request->site_image)) {
            $image_path = $request->site_image->store('public');
            $file_name = basename($image_path); // 「public/」を削除して画像名だけを残す
            $page->site_image = $file_name;
        }

        $page->title = $request->title;
        $page->site_url = $request->site_url;
        $page->comment = $request->comment;
        $page->user_id = $user_id;
        $page->save();

        return $page;
    }

    public function delete($pageid)
    {
        Page::destroy($pageid);

        return redirect()->route('home');
    }
}
