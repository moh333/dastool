@extends('front.include.master')
@section('title') {{__('messages.forgotpassword')}} @endsection
@section('content')

<section class="breadcrumb">
    <div class="container">
        <h1 class="title"> نسيت كلمة المرور </h1>
        <ul class="list-inline">
            <li>
                <a href="#">
                    الصفحة الرئيسية  
                </a>
            </li>
            /
            <li>
                <a href="{{ asset('login') }}">
                    نسيت كلمة المرور 
                </a>
            </li>
        </ul>
    </div>
</section>

<section class="LoginAndCreat wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s">
    <div class="container">
        <div class="large">
            <div class="row">

                <div class="col-sm-12">
                    <div class="right">
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="header">
                                <h1> نسيت كلمة المرور </h1>
                            </div>

                            <label>البريد الالكترونى<i class="fa fa-star"></i></label>
                            <input type="hidden" name="forgotpassword">
                            <input type="email" name="email" class="form-control" required>
                            @if($errors->has('email'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
                            @endif
                            <button type="submit" class="form-control">إرسال</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
