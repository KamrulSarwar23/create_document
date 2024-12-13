<style>
    .active {
        background-color: rgba(0, 0, 0, 0.4);
    }
</style>

<div class="dashboard_sidebar">
    <span class="close_icon">
        <i class="far fa-bars dash_bar"></i>
        <i class="far fa-times dash_close"></i>
    </span>
    <a href="" class="dash_logo"><img src="" alt="" class="img-fluid"></a>
    <ul class="dashboard_link">
        <li class=""><a class="" href="{{ route('home') }}"><i class="fas fa-home"></i>Go To Home
                Page</a></li>
        <li class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}"><a class="" href="{{ route('user.dashboard') }}"><i class="far fa-clipboard"></i>Dashboard</a></li>

        <li class="{{ request()->routeIs('user.documents.index') ? 'active' : '' }}"><a class="" href="{{ route('user.documents.index') }}"><i
                    class="far fa-clipboard"></i>My Documents</a></li>
        <li class="{{ request()->routeIs('user.all.document') ? 'active' : '' }}"><a class="" href="{{ route('user.all.document') }}"><i class="far fa-clipboard"></i>All
                Documents</a></li>



        <li class="{{ request()->routeIs('user.profile') ? 'active' : '' }}"><a href="{{ route('user.profile') }}"><i class="far fa-clipboard"></i> My Profile</a></li>
        <li>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                this.closest('form').submit()";><i
                        class="far fa-sign-out-alt"></i>Log out</a>
            </form>

        </li>
    </ul>
</div>
