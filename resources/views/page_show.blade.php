@extends('layouts.app')

@section('content')
  <div class="width-base">
    <div class="card">
      <div class="card-body">
        <div class="page-navigation">
          <a class="btn btn-success page-navigation__item" href="{{ route('home') }}">一覧へ戻る</a>
          <a class="btn btn-secondary page-navigation__item" href="{{ route('page_edit', [$page->id]) }}">編集する</a>
          <a class="btn btn-primary page-navigation__item" href="{{ route('page_register') }}">新規ページをメモする</a>
          <form method="POST" class="page-navigation__item" action="{{ route('page_delete', [$page->id]) }}"
            onSubmit="return submitCheck('delete')">
            @csrf
            <button type="submit" class="btn btn-danger">
              削除する
            </button>
          </form>
        </div>
        <div class="show-content">
          <div class="show-content__primary">
            <h1>{{ $page->title }}</h1>
            @if (!empty($page->site_image))
              <div class="mt-4"><img src="{{ asset('storage/' . $page->site_image) }}"></div>
            @endif
            <div class="tag-wrap mt-3">
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
              <div class="show-content__comment">{!! nl2br(e($page->comment)) !!}</div>
            @endif
          </div>
          <div class="show-content__secondary">
            <h2>関連ページ</h2>
            <div class="tag-page-box-wrap">
              @foreach ($relationTagpages as $page)
                <div class="tag-page-box">
                  <div class="tag-page-box__image">
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
                  <div class="tag-page-box__content">
                    <p class="tag-page-box__title">
                      <a class="tag-page-box__title-link"
                        href="{{ route('page_show', ['pageid' => $page->id]) }}">{{ $page->title }}</a>
                    </p>
                    <div class="tag-page-box__comment">
                      {!! nl2br(e(Str::limit($page->comment, 70))) !!}
                    </div>
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
    </div>
  </div>
@endsection

@section('submit_check')
  @include('components.submit_check')
@endsection
