@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$page->title}}</div>

                <div class="card-body">
                    @if (!empty($page->site_image))
                    <img src="{{ asset('storage/' . $page->site_image) }}">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection