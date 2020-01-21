<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="#">
        <img class="img-fluid" src="{{asset('/img/itec404_LOGO.png')}}" alt="MagusaViews">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>


    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        {{-- MultiLanguage --}}
        <div class="ml-auto mr-auto dropdown show">
            <a class="dropdown-toggle" href="#" role="button" id="LanguageLink" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span uk-icon="world">

                </span>
            </a>

            <div class="dropdown-menu" aria-labelledby="LanguageLink">
                @foreach (config('app.available_locales') as $locale)
                <a class="dropdown-item" @if(app()->getLocale() == $locale)id="language_nav" style="font-weight:
                    bold;"@endif
                    href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(),['locale'=>$locale,'blog'=>$blog->id ?? '']) }}">
                    @if ($locale == 'en')
                    English
                    @elseif($locale == 'tr')
                    Türkçe
                    @elseif ($locale == 'gr')
                    Ελληνικά
                    @else
                    {{strtoupper($locale)}}
                    @endif
                </a>
                @endforeach
            </div>
        </div>


        <div class="ml-auto mr-auto">
            @auth
            <div class="dropdown show">
                <a class="user dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span uk-icon="user">
                        {{Auth::user()->name}}
                    </span>
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    @can('Administer users')
                    <a class="dropdown-item" href="{{route('admin',['locale'=>app()->getLocale()])}}">
                        @lang('messages.admin')
                    </a>
                    @endcan
                    <a class="dropdown-item" href="{{route('logout', app()->getLocale())}}">
                        @lang('messages.logout')
                    </a>
                </div>
            </div>
            @endauth

            @guest
            <a class="mt-2 btn btn-outline-primary" href="{{route('login', app()->getLocale())}}">
                <span uk-icon="sign-in">
                    @lang('messages.login')
                </span>
            </a>
            @endguest
        </div>

        <ul class="navbar-nav">

            <li class="nav-item active">

                <a class="nav-link home mr-5" href="{{route('blogs.index', app()->getLocale())}}">
                    @lang('messages.home')
                </a>
            </li>
        </ul>

    </div>
</nav>