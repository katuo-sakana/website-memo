@extends('layouts.app')

@section('content')
  <div class="width-base">
    <div class="card">
      <div class="card-body">
        <div class="page-navigation">
          <a class="btn btn-primary page-navigation__item" href="{{ route('home') }}">一覧へ戻る</a>
          <a class="btn btn-primary page-navigation__item" href="{{ route('page_edit', [$page->id]) }}">編集する</a>
          <a class="btn btn-primary page-navigation__item" href="{{ route('page_register') }}">新規ページをメモする</a>
        </div>
        <div class="show-content">
          <div class="show-content__primary">
            <h1>{{ $page->title }}</h1>
            @if (!empty($page->site_image))
              <img src="{{ asset('storage/' . $page->site_image) }}">
            @endif
            <div class="tag-wrap">
              @foreach ($page->tags as $tag)
                <a class="tag" href="{{ route('tags_list', ['tag_name' => $tag->name]) }}">
                  {{ $tag->hashtag }}
                </a>
              @endforeach
            </div>
            @if (!empty($page->site_url))
              <div class="site-url">
                <p class="site-url__title">サイトURL</p>
                <a class="site-url__link" href="{{ $page->site_url }}" target="_blank">{{ $page->site_url }}</a>
              </div>
            @endif
            @if (!empty($page->comment))
              <div href="{{ $page->comment }}">{{ $page->comment }}</div>
            @endif
          </div>
          <div class="show-content__secondary">
            <h2>関連ページ</h2>
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection
