<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ route('parent.dashboard.index') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_trans.Programname')}} </li>


        <!-- قائمة الأبناء-->
        <li>
            <a href="{{route('parent.dashboard.sons.index')}}"><i class="fas fa-child"></i><span
                    class="right-nav-text">{{ __('Parent_trans.list_of_children') }}</span></a>
        </li>

        <!-- Settings-->
        <li>
            <a href="{{route('parent.dashboard.profile.show.parent')}}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">{{ trans('profile.profile') }} </span></a>
        </li>



    </ul>
</div>
