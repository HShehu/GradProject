@extends('layouts.app')

@section('title')
Create Post
@endsection

@section('content')

<div class="container">
    <form action="{{ route('store_blog_path') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                @foreach (config('app.available_locales') as $locale)
                <a class="nav-item nav-link  @if ($loop->first) active @endif" id="nav-{{$locale}}-tab"
                    data-toggle="tab" href="#nav-{{$locale}}" role="tab" aria-controls="nav-home" aria-selected="true">
                    {{ strtoupper($locale) }}
                </a>
                @endforeach
            </div>
        </nav>

        <div class="jumbotron">
            <div class="tab-content" id="nav-tabContent">
                @foreach (config('app.available_locales') as $locale)
                <div class="tab-pane fade @if ($loop->first) show active @endif" id="nav-{{$locale}}" role="tabpanel"
                    aria-labelledby="nav-{{$locale}}-tab">

                    <div class="form-group">
                        <label for="{{$locale}}_title">Title:</label>
                        <input class="form-control" type="text" name="{{$locale}}_title">
                    </div>

                    <div class="form-group">
                        <label for="{{$locale}}_content">Content:</label>
                        <textarea class="form-control" name="{{$locale}}_content" rows="10"></textarea>
                    </div>

                    <h4>Optional</h4>

                    <div class="form-group">
                        <label for="{{$locale}}_image_notes">Main Image Notes</label>
                        <input class="form-control" name="{{$locale}}_image_notes" type="text">
                    </div>

                    <div class="form-group">
                        <label for="{{$locale}}_image2_notes">Image 2 Notes</label>
                        <input class="form-control" name="{{$locale}}_image_notes" type="text">
                    </div>

                    <div class="form-group">
                        <label for="{{$locale}}_notes">Visitor Notes</label>
                        <input class="form-control" name="{{$locale}}_notes" type="text">
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <label for="image">Select Main Image:</label>
            <input class="form-control-file" type="file" name="image">
        </div>


        <div class="form-group">
            <label for="image2">Select Image 2(Optional):</label>
            <input class="form-control-file" type="file" name="image2">
        </div>

        <div class="form-group">
            <button class="btn btn-outline-success" type="submit">Add ViewPoint</button>
        </div>
    </form>
</div>
@endsection