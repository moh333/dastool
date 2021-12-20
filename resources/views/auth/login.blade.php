@extends('front.include.master')
@section('title') {{__('messages.login')}} @endsection
@section('content')

<section class="breadcrumb">
    <div class="container">
        <h1 class="title">{{__('messages.login')}}</h1>
        <ul class="list-inline">
            <li>
                <a href="#">
                    {{__('messages.home')}}
                </a>
            </li>
            /
            <li>
                <a href="{{ asset('login') }}">
                    {{__('messages.login')}}
                </a>
            </li>
        </ul>
    </div>
</section>

<section class="LoginAndCreat wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
    <div class="container">
        <div class="large">
            <div class="row">

                <div class="col-sm-6">
                    <div class="right">
                        <form method="POST" action="{{ route('login') }}">
                        @csrf
                            <div class="header">
                                <h1>{{__('messages.login')}}</h1>
                            </div>
                            <label>{{__('messages.email')}}
                                    <i class="fa fa-star"></i>
                                </label>
                            <input type="email" name="email" class="form-control" required>
                            @if($errors->has('email'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
                            @endif
                            <label>{{__('messages.password')}}
                                <i class="fa fa-star"></i>
                            </label>
                            <input type="password" name="password" class="form-control" required>
                            @if($errors->has('password'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span><br>
                            @endif

                            <a href="{{ route('password.request') }}">{{__('messages.forgotPassword')}}</a>
                            <button class="form-control">{{__('messages.login')}}</button>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="left">

                        <div class="header">
                            <h1>{{__('messages.register')}}</h1>
                        </div>

                        <a href="{{ asset('register') }}" class="new1">{{__('messages.register')}}</a>

                        <a href="{{ route('social', 'facebook') }}" class="new2">
                            {{__('messages.loginbyfacebook')}}
                            <i class="fa fa-facebook"></i>
                        </a>

                        <a href="{{ route('social', 'google') }}" class="new3">{{__('messages.loginbygoogle')}}
                            <i class="fa fa-google-plus"></i>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
