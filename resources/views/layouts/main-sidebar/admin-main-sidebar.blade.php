<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ url('/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{ trans('main_trans.Dashboard') }}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ trans('main_trans.Programname') }}
        </li>

        <!-- Grades-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Grades-menu">
                <div class="pull-left"><i class="fas fa-school"></i><span
                        class="right-nav-text">{{ trans('main_trans.Grades') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Grades-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('dashboard.grades.index') }}">{{ trans('main_trans.Grades_list') }}</a>
                </li>

            </ul>
        </li>
        <!-- classes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#classes-menu">
                <div class="pull-left"><i class="fa fa-building"></i><span
                        class="right-nav-text">{{ trans('main_trans.classes') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="classes-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('dashboard.classrooms.index') }}">{{ trans('main_trans.List_classes') }}</a>
                </li>
            </ul>
        </li>

        <!-- sections-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                <div class="pull-left"><i class="fas fa-chalkboard"></i></i><span
                        class="right-nav-text">{{ trans('main_trans.sections') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('dashboard.sections.index') }}">{{ trans('main_trans.List_sections') }}</a>
                </li>
            </ul>
        </li>

        <!-- Teachers-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Teachers-menu">
                <div class="pull-left"><i class="fas fa-chalkboard-teacher"></i></i><span
                        class="right-nav-text">{{ trans('main_trans.Teachers') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Teachers-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('dashboard.teachers.index') }}">{{ trans('main_trans.List_Teachers') }}</a>
                </li>
            </ul>
        </li>

         <!-- Parents-->
         @php
              $currentLocale = app()->getLocale();
              $route='add_parent_'.$currentLocale;
         @endphp
         <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Parents-menu">
                <div class="pull-left"><i class="fas fa-user-tie"></i><span
                        class="right-nav-text">{{ trans('main_trans.Parents') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Parents-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route( $route) }}">{{ trans('main_trans.List_Parents') }}</a> </li>
            </ul>
        </li>

        <!-- students-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu">
                <div class="pull-left"><i class="fas fa-user"></i><span
                        class="right-nav-text">{{ trans('main_trans.students') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="students-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a
                        href="{{ route('dashboard.students.create') }}">{{ trans('main_trans.add_student') }}</a>
                </li>
                <li> <a
                        href="{{ route('dashboard.students.index') }}">{{ trans('main_trans.list_students') }}</a>
                </li>


            </ul>
        </li>

        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#pro-menu">
                <div class="pull-left"><i class="fas fa-chalkboard-teacher"></i></i><span
                        class="right-nav-text">  {{ trans('main_trans.Students_Promotions') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="pro-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('dashboard.promotions.index') }}">{{ trans('main_trans.Students_Promotions') }}  </a>
                </li>
                <li> <a href="{{ route('dashboard.promotions.create') }}">{{ trans('promotions.list_Promotions') }}   </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:void(0);" data-toggle="collapse"
                data-target="#Graduate students"><i class="fas fa-user-graduate"></i><span
                class="right-nav-text">{{ trans('main_trans.Graduate_students') }}</span><div
                    class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Graduate students" class="collapse">
                <li> <a
                        href="{{ route('dashboard.graduated.create') }}">{{ trans('graduate.add_Graduate') }}</a>
                </li>
                <li> <a
                        href="{{ route('dashboard.graduated.index') }}">{{ trans('graduate.list_Graduate') }}</a>
                </li>
            </ul>
        </li>
        <!-- Accounts-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Accounts-menu">
                <div class="pull-left"><i class="fas fa-money-bill-wave-alt"></i><span
                        class="right-nav-text">{{ trans('main_trans.Accounts') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Accounts-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('dashboard.fees.index') }}">{{ __('fees.educational_fees') }} </a> </li>
                <li> <a href="{{ route('dashboard.fees_Invoices.index') }}">{{ __('fees_Invoices.educational_invoices') }}</a> </li>
                <li> <a href="{{ route('dashboard.receipt_students.index') }}">{{ __('receipt.receipt_vouchers') }} </a> </li>
                <li> <a href="{{ route('dashboard.processingFee.index') }}"> {{ __('processing.fee_processing') }}</a> </li>
                <li> <a href="{{ route('dashboard.payment_students.index') }}"> {{ __('payment.payment_vouchers') }}</a> </li>
            </ul>
        </li>

        <!-- Attendance-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Attendance-icon">
                <div class="pull-left"><i class="fas fa-calendar-alt"></i><span
                        class="right-nav-text">{{ trans('main_trans.Attendance') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Attendance-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('dashboard.attendance.index') }}">{{ trans('attendance.student_list') }} </a> </li>
            </ul>
        </li>

        <!-- Subjects-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Subjects">
                <div class="pull-left"><i class="fas fa-book-open"></i><span class="right-nav-text">{{ trans('subject.subjects') }} </span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Subjects" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{route('dashboard.subjects.index')}}"> {{ trans('subject.subjects_list') }}</a> </li>
            </ul>
        </li>

        <!-- Exams-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Exams-icon">
                <div class="pull-left"><i class="fas fa-trophy"></i><span
                        class="right-nav-text">{{ trans('main_trans.Exams') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Exams-icon" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('dashboard.quizzes.index') }}">{{ __('quiz.tests_list') }} </a></li>
                <li><a href="{{ route('dashboard.questions.index') }}">{{ __('question.questions_list') }} </a></li>
            </ul>
        </li>

         <!-- Online classes-->
         <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Onlineclasses-icon">
                <div class="pull-left"><i class="fas fa-video"></i><span
                        class="right-nav-text">{{ trans('main_trans.Onlineclasses') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Onlineclasses-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('dashboard.online_classes.index') }}"> {{ trans('online_classes.connect_with_zoom') }} </a>
                </li>
            </ul>
        </li>

         <!-- library-->
         <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#library-icon">
                <div class="pull-left"><i class="fas fa-book"></i><span
                        class="right-nav-text">{{ trans('main_trans.library') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="library-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('dashboard.library.index') }}"> {{ trans('books.book_list') }}</a> </li>
            </ul>
        </li>

        <!-- Settings-->
        <li>
            <a href="{{ route('dashboard.settings.index') }}"><i class="fas fa-cogs"></i><span
                    class="right-nav-text">{{ trans('main_trans.Settings') }} </span></a>
        </li>



    </ul>
</div>
