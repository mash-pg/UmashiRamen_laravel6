@section('header')
<div class="header-img">
    @guest('user')
    <h1 class="header-title">
        <a href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
    </h1>
    <nav class="header-nav">
        <ul class="header-flex">
            <li><a href="{{ route('user.login') }}">{{ __('ログイン') }}</a></li>
            <li>
            @if (Route::has('user.register'))
                    <a href="{{ route('user.register') }}">{{ __('会員登録') }}</a>
            @endif
            </li>
            <li><a href="http://localhost/user/shops">ラーメン検索</a></li>
            <li><a href="#">RAMENUMASHIについて</a></li>
            <li><a href="http://localhost/shop/login">ラーメン店主様ご利用の場合</a></li>
        </ul>
    </nav>
    @else
    <div class="user-name">
        <div class="user-name-1">
            {{ Auth::user()->user_name }}様
        </div>
    </div>
    <h1 class="header-title">
        <a href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
    </h1>
    <nav class="header-nav">
        <ul class="header-flex">
            <li><a href="http://ramenumashi/user/shops">ラーメン検索</a></li>
            <li><a href="#">RAMENUMASHIについて</a></li>
            <li><a href="http://localhost/shop/login">ラーメン店主様ご利用の場合</a></li>
            <li>
            <a href="{{ route('user.logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('ログアウト') }}
            </a>
            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            </div>
            </li>
        </ul>
    </nav>
</div>
@endguest
@endsection
