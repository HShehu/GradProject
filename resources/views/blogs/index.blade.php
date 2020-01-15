@extends('layouts.app')

@section('title')
Magusa Views
@endsection

@section('content')
<div class="container">

    <br>
    @foreach ($blogs as $blog)
    @if ($loop->even)
    <div class="row home_card">
        <div class="ml-auto card border border-info mb-3">
            <div class="row no-gutters">
                <div class="col-8">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('blogs.show', ['blog' => $blog->id,'locale'=>app()->getLocale()]) }}">
                                {{ $blog->title }}
                            </a>
                        </h5>
                        <p class="card-text">
                            {{Str::words($blog->content,40,'...')}}
                            <a class="btn btn-outline-primary" href="{{ route('blogs.show', ['blog' => $blog->id,'locale'=>app()->getLocale()]) }}">Read More</a>
                        </p>

                    </div>
                </div>
                <div class="col-4">
                    <a href="{{ route('blogs.show', ['blog' => $blog->id,'locale'=>app()->getLocale()]) }}">
                        <img class="img-fluid card-img-top" src="{{asset($blog->image)}}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="row home_card">
        <div class="card border border-warning mb-3">
            <div class="row no-gutters">
                <div class="col-4">
                    <a href="{{ route('blogs.show', ['blog' => $blog->id,'locale'=>app()->getLocale()]) }}">
                        <img class="img-fluid card-img-top" src="{{asset($blog->image)}}" alt="">
                    </a>
                </div>
                <div class="col-8">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('blogs.show', ['blog' => $blog->id,'locale'=>app()->getLocale()]) }}">
                                {{ $blog->title }}
                            </a>
                        </h5>
                        <p class="card-text" id="lead">
                            {{ Str::words($blog->content,40,'...') }}
                            <a class="btn btn-outline-primary" href="{{ route('blogs.show', ['blog' => $blog->id,'locale'=>app()->getLocale()]) }}">Read More</a>
                        </p>                      
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach

    <nav class="mr-auto" aria-label="Page navigation example">
        <ul class="pagination">
            {{$blogs->links()}}
        </ul>
    </nav>

    <div class="text-center">
        <a class="btn btn-xs btn-info" href="{{route('all-views_blog_path',app()->getLocale())}}">
            View All
        </a>
    </div>
</div>
@endsection