@section('header')

    <header class="header">
        <div class="header__row">
            <div class="toolbar container">
                <div class="toolbar__row">
                    <div class="toolbar__menu container">
                        <div class="menu-top">
                            <div class="menu-top__inner">
                                <a href="{{ route('search') }}" class="menu-top__link">
                                    {{ trans('menu.search') }}
                                </a>
                            </div>
                            @auth
                                <div class="menu-top__inner">
                                    <a href="{{ route('add') }}" class="menu-top__link">
                                        {{ trans('menu.add') }}
                                    </a>
                                </div>
                            @endauth
                            @guest
                                @if (Route::has('login'))
                                    <div class="menu-top__inner">
                                        <a class="menu-top__link" href="{{ route('login') }}">{{ trans('menu.login') }}</a>
                                    </div>
                                @endif

                                @if (Route::has('register'))
                                    <div class="menu-top__inner">
                                        <a class="menu-top__link"
                                           href="{{ route('register') }}">{{ trans('menu.register') }}</a>
                                    </div>
                                @endif
                            @else
                                <div class="menu-top__inner">
                                    <a id="navbarDropdown" class="menu-top__link nav-link dropdown-toggle" href="#" role="button"
                                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
