@extends('layouts.app')

@section('content')
  <div class="width-base">
    <div class="card">
      <div class="card-header">
        @isset($page)
          編集
        @else
          新規作成
        @endisset
      </div>

      <div class="card-body">
        <div class="page-navigation">
          <a class="btn btn-success page-navigation__item" href="{{ route('home') }}">一覧へ戻る</a>
        </div>
        <form method="POST" action="{{ url()->current() }}" enctype="multipart/form-data">
          @csrf

          <div class="form-group row">
            <label for="title" class="col-md-3 col-form-label text-md-right">タイトル</label>

            <div class="col-md-7">
              <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                value="{{ $page->title ?? old('title') }}" autocomplete="title" autofocus>

              @error('title')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="site_url" class="col-md-3 col-form-label text-md-right">URL</label>

            <div class="col-md-7">
              <input id="site_url" type="url" class="form-control @error('site_url') is-invalid @enderror" name="site_url"
                value="{{ $page->site_url ?? old('site_url') }}" autocomplete="site_url" autofocus>

              @error('site_url')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="form-group row">
            <label for="site_tag" class="col-md-3 col-form-label text-md-right">タグを追加する</label>

            <div class="col-md-7">
              <article-tags-input :initial-tags='@json($tagNames ?? [])' :autocomplete-items='@json($allTagNames ?? [])'>
              </article-tags-input>
              @if ($errors->has('tags'))
                <span class="text-danger small">
                  {{ $errors->first('tags') }}
                </span>
              @endif
            </div>
          </div>

          <div class="form-group row">
            <label for="site_image" class="col-md-3 col-form-label text-md-right">画像</label>

            <div class="col-md-7">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="validatedCustomFile" name="site_image">
                <label class="custom-file-label" for="validatedCustomFile">ファイル選択してください</label>
              </div>
            </div>
          </div>

          @isset($page->site_image)
            <div class="form-group row">
              <label for="site_image" class="col-md-3 col-form-label text-md-right">現在設定されている画像</label>

              <div class="col-md-7">
                <img src="{{ asset('storage/' . $page->site_image) }}" width="200" height="auto">
              </div>
            </div>
          @endisset

          <div class="form-group row">
            <label for="comment" class="col-md-3 col-form-label text-md-right">コメントする</label>

            <div class="col-md-7">
              <textarea name="comment" class="form-control" id="comment"
                rows="3">{{ old('comment', $page->comment ?? '') }}</textarea>

              @error('comment')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
              <button type="submit" class="btn btn-primary">
                登録する
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('file-script')
  @include('components.file')
@endsection
