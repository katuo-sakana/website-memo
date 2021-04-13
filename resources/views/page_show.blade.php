@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ $page->title }}</div>

          <div class="card-body">
            @if (!empty($page->site_image))
              <img src="{{ asset('storage/' . $page->site_image) }}">
            @endif
            @if (!empty($page->site_url))
              <a href="{{ $page->site_url }}" target="_blank">{{ $page->site_url }}</a>
            @endif
            @if (!empty($page->comment))
              <div href="{{ $page->comment }}">{{ $page->comment }}</div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
