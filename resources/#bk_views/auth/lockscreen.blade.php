@extends('layouts.auth')
@section('title','lockscreen')
@section('content')
<!-- {!! bcrypt('123456') !!} -->
    <div class="animate form login_form">
        <section class="login_content">
            <form role="form" method="POST" action="{{ url('/lockscreen') }}">
                {{csrf_field()}}
                <h1>{{ __('core.head_lockscreen_from') }}</h1>
                <div class="row">                
                    <img class="img-responsive img-circle profile_img" src="{{config('core.folder.profile_img')}}{{ auth()->user()->image ? auth()->user()->image : config('core.imagetemp.profile') }}" alt="" title="Change">
                </div>
                <div class="row">           
                    <h1>{{auth()->user()->name}}</h1>
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
                    <button class="btn btn-lg btn-default submit col-xs-12" type="submit" > {{ __('core.button_unlock_screen') }}  {!! config('core.icon.btn_unlock_screen') !!}</button>                 
                </div>
                <div class="clearfix"></div>
                <div class="separator">
                
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
