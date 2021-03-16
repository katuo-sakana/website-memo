@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <div class="card-deck">
                        @foreach ($pages as $page)
                        <div class="card">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="200"
                                xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice"
                                focusable="false" role="img" aria-label="Placeholder: Image cap">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#868e96" /><text x="50%" y="50%" fill="#dee2e6"
                                    dy=".3em">Image cap</text>
                            </svg>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{route('page_show', ['pageid' => $page->id])}}">{{$page->title}}</a>
                                </h5>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <a class="btn btn-primary" href="{{ route('page_register') }}">新規ページをメモする</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection