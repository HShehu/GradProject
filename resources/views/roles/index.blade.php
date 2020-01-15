{{-- \resources\views\roles\index.blade.php --}}
@extends('layouts.app')

@section('title', '| Roles')

@section('content')

<div class="row">
    @include('dashboard.sidenav')
    <div class="col">
        <div class="row">
            <h1 class="ml-auto mr-auto"><i class="fa fa-key"></i>
                Roles
                <a href="{{ route('roles.create',['locale'=>app()->getLocale()]) }}" class="btn btn-success">
                    Add Role
                </a>
            </h1>
            <hr>
        </div>

        <div class="container row">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Role</th>
                            <th>Permissions</th>
                            <th>Operation</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($roles as $role)
                        <tr>

                            <td>{{ $role->name }}</td>

                            <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>
                            {{-- Retrieve array of permissions associated to a role and convert to string --}}
                            <td>
                                {!! Form::open(['method' => 'DELETE', 'route' =>
                                ['roles.destroy','role'=>$role->id] ]) !!}
                                <a href="{{ route('roles.edit',['role'=>$role->id,'locale'=>app()->getLocale()]) }}"
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