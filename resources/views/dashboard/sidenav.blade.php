{{-- SideBar Nav --}}
<div class="col-2">
    <nav class="mt-3 nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="{{route('admin',['locale'=>app()->getLocale()])}}">
                @lang('messages.dashboard')
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link " href="{{route('printqr')}}" tabindex="-1" aria-disabled="true">
                @lang('messages.qrCode')
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('users.index',['locale'=>app()->getLocale()])}}">
                @lang('messages.users')
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('blogs.list',['locale'=>app()->getLocale()])}}">
                @lang('messages.viewpoints')
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="{{route('roles.index',['locale'=>app()->getLocale()])}}" tabindex="-1"
                aria-disabled="true">
                @lang('messages.roles')
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href={{route('permissions.index',['locale'=>app()->getLocale()])}} tabindex="-1"
                aria-disabled="true">
                @lang('messages.permissions')
            </a>
        </li>

    </nav>
</div>
{{-- End SideBar --}}