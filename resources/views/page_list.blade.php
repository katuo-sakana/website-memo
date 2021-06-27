@extends('layouts.app')

@section('content')
  <div class="width-base">
    <div class="card">
      <div class="card-header">
        @isset($tag_name)
          #{{ $tag_name }}
        @endisset
        一覧ページ
      </div>

      <div class="card-body">
        <div class="page-navigation">
          @isset($tag_name)
            <a class="btn btn-success page-navigation__item" href="{{ route('home') }}">一覧へ戻る</a>
          @endisset
          <a class="btn btn-primary page-navigation__item" href="{{ route('page_register') }}">新規ページをメモする</a>
        </div>
        <div class="list-box-wrap">
          @foreach ($pages as $page)
            <div class="list-box">
              <div class="list-box__image">
                @if (!empty($page->site_image))
                  <a href="{{ route('page_show', ['pageid' => $page->id]) }}">
                    <img src="{{ asset('storage/' . $page->site_image) }}">
                  </a>
                @else
                  <a href="{{ route('page_show', ['pageid' => $page->id]) }}">
                    <img src="{{ asset('images/noimage.png') }}">
                  </a>
                @endif
              </div>
              <div class="list-box__content">
                <p class="list-box__title">
                  <a class="list-box__title-link"
                    href="{{ route('page_show', ['pageid' => $page->id]) }}">{{ $page->title }}</a>
                </p>
                @foreach ($page->tags as $tag)
                  <a class="tag" href="{{ route('tags_list', ['tag_name' => $tag->name]) }}">
                    {{ $tag->hashtag }}
                  </a>
                @endforeach
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection
