<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ route('student.dashboard.index') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_trans.Programname')}} </li>

        <li>
            <a href="{{route('student.dashboard.subjects.index')}}"><i class="fas fa-chalkboard"></i><span
                class="right-nav-text">{{ trans('subject.subjects') }}</span></a>
        </li>

        <!-- الامتحانات-->
        <li>
            <a href="{{route('student.dashboard.student_exams.index')}}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">{{ trans('main_trans.Exams') }}</span></a>
        </li>

         <!-- الدرجات-->
         <li>
            <a href="{{route('student.dashboard.final-degree.index')}}"><i class="fas fa-pen"></i><span
                    class="right-nav-text">{{ __('degree.degree') }}</span></a>
        </li>

        <!-- profile-->
        <li>
            <a href="{{route('student.dashboard.profile.index')}}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">{{ trans('profile.profile') }}  </span></a>
        </li>

    </ul>
</div>
