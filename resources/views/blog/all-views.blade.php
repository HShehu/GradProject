@extends('layouts.app')

@section('title')
All Views
@endsection

@section('content')

<br>

<div class="container">
    <div class="row">

        @foreach ($blogs as $blog)
        <div class="mb-2 col-4">
            <div class="card views">

                <div class="card-header text-center">
                    <a href="{{ route('blog_path', ['blog' => $blog->id,'locale'=>app()->getLocale()]) }}">
                        {{ $blog->title }}
                    </a>
                </div>

                <div class="card-body">
                    <a href="{{ route('blog_path', ['blog' => $blog->id,'locale'=>app()->getLocale()]) }}">
                        <img class="img-fluid card-img-top" src="{{asset($blog->image)}}" alt="">
                    </a>

                    <p class="text lead">
                        {{Str::words($blog->content,20,'...')}}
                    </p>
                    <a href="{{ route('blog_path', ['blog' => $blog->id,'locale'=>app()->getLocale()]) }}">Read More</a>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection