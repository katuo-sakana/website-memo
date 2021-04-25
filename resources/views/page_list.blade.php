@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="card">
        <div class="card-header">
          @isset($tag_name)
            #{{ $tag_name }}
          @endisset
          一覧ページ
        </div>

        <div class="card-body">
          <a class="btn btn-primary" href="{{ route('page_register') }}">新規ページをメモする</a>
          <div class="list-box-wrap">
            @foreach ($pages as $page)
              <div class="list-box">
                <div class="list-box__image">
                  @if (!empty($page->site_image))
                    <img src="{{ asset('storage/' . $page->site_image) }}">
                  @else
                    <img id="image" src="https://placehold.jp/200x200.png">
                  @endif
                </div>
                <div class="list-box__content">
                  @foreach ($page->tags as $tag)
                    <a class="tag" href="{{ route('tags_list', ['tag_name' => $tag->name]) }}">
                      {{ $tag->hashtag }}
                    </a>
                  @endforeach
                  <h5 class="list-box__title">
                    <a href="{{ route('page_show', ['pageid' => $page->id]) }}">{{ $page->title }}</a>
                  </h5>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
