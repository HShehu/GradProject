@extends('layouts.app')

@section('title')
|Viewpoints
@endsection

@section('content')
<div class="row">
    @include('dashboard.sidenav')

    <div class="col">
        <div class="row">
            <h1 class="ml-auto mr-auto">
                Viewpoints
                <a href="{{ route('blogs.create',['locale'=>app()->getLocale()]) }}" class="btn btn-success">
                    Add Viewpoint
                </a>
            </h1>
            <hr>
        </div>

        <div class="container row">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Viewpoint</th>
                            <th>Operation</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($blogs as $blog)
                        <tr>

                            <td>
                                <a href="{{route('blogs.show',['blog'=>$blog->id,'locale'=>app()->getLocale()])}}">
                                    {{$loop->iteration}}. {{ $blog->getTranslation('title',app()->getLocale()) }}
                                </a>

                            </td>

                            <td>

                                {!! Form::open(['method' => 'DELETE', 'route' =>
                                ['blogs.destroy','blog'=>$blog->id] ]) !!}
                                <a href="{{ route('blogs.edit',['blog'=>$blog->id,'locale'=>app()->getLocale()]) }}"
                                    class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}

                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</div>
@endsection