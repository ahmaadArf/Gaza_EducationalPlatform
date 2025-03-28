<!--=================================
header start-->
<nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <!-- logo -->
    <div class="text-left navbar-brand-wrapper">
        <a class="navbar-brand brand-logo" href="{{ url('/dashboard') }}"><img width="200" height="50" src="{{ URL::asset('assets/images/logofinal.png') }}" alt=""></a>
        <a class="navbar-brand brand-logo-mini" href="{{ url('/dashboard') }}"><img src="{{ URL::asset('assets/images/newLogo.jpg') }}"
                alt=""></a>


    </div>
    <!-- Top bar left -->
    <ul class="nav navbar-nav mr-auto">
        <li class="nav-item">
            <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left"
                href="javascript:void(0);"><i class="zmdi zmdi-menu ti-align-right"></i></a>
        </li>
        {{-- <li class="nav-item">
            <div class="search">
                <a class="search-btn not_click" href="javascript:void(0);"></a>
                <div class="search-box not-click">
                    <input type="text" class="not-click form-control" placeholder="Search" value=""
                        name="search">
                    <button class="search-button" type="submit"> <i class="fa fa-search not-click"></i></button>
                </div>
            </div>
        </li> --}}
    </ul>
    <!-- top bar right -->
    <ul class="nav navbar-nav ml-auto">

        <div class="btn-group mb-1">
            <button type="button" class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              @if (App::getLocale() == 'ar')
              {{ LaravelLocalization::getCurrentLocaleName() }}
             <img width="30" src="{{ URL::asset('assets/images/flags/palestine.png') }}" alt="">
              @else
              {{ LaravelLocalization::getCurrentLocaleName() }}
              <img src="{{ URL::asset('assets/images/flags/US.png') }}" alt="">
              @endif
              </button>
            <div class="dropdown-menu">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                @endforeach
            </div>
        </div>
        <li class="nav-item fullscreen">
            <a id="btnFullscreen" href="#" class="nav-link"><i class="ti-fullscreen"></i></a>
        </li>
        <li class="nav-item dropdown ">
            <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                aria-expanded="false">
                <i class="ti-bell"></i>
                <span class="badge badge-danger notification-status"> </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-big dropdown-notifications">
                <div class="dropdown-header notifications">
                    <strong>{{trans('Sidebar_trans.Notifications')}}</strong>
                    <span class="badge badge-pill badge-warning">05</span>
                </div>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">New registered user <small
                        class="float-right text-muted time">Just now</small> </a>
                <a href="#" class="dropdown-item">New invoice received <small
                        class="float-right text-muted time">22 mins</small> </a>
                <a href="#" class="dropdown-item">Server error report<small
                        class="float-right text-muted time">7 hrs</small> </a>
                <a href="#" class="dropdown-item">Database report<small class="float-right text-muted time">1
                        days</small> </a>
                <a href="#" class="dropdown-item">Order confirmation<small class="float-right text-muted time">2
                        days</small> </a>
            </div>
        </li>
        @php
        $type='web';

        if(Auth::guard('teacher')->check())$type='teacher';
        if(Auth::guard('student')->check())$type='student';
        if(Auth::guard('parent')->check())$type='parent';

        @endphp
        <li class="nav-item dropdown mr-30">
            <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="true" aria-expanded="false">
                @if($type=='parent')
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name_Father }}" alt="avatar">

                @else
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="avatar">
                @endif

            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header">
                    <div class="media">
                        <div class="media-body">
                            @if($type=='parent')
                            <h5 class="mt-0 mb-0">{{ Auth::user()->name_Father }}</h5>
                            <span>{{ Auth::user()->email }}</span>
                            @else
                            <h5 class="mt-0 mb-0">{{ Auth::user()->name }}</h5>
                            <span>{{ Auth::user()->email }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider"></div>

                @if ($type=='web')
                     <a class="dropdown-item" href="{{ route('dashboard.settings.index') }}"><i class="fas fa-cogs"></i>{{ trans('main_trans.Settings') }}</a>
                @elseif($type=='teacher')
                    <a class="dropdown-item" href="{{ route('teacher.dashboard.profile.show') }}"><i class="text-warning ti-user"></i>{{ trans('profile.profile') }}</a>
                @elseif($type=='student')
                <a class="dropdown-item" href="{{route('student.dashboard.profile.index')}}"><i class="text-warning ti-user"></i>{{ trans('profile.profile') }}</a>
                @elseif($type=='parent')
                <a class="dropdown-item" href="{{route('parent.dashboard.profile.show.parent')}}"><i class="text-warning ti-user"></i>{{ trans('profile.profile') }}</a>

                @endif

                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="text-danger ti-unlock"></i>{{ __('Sidebar_trans.Logoff') }}</a>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    <input type="hidden" name='type' value={{ $type }}>
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>

<!--=================================
header End-->
