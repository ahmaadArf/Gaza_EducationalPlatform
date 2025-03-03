@extends('layouts.master')
@section('css')

@section('title')
{{ __('quiz.tests_list') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ __('quiz.tests_list') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('quiz.subject') }} </th>
                                            <th>{{ __('quiz.test_name') }} </th>
                                            <th>{{ __('quiz.login') }} / {{ __('quiz.test_score') }} </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($quizzes as $quizze)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$quizze->subject->name}}</td>
                                                <td>{{$quizze->name}}</td>
                                                <td>
                                                    @if($quizze->degree)
                                                    {{ $quizze->degree->score }}
                                                    @else
                                                        <a href="{{route('student.dashboard.quiz.show',$quizze->id)}}"
                                                            class="btn btn-outline-success btn-sm" role="button"
                                                            aria-pressed="true" onclick="alertExam()">
                                                            <i class="fas fa-person-booth"></i></a>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
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
