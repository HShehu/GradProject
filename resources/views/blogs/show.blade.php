@extends('layouts.app')

@section('title')
{{$blog->title}}
@endsection

@section('content')
<br>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1 class="display-4 text-center">{{$blog->title}}</h1>
            <hr class="my-4">

            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample"
                aria-expanded="false" aria-controls="collapseExample">
                @lang('messages.qrCode')
            </button>

            @can ('edit blog posts')
            <div class="btn-group ml-3" role="group" aria-label="Button group">

                <a class="btn btn-outline-primary"
                    href="{{ route('blogs.edit',['blog'=>$blog->id,'locale'=>app()->getLocale()]) }}">
                    @lang('messages.edit') @lang('messages.viewpoints')
                </a>
                <form class="form-inline"
                    action="{{ route('blogs.destroy',['blog'=>$blog->id,'locale'=>app()->getLocale()]) }}"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        @lang('messages.delete') @lang('messages.viewpoints')
                    </button>
                </form>

            </div>
            @endcan
        </div>
    </div>


    <br>

    <br>

    <div class="row">
        <div class="col-9">
            <div class="pt-0 jumbotron">
                {{-- Image 1 and Caption --}}
                <div class="col">
                    <div class="row">
                        <img src="{{asset($blog->image)}}">
                        @if ($blog->image_notes)
                        <p class="image_notes">
                            {{$blog->image_notes}}
                        </p>
                        @endif
                    </div>
                </div>

                {{-- Text To Speech Button --}}
                <a class="btn btn-outline-info" href="#" id="read">Listen</a>
                <a class="btn btn-outline-info" href="#" id="stop">Stop Listening</a>

                {{-- Viewpoint Content --}}
                <p id="speech" class="lead">{{$blog->content}}</p>
                @if ($blog->notes)
                <small class="text-muted">
                    {{$blog->notes}}
                </small>
                @endif

                {{-- Image 2 and Caption --}}
                <div class="col">
                    <div class="row">
                        @if ($blog->image2)
                        <img class="img-fluid" src="{{asset($blog->image2)}}">
                        @endif
                        @if ($blog->image2_notes)
                        <p class="image_notes">
                            {{$blog->image2_notes}}
                        </p>
                        @endif
                    </div>
                </div>
            </div>

            <hr />
            <h4 class="display-3">@lang('messages.comment')</h4>


            @foreach($blog->comments as $comment)
            <div class="display-comment">
                <strong>{{ $comment->user->name }}</strong>
                <p class="lead">{{ $comment->body }}</p>
                @can('edit comment')
                {!! Form::open(['method' => 'DELETE', 'route' =>
                ['comments.destroy','comment'=>$comment->id]]) !!}
                <button type="submit" class="btn btn-outline-danger">
                    @lang('messages.delete') @lang('messages.comment')
                </button>
                {!! Form::close() !!}
                @endcan
            </div>
            @endforeach

            <hr />
            @auth
            <form method="post" action="{{ route('comment_add') }}">
                @csrf
                <div class="form-group">
                    <input type="text" name="comment_body" class="form-control" />
                    <input type="hidden" name="blog_id" value="{{ $blog->id }}" />
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-warning"
                        value="@lang('messages.add') @lang('messages.comment')" />
                </div>
            </form>
            @endauth
            @guest
            <h5 class="ml-3 display-5 lead">
                <a href="{{route('login',['locale'=>app()->getLocale()])}}">
                    @lang('messages.login')
                </a>
            </h5>
            @endguest

        </div>


        <div class="col">
            <div class="mb-2 row collapse" id="collapseExample">
                <img
                    src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->margin(0)->generate(url()->current())) !!} ">
            </div>
        </div>

    </div>
</div>
@endsection