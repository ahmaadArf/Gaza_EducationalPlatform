<!DOCTYPE html>
<html lang="en">
@section('title')
    {{ trans('main_trans.Main_title') }}
@stop

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
    @include('layouts.head')
</head>

<body style="font-family: 'Cairo', sans-serif">

    <div class="wrapper" style="font-family: 'Cairo', sans-serif">

        <!--=================================
 preloader -->

        <div id="pre-loader">
            <img src="{{ URL::asset('assets/images/pre-loader/loader-01.svg') }}" alt="">
        </div>

        <!--=================================
 preloader -->

        @include('layouts.main-header')

        @include('layouts.main-sidebar')

        <!--=================================
 Main content -->
        <!-- main-content -->
        <div class="content-wrapper">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <br><br>
                        <h4 class="mb-0" style="font-family: 'Cairo', sans-serif">{{trans('main_trans.welcome')}}
                            {{ auth()->user()->name }}</h4>
                    </div><br><br>
                    <div class="col-sm-6">
                    </div>
                </div>

            <div class="container mt-5">
                <div class="row">
                    @foreach ($subjects as $subject)
                        <a href="{{ route('student.dashboard.subjects.show', $subject->id) }}">
                            <div class="col-md-4 mb-4">
                                <div class="card shadow-sm">
                                    <img src="{{ asset('assets/images/subject.webp') }}" class="card-img-top"
                                        alt="{{ $subject->name }}">

                                    <div class="card-body">

                                        <h5 class="card-title">{{ $subject->name }}</h5>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="card-text text-secondary mb-0">{{ $subject->grade->name }}</p>

                                            <p class="card-text text-secondary mb-0">{{trans('subject.class_grade')}}
                                                {{ $subject->classroom->name }}</p>
                                        </div>
                                        <br>
                                        <p class="card-text text-secondary mb-0">{{trans('subject.teacher_name')}}: {{ $subject->teacher->name }}
                                        </p>

                                        <!-- زر المزيد -->
                                        <div class="d-flex justify-content-end">
                                            <a href="{{ route('student.dashboard.subjects.show', $subject->id) }}"
                                                class="text-muted">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>




            <!--=================================
 wrapper -->

            <!--=================================
 footer -->

            @include('layouts.footer')
        </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>
    <!--=================================
 footer -->

    @include('layouts.footer-scripts')
    @livewireScripts
    @stack('scripts')
</body>

</html>
