<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{url('/')}}" class="site_title"> {!! config('core.icon-app')!!} <span>{{config('app.name')}}</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <img src="{{config('core.folder.profile_img')}}{{ auth()->user()->image ? auth()->user()->image : config('core.imagetemp.profile') }}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{auth()->user()->name}}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li>
                        <a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a>
                    </li>

                    @foreach($menu->where('parent_id', null) as $parent_item)
                    <li>
                        
                         @php
                            $children = $menu->where('parent_id', $parent_item->id);
                         @endphp
                            @if(!$children->isEmpty())
                            <a href="#">{!! $parent_item->menu_icon !!} {{ ucfirst($parent_item->menu_name)  }} <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                    @foreach($children->sortBy('menu_sort') as $child)
                                        <li><a href="/{{ $child->menu_link }}">{!! $child->menu_icon !!} {{ $child->menu_name }}</a></li>
                                    @endforeach
                                </ul>
                            @else
                            <a href="/{{$parent_item->menu_link}}">{!! $parent_item->menu_icon !!} {{ ucfirst($parent_item->menu_name)  }}</a>
                            @endif
                    </li>
                    @endforeach
                    <!-- <li><a><i class="fa fa-cogs"></i>Settings <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="#">Role Managment</a></li>
                            <li><a href="#">Configuration</a></li>
                        </ul>
                    </li> -->
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->

        @include('partials._sidenav_footer')
    </div>
</div>



<!--
/** 
 *
 * Modify/Update BY PRASONG PUTICHANCHAI
 * 
 * Latest Update : 14/04/2018 23:40
 * Version : v.10000
 *
 */
-->