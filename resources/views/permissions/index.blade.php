{{-- \resources\views\permissions\index.blade.php --}}
@extends('layouts.app')

@section('title', '| Permissions')

@section('content')

<div class="row">
    @include('dashboard.sidenav')
    <div class="col">
        <div class="row">
            <h1><i class="fa fa-key"></i>
                Available Permissions
                <a href="{{ route('permissions.create',app()->getLocale()) }}" class="btn btn-success">
                    Add Permission
                </a>
            </h1>
            <hr>
        </div>
        <div class="container row">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>Permissions</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>
                                
                                {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy',
                                'permission'=>$permission->id] ]) !!}
                                <a href="{{ route('permissions.edit', ['permission'=>$permission->id,'locale'=>app()->getLocale()]) }}"
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