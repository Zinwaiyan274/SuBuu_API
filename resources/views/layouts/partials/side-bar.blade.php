<nav class="side-bar">
    <div class="side-bar-logo">
        <a href="{{ route('dashboard') }}"><img height="35" src="{{ asset(settings()->footer_logo) }}" alt="Logo"></a>
        <button class="close-btn"><i class="fal fa-times"></i></button>
    </div>
    <div class="side-bar-manu">
        <ul>
            <li class="{{ Request::routeIs('dashboard') ? 'active' : ''}}">
                <a href="{{ route('dashboard') }}" class="active">
                    <span class="sidebar-icon">
                        <i class="fas fa-home"></i>
                    </span>
                    {{__('Dashboard')}}
                </a>
            </li>
            <li class="{{ Request::routeIs('user', 'edit-user') ? 'active' : ''}}">
                <a @class(['active' => Route::is('user')]) href="{{ route('user') }}">
                    <span class="sidebar-icon">
                        <i class="fas fa-users"></i>
                    </span>
                    {{ __('Manage Users') }}
                </a>
            </li>
            <li class="{{ Request::routeIs('history') ? 'active' : ''}}">
                <a @class(['active' => Route::is('history')]) href="{{ route('history') }}">
                    <span class="sidebar-icon">
                        <i class="fas fa-clock"></i>
                    </span>
                    {{__('Reports')}}
                </a>
            </li>
            <li class="dropdown {{ Request::routeIs('blog', 'view-blog', 'edit-blog', 'blog-category', 'edit-blog-category') ? 'active' : ''}}">
                <a href="#">
                    <span class="sidebar-icon">
                        <i class="fa fa-newspaper"></i>
                    </span>
                    {{__('Blog')}} </a>
                <ul>
                    <li><a @class(['active' => Route::is('blog-category') || Route::is('edit-blog-category')]) href="{{ url('blog-category') }}">{{__('Category')}}</a></li>
                    <li><a @class(['active' => Route::is('blog') || Route::is('edit-blog') || Route::is('view-blog')]) href="{{ url('blog') }}">{{__('Blog')}}</a></li>
                </ul>
            </li>
            <li class="dropdown {{ Request::routeIs('movie-category', 'edit-movie-category') ? 'active' : ''}}">
                <a href="#">
                    <span class="sidebar-icon">
                        <i class="fa fa-film"></i>
                    </span>
                    {{__('Movie')}} </a>
                <ul>
                    <li><a @class(['active' => Route::is('movie-category') || Route::is('edit-movie-category')]) href="{{ url('movie-category') }}">{{__('Category')}}</a></li>
                </ul>
            </li>
            <li class="dropdown {{ Request::routeIs('quiz-category','edit-quiz-category','quiz','edit-quiz', 'quiz.create', 'question','edit-question', 'question.create') ? 'active' : ''}}">
                <a href="#">
                    <span class="sidebar-icon">
                        <i class="fas fa-quote-right"></i>
                    </span>
                    {{__('Quiz')}} </a>
                <ul>
                    <li><a @class(['active' => Route::is('quiz-category') || Route::is('edit-quiz-category')]) href="{{ url('quiz-category') }}">{{__('Category')}}</a></li>
                    <li><a @class(['active' => Route::is('quiz') || Route::is('edit-quiz') || Route::is('quiz.create')]) href="{{ url('quiz') }}">{{__('Quiz')}}</a></li>
                    <li><a @class(['active' => Route::is('question') || Route::is('question.create') || Route::is('edit-question')]) href="{{ url('question') }}">{{__('Questions')}}</a></li>
                </ul>
            </li>
            <li class="dropdown {{ Request::routeIs('withdraw-request', 'withdraw.show') ? 'active' : ''}}">
                <a href="#">
                    <span class="sidebar-icon">
                        <i class="fas fa-credit-card"></i>
                    </span>
                    {{__('Withdraw')}} </a>
                <ul>
                    {{-- <li><a @class(['active' => Route::is('withdraw-method') || Route::is('edit-withdraw-method')]) href="{{url('withdraw-method')}}">{{__('Withdraw Method')}}</a></li> --}}
                    <li><a @class(['active' => Route::is('withdraw-request')]) href="{{ url('withdraw-request') }}">{{__('Withdraw Request')}}</a></li>
                </ul>
            </li>
            <li class="dropdown {{ Request::routeIs('currency.index','currency.edit','currency-convert.index') ? 'active' : ''}}">
                <a href="#">
                    <span class="sidebar-icon">
                        <i class="fas fa-usd-circle"></i>
                    </span>
                    {{ __('Currency') }}
                </a>
                <ul>
                    <li>
                        <a @class(['active' => Route::is('currency.index') || Route::is('currency.edit')]) href="{{ route('currency.index') }}">{{ __('Currency') }}</a>
                    </li>
                    <li>
                        <a @class(['active' => Route::is('currency-convert.index')]) href="{{ route('currency-convert.index') }}">{{ __('Currency Convert') }}</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown {{ Request::routeIs('settings', 'reward.index', 'adnetworks', 'env.index') ? 'active' : ''}}">
                <a href="#">
                    <span class="sidebar-icon">
                        <i class="fas fa-cogs"></i>
                    </span>
                    {{ __('Settings') }}
                </a>
                <ul>
                    <li>
                        <a @class(['active' => Route::is('adnetworks')]) href="{{ route('adnetworks') }}">{{ __('Adnetworks') }}</a>
                    </li>
                    <li>
                        <a @class(['active' => Route::is('reward.index')]) href="{{ route('reward.index') }}">{{ __('Reward Settings') }}</a>
                    </li>
                    <li>
                        <a @class(['active' => Route::is('env.index')]) href="{{ route('env.index') }}">{{ __('System Settings') }}</a>
                    </li>
                    <li>
                        <a @class(['active' => Route::is('settings')]) href="{{ route('settings') }}">{{ __('Website Settings') }}</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
