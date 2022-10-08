@extends('layouts.app')
@section('title')
{{ ucfirst(__('profile.head_title')) }} 
@stop

@section('content')

<div class="x_panel">
    <div class="x_title">
        <h2><i class="fa fa-eye" aria-hidden="true"></i> {{ ucfirst(__('profile.head_view')) }}  </h2>
        @include('partials._panel_toolbox')
        <div class="clearfix"></div>
    </div>
    <!--/.x_title -->
    <div class="x_content"> 
        <div class="col-md-4 col-sm-4 col-xs-12 profile_left">

            <div class="profile_img">
                <div id="crop-avatar">
                    <!-- Current avatar -->
                    <img class="img-responsive avatar-view" src="{{config('core.folder.profile_img')}}{{ auth()->user()->image ? auth()->user()->image : config('core.imagetemp.profile') }}" alt="Avatar" title="Change the avatar">
                </div>
            </div>
            <h3>{{ @$results['name'] }}</h3>

            <!-- <ul class="list-unstyled user_data">
                <li>
                    <i class="fa fa-map-marker user-profile-icon"></i> San Francisco, California, USA
                </li>
                <li>
                    <i class="fa fa-briefcase user-profile-icon"></i> Software Engineer
                </li>

                <li class="m-top-xs">
                    <i class="fa fa-external-link user-profile-icon"></i>
                    <a href="http://www.kimlabs.com/profile/" target="_blank">www.kimlabs.com</a>
                </li>
            </ul>

            <a class="btn btn-success"href="{}"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                         -->
        </div>

        <div class="col-md-8 col-sm-8 col-xs-12">
                
            <div class='row user-profiles-list'>  
                <div class="col-sm-3 profiles-list-title">
                    {{ __("user.label_name")}}
                </div>
                <div class="col-sm-9 profiles-list-data">
                    {{@$results['name']}}
                </div>
            </div>
            <div class='row user-profiles-list'>  
                <div class="col-sm-3 profiles-list-title">
                    {{ __("user.label_username")}}
                </div>
                <div class="col-sm-9 profiles-list-data">
                    {{@$results['username']}}
                </div>
            </div>
            <div class='row user-profiles-list'>  
                <div class="col-sm-3 profiles-list-title">
                    {{ __("user.label_email")}}
                </div>
                <div class="col-sm-9 profiles-list-data">
                    {{@$results['email']}}
                </div>
            </div>
            <div class='row user-profiles-list'>  
                <div class="col-sm-3 profiles-list-title">
                    {{ __("user.label_status")}}
                </div>
                <div class="col-sm-9 profiles-list-data">
                    {{trans( "user.status_label.".$results['status'] )}}
                </div>
            </div>
        </div>    

        <div class="clearfix"></div>
        <div class="ln_solid"></div>          
        <div class="form-group">
            <div class="col-sm-6">
                {!! _createButtonBack('user') !!}
            </div>
        </div>  
    </div>
        <!--/.x_content -->
</div>
      <!--/.x_panel -->
@endsection



<!--
/** 
 *
 * Modify/Update BY PRASONG PUTICHANCHAI
 * 
 * Latest Update : 11/04/2018 10:38 PM
 * Version : v.10000
 *
 */
-->