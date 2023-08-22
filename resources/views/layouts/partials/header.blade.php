<header class="main-header-section">
    <div class="header-wrapper">
        <div class="header-left">
            <div class="sidebar-opner"><i class="fal fa-bars" aria-hidden="true"></i></div>
        </div>
        <div class="header-middle"></div>
        <div class="header-right">
            <div class="profile-info dropdown">
                <a href="#"  data-bs-toggle="dropdown">
                    <img src="{{ asset($info->image ?? '/back-end/img/icon/user.png') }}" alt="Profile">
                </a>
                <ul class="dropdown-menu">
                    <li> <a href="{{ url('cache-clear') }}"> <i class="far fa-undo"></i> {{ __('Clear cache') }}</a></li>
                    <li> <a href="{{ route('edit-user', auth()->id()) }}"> <i class="fal fa-user"></i> {{__('My Profile')}}</a></li>
                    <li> <a href="{{ route('signout') }}" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">  <i class="far fa-sign-out"></i> {{__('Logout')}} </a> </li>
                    <form action="{{ route('signout') }}" method="post" id="logoutForm">
                        @csrf
                    </form>
                </ul>
            </div>
        </div>
    </div>
</header>
