@extends('front.include.master')
@section('title') {{__('messages.register')}} @endsection
@section('content')

<section class="breadcrumb">
    <div class="container">
        <h1 class="title">{{__('messages.register')}}</h1>
        <ul class="list-inline">
            <li>
                <a href="{{ asset('/') }}">
                    {{__('messages.home')}}  
                </a>
            </li>
            /
            <li>
                <a href="{{ asset('register') }}">
                    {{__('messages.register')}}
                </a>
            </li>
        </ul>
    </div>
</section>

<section class="TheNewAccount wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
    <div class="container">
        <div class="all">
            <div class="row">
                <div class="header">
                    <h1>{{__('messages.register')}}</h1>
                </div>
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                    <div class="col-sm-6">
                        <div class="right">
                            <div class="form-group">
                                <label> {{__('messages.firstname')}}
                                        <i class="fa fa-star"></i>
                                    </label>
                                <input type="text" class="form-control" name="firstname" required>
                                @if ($errors->has('firstname'))
                                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('firstname') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>{{__('messages.lastname')}}
                                    <i class="fa fa-star"></i>
                                </label>
                                <input type="text" class="form-control" name="lastname" required>
                                @if ($errors->has('lastname'))
                                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('lastname') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>{{__('messages.phone')}}
                                        <i class="fa fa-star"></i>
                                    </label>
                                    <input type="text" class="form-control" name="phone" required>
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('phone') }}</strong></span>
                                    @endif
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="left">
                            <div class="form-group">
                                <label>{{__('messages.email')}}
                                        <i class="fa fa-star"></i>
                                    </label>
                                    <input type="email" class="form-control" name="email" required>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
                                    @endif
                            </div>
                            <div class="form-group">
                                <label>{{__('messages.password')}}
                                    <i class="fa fa-star"></i>
                                </label>
                                <input type="password" name="password" class="form-control" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label> {{__('messages.confirmpassword')}}
                                        <i class="fa fa-star"></i>
                                    </label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                        </div>
                    </div>
                
            </div>
            <button type="submit">{{__('messages.register')}}</button>
        </form>
        </div>
    </div>
</section>

@endsection
