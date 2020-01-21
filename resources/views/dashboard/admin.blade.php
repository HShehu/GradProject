@extends('layouts.app')

@section('title')
|Admin
@endsection
@section('content')
<div class="row">
    @include('dashboard.sidenav')

    {{-- Page content --}}
    <div class="col">
        {{-- Dash Status --}}

        {{-- Welcome Message --}}
        <div class="row text-center">

            <hr>
        </div>
        {{-- End Message --}}

        {{-- Cards --}}
        <div class="row">
            <div class="ml-4 card-deck col-8">
                <div class="card border-success">
                    <div class="text-center card-header">
                        <h4 class="statushead">
                            @lang('messages.users')
                        </h4>
                    </div>
                    <div class="card-body text-center">
                        <h2 class="statusnum">{{$users->count()}}</h2>
                    </div>
                </div>
                <div class="card border-primary">
                    <div class="text-center card-header">
                        <h4 class="statushead">
                            @lang('messages.viewpoints')
                        </h4>
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