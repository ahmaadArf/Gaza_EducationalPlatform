<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ url('/teacher/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_trans.Programname')}} </li>


         <!-- الاقسام-->
         <li>
            <a href="{{route('teacher.dashboard.sections')}}"><i class="fas fa-chalkboard"></i><span
                    class="right-nav-text">{{ trans('main_trans.List_sections') }}</span></a>
        </li>

    </ul>
</div>
