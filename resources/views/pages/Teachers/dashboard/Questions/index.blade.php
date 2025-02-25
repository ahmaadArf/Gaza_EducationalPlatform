@extends('layouts.master')
@section('css')

@section('title')
    {{ __('question.questions_list') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
{{ __('question.questions_list') }} : <span class="text-danger">{{$quizz->name}}</span>
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
                                @if (session('msg'))
                                    <div class="alert alert-{{ session('type') }}">
                                        {{ session('msg') }}
                                    </div>
                                @endif
                                <a href="{{route('teacher.dashboard.questions.show',$quizz->id)}}"
                                     class="btn btn-success btn-sm" role="button" aria-pressed="true"
                                     >{{ __('question.add_new_question') }}   </a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">{{ __('question.question') }}</th>
                                            <th scope="col">{{ __('question.answers') }}</th>
                                            <th scope="col">{{ __('question.correct_answer') }} </th>
                                            <th scope="col">{{ __('question.score') }}</th>
                                            <th scope="col">{{ __('question.test_name') }} </th>
                                            <th scope="col">{{ __('question.processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($questions as $question)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$question->title}}</td>
                                                <td>{{$question->answers}}</td>
                                                <td>{{$question->right_answer}}</td>
                                                <td>{{$question->score}}</td>
                                                <td>{{$question->quizze->name}}</td>
                                                <td>
                                                    <a href="{{route('teacher.dashboard.questions.edit',$question->id)}}"
                                                       class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                            class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#delete_exam{{ $question->id }}" title="حذف"><i
                                                            class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>

                                        @include('pages.Teachers.dashboard.Questions.destroy')
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

@endsection
