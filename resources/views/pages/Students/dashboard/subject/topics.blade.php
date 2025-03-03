@extends('layouts.master')
@section('css')
    <style>
        .content-section {
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .content-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
        }

        .content-date {
            font-size: 1rem;
        }

        .content-body p {
            font-size: 1.2rem;
            line-height: 1.8;
            color: #555;
        }

        .content-footer .btn {
            padding: 15px 30px;
            font-size: 1rem;
            font-weight: bold;
        }

        /* تأثير التحويم على الزر */
        .content-footer .btn:hover {
            background-color: #0056b3;
            color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>

    <style>
        .acd-des ul li {
            min-height: 100px;
            /* لتحديد الطول الأدنى */
            padding: 20px;
            /* لإضافة حشوات داخلية */
            line-height: 1.8;
            /* تحسين المسافة بين الأسطر */
            background-color: #eee;
            /* خلفية خفيفة لجعل العنصر واضحًا */
            border: 1px solid #e9ecef;
            /* حدود خفيفة */
            border-radius: 5px;
            /* زوايا مستديرة */
        }

        .acd-des ul li a {
            align-self: center;
            /* لضبط الأيقونة عموديًا مع النص */
        }
    </style>
@section('title')
 {{ __('subject.subject') }}: {{ $subject->name }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
 {{ __('subject.subject') }}: {{ $subject->name }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if (session('msg'))
                    <div class="alert alert-{{ session('type') }}">
                        {{ session('msg') }}
                    </div>
                @endif

                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">

                        <div class="row">
                            <div class="col-xl-12 mb-30">
                                <div class="accordion gray plus-icon round">
                                    @foreach ($weeks as $week)
                                    <div class="acd-group">
                                        <a href="#" class="acd-heading">
                                            <b>
                                                {{ Carbon\Carbon::parse($week['start'])->translatedFormat('d F') }}
                                                -
                                                {{ Carbon\Carbon::parse($week['end'])->translatedFormat('d F') }}
                                            </b>
                                        </a>

                                        <div class="acd-des">
                                            <ul>
                                                @foreach ($topics as $topic)
                                                    @if ($topic->created_at >= $week->start && $topic->created_at <= $week->end)
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <h4 class="text-muted mb-3">
                                                                    <i class="fas fa-book text-primary fs-3 me-3"></i>
                                                                    {{ $topic->title }}
                                                                </h4>
                                                                <b>
                                                                    <p class="text-secondary mb-3">
                                                                        {{ $topic->description }}
                                                                    </p>
                                                                </b>
                                                                <a href="{{ $topic->link }}" class="text-primary mb-3">
                                                                    <i class="fas fa-link text-primary fs-3 me-3"></i>
                                                                    {{ $topic->link }}
                                                                </a>
                                                            </div>
                                                        </li>
                                                        <br>
                                                    @endif
                                                @endforeach

                                                @foreach ($quizes as $quize)
                                                @if ($quize->created_at >= $week->start && $quize->created_at <= $week->end)
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <h4 class="text-muted mb-3">
                                                                <i class="fas fa-file-alt text-info me-2"></i>
                                                                {{ $quize->name }}
                                                            </h4>
                                                            @if($quize->degree)
                                                                    <h4 class="text-dark mb-0"> {{ __('subject.the_grade_of_this_test') }}  {{ $quize->degree->score }}</h4>


                                                            @else
                                                            <a href="{{route('student.dashboard.quiz.show',$quize->id)}}"
                                                                class="btn btn-outline-info " role="button"
                                                                aria-pressed="true" onclick="alertExam()">{{ __('subject.click_here_to_apply_for_the_test') }}
                                                                <i class="fas fa-person-booth"></i></a>
                                                            @endif


                                                        </div>
                                                    </li>
                                                    <br>
                                                @endif
                                            @endforeach


                                            </ul>
                                        </div>
                                    </div>

                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- row closed -->
@endsection
@section('js')
<script>
    function alertExam() {
        alert("{{ __('quiz.confirm_test_start') }}");
    }
</script>
@endsection
