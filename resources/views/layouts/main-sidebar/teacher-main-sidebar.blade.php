<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ url('/teacher/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{ trans('main_trans.Dashboard') }}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ trans('main_trans.Programname') }} </li>


        <!-- الاقسام-->
        <li>
            <a href="{{ route('teacher.dashboard.sections') }}"><i class="fas fa-chalkboard"></i><span
                    class="right-nav-text">{{ trans('main_trans.sections') }}</span></a>
        </li>
        <!-- الطلاب-->
        <li>
            <a href="{{ route('teacher.dashboard.students.index') }}"><i class="fas fa-user-graduate"></i><span
                    class="right-nav-text">{{ trans('main_trans.students') }}</span></a>
        </li>

        <!-- subjects-->
        <li>
            <a href="{{route('teacher.dashboard.subjects.index')}}"><i class="fas fa-book-open"></i><span
                class="right-nav-text">{{ trans('subject.subjects') }}</span></a>
        </li>
        <!-- الاختبارات-->

        <li>
            <a href="{{route('teacher.dashboard.quizzes.index')}}"><i class="fas fa-chalkboard"></i><span
                class="right-nav-text">{{ trans('main_trans.Exams') }}</span></a>
        </li>

        <!-- Online classes-->
        <li>
            <a href="{{route('teacher.dashboard.online_zoom_classes.index')}}"><i class="fas fa-video"></i><span
                class="right-nav-text">{{trans('main_trans.Onlineclasses')}}</span></a>
        </li>


        <!-- reports-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu1">
                <div class="pull-left"><i class="fas fa-file-alt"></i><span class="right-nav-text">{{ trans('attendance.reports') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections-menu1" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('teacher.dashboard.attendance.report') }}">{{ trans('attendance.attendance_reports') }}  </a></li>
            </ul>

        </li>

        <!-- رصد الدرجات  -->
        <li>
            <a href="{{route('teacher.dashboard.final-degree.index')}}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text"> {{ __('degree.grades_tracking')}} </span></a>
        </li>

        <!-- الملف الشخصي-->
        <li>
            <a href="{{route('teacher.dashboard.profile.show')}}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">{{ trans('profile.profile') }} </span></a>
        </li>

    </ul>
</div>
