{{-- \resources\views\users\index.blade.php --}}
@extends('layouts.app')

@section('title', '| Users')

@section('content')
<div class="row">

    @include('dashboard.sidenav')
    <div class="col">
        <div class="row">
            <h1 class="ml-auto mr-auto"><i class="fa fa-users"></i>
                User Administration
                <a href="{{ route('users.create',app()->getLocale()) }}" class="ml-auto btn btn-success">Add User</a>
            </h1>
            <hr>
        </div>

        <div class="container row">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date/Time Added</th>
                            <th>User Roles</th>
                            <th>Operations</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                        <tr>

                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                            <td>{{  $user->roles()->pluck('name')->implode(' ') }}</td>
                            {{-- Retrieve array of roles associated to a user and convert to string --}}
                            <td>

                                {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy',
                                'user'=>$user->id] ]) !!}
                                <a href="{{ route('users.edit', ['user'=>$user->id,'locale'=>app()->getLocale()]) }}"
                                    class="btn btn-info pull-left" style="margin-right: 3px;">
                                    Edit
                                </a>
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