@extends('layouts.app')

@section('title')
Edit Viewpoint
@endsection

@section('content')
<div class="container">
    <br>

    <form action="{{ route('blogs.update',['blog'=>$blog->id, 'locale'=>app()->getLocale()]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')


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
                        <label for="title[{{$locale}}]">Title:</label>
                    <input class="form-control" value="{{$blog->getTranslation('title', $locale)}}" type="text" name="title[{{$locale}}]" required>
                    </div>

                    <div class="form-group">
                        <label for="content[{{$locale}}]">Content:</label>
                        <textarea class="form-control" name="content[{{$locale}}]" rows="10" required>
                            {{$blog->getTranslation('content', $locale)}}
                        </textarea>
                    </div>

                    <h4>Optional</h4>

                    <div class="form-group">
                        <label for="image_notes[{{$locale}}]">Main Image Notes</label>
                        <input class="form-control" value="{{$blog->getTranslation('image_notes', $locale)}}" name="image_notes[{{$locale}}]" type="text">
                    </div>

                    <div class="form-group">
                        <label for="image2_notes[{{$locale}}]">Image 2 Notes</label>
                        <input class="form-control" value="{{$blog->getTranslation('image2_notes', $locale)}}" name="image2_notes[{{$locale}}]" type="text">
                    </div>

                    <div class="form-group">
                        <label for="notes[{{$locale}}]">Visitor Notes</label>
                        <input class="form-control" value="{{$blog->getTranslation('notes', $locale)}}" name="notes[{{$locale}}]" type="text">
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <label for="image">Select Main Image:</label>
            <input class="form-control-file" type="file" accept="image/*" name="image" required>
        </div>
    
    
        <div class="form-group">
            <label for="image2">Select Image 2(Optional):</label>
            <input class="form-control-file" type="file" accept="image/*" name="image2">
        </div>
    
        <div class="form-group">
            <button class="btn btn-outline-success" type="submit">Update ViewPoint</button>
        </div>
    </form>
</div>
@endsection