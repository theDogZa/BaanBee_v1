@extends('layouts.auth')
@section('title','Login')
@section('content')
<!-- {!! bcrypt('123456') !!} -->
    <div class="animate form login_form">
        <section class="login_content">
            <form role="form" method="POST" action="{{ url('/login') }}">
                {{csrf_field()}}
                <h1>{{ __('core.head_login_from') }}</h1>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="text" class="form-control" name="email" placeholder="{{ __('core.placeholder_email') }}" required="" />
                    @if ($errors->has('email'))
                        <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" name="password" placeholder="{{ __('core.placeholder_password') }}" required="" />
                    @if ($errors->has('password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <div>
                    <button class="btn btn-lg btn-default submit col-xs-12" type="submit" >{!! config('core.icon.btn_login') !!}  {{ __('core.button_login') }}</button>
                    <!-- <a class="reset_pass" href="{{ url('/password/reset') }}">Lost your password?</a> -->
                </div>

                <div class="clearfix"></div>

                <div class="separator">
                    <!-- <p class="change_link">New to site?
                        <a href="{{route('register')}}" class="to_register"> Create Account </a>
                    </p> -->

                    <div class="clearfix"></div>
                    <br />

                    <div>
                        <h1><i class="fa fa-plus-circle"></i> {{config('app.name')}}</h1>
                        <p>©{{date('Y')}} {{ __('core.app_copyright') }}</p>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection



<!--
/** 
 * 
 * Modify/Update BY PRASONG PUTICHANCHAI
 * 
 * Latest Update : 11/04/2018 22:43
 * Version : v.10000
 */
-->

