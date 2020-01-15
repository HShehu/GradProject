@extends('layouts.app')

@section('content')
<div class="row">
    @include('dashboard.sidenav')

    {{-- Page content --}}
    <div class="col">
        {{-- Dash Status --}}

        {{-- Welcome Message --}}
        <div class="row">
            <h1 class="display-4 mr-auto">Welcome </h1>
            <hr>
        </div>
        {{-- End Message --}}

        {{-- Cards --}}
        <div class="row">
            <div class="card-deck col-8">
                <div class="card border-success">
                    <div class="text-center card-header">
                        <h4 class="statushead">USERS</h4>
                    </div>
                    <div class="card-body text-center">
                        <h2 class="statusnum">{{$users->count()}}</h2>
                    </div>
                </div>
                <div class="card border-primary">
                    <div class="text-center card-header">
                        <h4 class="statushead">VIEWPOINTS</h4>
                    </div>
                    <div class="card-body text-center">
                        <h2 class="statusnum">{{$blogs->count()}}</h2>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Cards --}}
        {{-- End Dash Status --}}
    </div>
    {{-- End Page Content  --}}
</div>
@endsection