@extends('layouts.app')
@section('title','Dashboard')
@section('content')
    <!-- @include('partials._toptiles') -->
    <div class="row">
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h3>item <small>Top xxx</small></h3>
          </div>
          <div class="x_content">

          xxx
          </div>
        </div>
      </div> 
      
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h3>item <small>Top xxx</small></h3>
          </div>
          <div class="x_content">

          xxx
          </div>
        </div>
      </div>


    </div>
    <!-- <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="dashboard_graph">

                    <div class="row x_title">
                      <div class="col-md-6">
                        <h3>Network Activities <small>Graph title sub-title</small></h3>
                      </div>
                      <div class="col-md-6">
                        <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                          <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                          <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <div id="chart_plot_01" class="demo-placeholder"></div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                      <div class="x_title">
                        <h2>Top Campaign Performance</h2>
                        <div class="clearfix"></div>
                      </div>

                      <div class="col-md-12 col-sm-12 col-xs-6">
                        <div>
                          <p>Facebook Campaign</p>
                          <div class="">
                            <div class="progress progress_sm" style="width: 76%;">
                              <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>
                            </div>
                          </div>
                        </div>
                        <div>
                          <p>Twitter Campaign</p>
                          <div class="">
                            <div class="progress progress_sm" style="width: 76%;">
                              <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 col-sm-12 col-xs-6">
                        <div>
                          <p>Conventional Media</p>
                          <div class="">
                            <div class="progress progress_sm" style="width: 76%;">
                              <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="40"></div>
                            </div>
                          </div>
                        </div>
                        <div>
                          <p>Bill boards</p>
                          <div class="">
                            <div class="progress progress_sm" style="width: 76%;">
                              <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>

                    <div class="clearfix"></div>
                  </div>
                </div>
              </div> -->
              <br />

@endsection

@section('styles')
    @parent

@endsection

@section('scripts')
    @parent
    <!-- Chart.js -->
    <script src="{{asset('vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <!-- gauge.js -->
    <script src="{{asset('vendors/gauge.js/dist/gauge.min.js')}}"></script>

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

