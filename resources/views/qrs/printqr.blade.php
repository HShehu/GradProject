<div class="container">


    <div class="row">
        @foreach ($blogs as $blog)
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    {{$blog->getTranslation('title',$locale)}}
                </div>
                <div class="card-body">
                    <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->margin(0)->generate(url("{$locale}/blogs/{$blog->id}"))) !!} ">
                    </div>
                </div>
            </div>
            <br> <br>
            @endforeach
        </div>    

        
    </div>
</div>