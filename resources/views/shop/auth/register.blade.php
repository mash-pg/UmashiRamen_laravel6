@extends('layouts.shop.appregi')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                <div class="card-body">

                    <form method="POST" action="{{ route('shop.register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="shop_id" class="col-md-4 col-form-label text-md-left">{{ __('お店ID') }}</label>

                            <div class="col-md-6">
                                <input id="shop_id" type="text" class="form-control @error('shop_id') is-invalid @enderror" name="shop_id" value="{{ old('shop_id') }}" required autocomplete="shop_id" placeholder="お店IDを入力して下さい。" autofocus>

                                @error('shop_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('パスワード') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="パスワードを入力して下さい。" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-left">{{ __('パスワード確認用') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="確認用パスワードを入力して下さい。" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('メールアドレス') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="メールアドレスを入力して下さい。" autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tel" class="col-md-4 col-form-label text-md-left">{{ __('電話番号') }}</label>

                            <div class="col-md-2">
                                <input id="tel1" type="tel1" class="form-control @error('tel1') is-invalid @enderror" name="tel1" value="{{ old('tel1') }}" required  autocomplete="tel1">

                                @error('tel1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <input id="tel2" type="tel2" class="form-control @error('tel2') is-invalid @enderror" name="tel2" value="{{ old('tel2') }}" required autocomplete="tel2">

                                @error('tel2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <input id="tel3" type="tel3" class="form-control @error('tel3') is-invalid @enderror" name="tel3" value="{{ old('tel3') }}" autocomplete="tel3">

                                @error('tel3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="shop_name" class="col-md-4 col-form-label text-md-left">{{ __('店舗名') }}</label>

                            <div class="col-md-6">
                                <input id="shop_name" type="shop_name" class="form-control @error('shop_name') is-invalid @enderror" name="shop_name" value="{{ old('shop_name') }}" required placeholder="店舗名を入力してください。"  autocomplete="shop_name">

                                @error('shop_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-left">{{ __('カテゴリー') }}</label>

                            <div class="col-md-6" style="margin-top: 0.5vw;">

                                <input id="category" type="checkbox"  name="category[]" value="sio" >塩ラーメン
                                <input id="category" type="checkbox"  name="category[]" value="tonkotu" >豚骨ラーメン
                                <input id="category" type="checkbox"  name="category[]" value="shoyu" >醤油ラーメン
                                <input id="category" type="checkbox"  name="category[]" value="home" >家系ラーメン
                                <input id="category" type="checkbox"  name="category[]" value="assari" >その他あっさり系
                                <input id="category" type="checkbox"  name="category[]" value="kotteri" >その他こってり系
                                <input id="category" type="checkbox"  name="category[]" value="origin" >独自系ラーメン

                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="shop_address" class="col-md-4 col-form-label text-md-left">{{ __('アクセス') }}</label>

                            <div class="col-md-6">
                                <textarea id="shop_address" class="form-control @error('shop_address') is-invalid @enderror" name="shop_address" value="{{ old('shop_address') }}" required placeholder="アクセスを入力してください" autocomplete="shop_address">
                                </textarea>
                                @error('shop_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="comments" class="col-md-4 col-form-label text-md-left">{{ __('コメント') }}</label>

                            <div class="col-md-6">
                                <textarea id="comments" class="form-control @error('comments') is-invalid @enderror" name="comments" value="{{ old('comments') }}" required placeholder="お店の思いを書いて下さい" autocomplete="comments">
                                </textarea>
                                @error('comments')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price-min" class="col-md-4 col-form-label text-md-left">{{ __('価格設定') }}</label>

                            <div class="col-md-3">
                                <input id="price-min" type="price-min" class="form-control @error('price-min') is-invalid @enderror" name="price-min" value="{{ old('price-min') }}" required placeholder="(例)1000円" autocomplete="price-min">
                                @error('price-min')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <input id="price-max" type="price-max" class="form-control @error('price-max') is-invalid @enderror" name="price-max" value="{{ old('price-max') }}" required placeholder="(例)9999円" autocomplete="price-max">

                                @error('price-max')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="seat" class="col-md-4 col-form-label text-md-left">{{ __('座席数') }}</label>

                            <div class="col-md-3">
                                <input id="seat" type="seat" class="form-control @error('seat') is-invalid @enderror" name="seat" value="{{ old('seat') }}" required placeholder="(例)99" autocomplete="seat">
                                @error('seat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('店主様登録') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
