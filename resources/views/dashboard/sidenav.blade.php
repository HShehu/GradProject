{{-- SideBar Nav --}}
<div class="col-2">
    <nav class="mt-3 nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="{{route('admin',['locale'=>app()->getLocale()])}}">Home</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('users.index',['locale'=>app()->getLocale()])}}">Users</a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="{{route('roles.index',['locale'=>app()->getLocale()])}}" tabindex="-1" aria-disabled="true">Roles</a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href={{route('permissions.index',['locale'=>app()->getLocale()])}} tabindex="-1" aria-disabled="true">Permissions</a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="#" tabindex="-1" aria-disabled="true">BackUp</a>
        </li>
    </nav>
</div>
{{-- End SideBar --}}