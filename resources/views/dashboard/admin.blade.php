@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    <a class="btn btn-outline-success" href="{{route('create_blog_path')}}">Create Viewpoint</a>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <br>
            <div class="card">
                <div class="card-header">Users</div>

                <div class="card-body">

                    @foreach ($users as $user)
                    <div class="row">
                        <div class="col-6">
                            {{$user->name}}
                            @foreach ($user->roles as $role)
                            <small class="text-muted"><span class="badge badge-info">{{$role->name}}</span></small>
                            @endforeach
                        </div>
                        <div class="col-6">
                            @if ($user->hasRole('admin'))

                            @endif
                        </div>
                    </div>
                    <hr>
                    @endforeach

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <br>
            <div class="card">
                <div class="card-header">Views</div>

                <div class="card-body">

                    @foreach ($blogs as $blog)
                    <div class="row">
                        <div class="col-6">
                            {{$loop->iteration}}
                            {{$blog->getTranslation('title','en')}}
                            {{-- <img src="{{asset($blog->image)}}" alt="" srcset=""> --}}
    
                            <div class="btn-group ml-3" role="group" aria-label="Button group">
                            
                                <a class="btn btn-outline-primary" href="{{ route('edit_blog_path',['blog'=>$blog->id]) }}">Edit
                                </a>
                                <form class="form-inline" action="{{ route('delete_blog_path',['blog'=>$blog->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection