@extends('layouts.user.app')
@include('layouts.user.header')
@section('content')
    @guest('user')
    <div id="app">
        <nav class="main-wrapper">
            <div id="main-box-home">
                <router-link to="/user/ranking">ランキング</router-link>
            </div>
            <div id="main-box-about">
                <router-link to="/user/list">予約状況・お気に入り状況</router-link>
            </div>
            <div id="main-box-shoplist">
                <router-link to="/user/shops" >お店一覧</router-link>
            </div>
            </nav>
            <router-view/>
            </div>
    </div>
    @else
    <div id="app">
        <nav class="main-wrapper">
            <div id="main-box-home">
                <router-link to="/user/ranking">ランキング</router-link>
            </div>
            <div id="main-box-about">
                <router-link to="/user/list">予約状況・お気に入り状況</router-link>
            </div>
            <div id="main-box-shoplist">
                <router-link to="/user/shops" >お店一覧</router-link>
            </div>
            </nav>
            {{-- お店一覧 --}}
            <router-view/>
            </div>
    </div>
    @endguest
<script src="{{ mix('js/app.js') }}"></script> 
@endsection

@include('layouts.user.footer')