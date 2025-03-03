@extends('layouts.master')
@section('css')
@section('title')
    {{trans('main_trans.list_students')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.list_students')}}
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

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Delete_allStudents">
                                    {{ __('promotions.undo_all') }}
                                </button>
                                <!-- Deleted inFormation Student -->

                                @include('pages.Students.promotion.delete_all')
                                <br><br>


                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th class="alert-info">#</th>
                                            <th class="alert-info">{{trans('Students_trans.name')}}</th>
                                            <th class="alert-danger">{{ __('promotions.previous_educational_stage') }}</th>
                                            <th class="alert-danger"> {{ __('promotions.previous_academic_year') }}</th>
                                            <th class="alert-danger">{{ __('promotions.previous_grade') }}  </th>
                                            <th class="alert-danger">{{ __('promotions.previous_section') }}  </th>
                                            <th class="alert-success">{{ __('promotions.current_educational_stage') }}  </th>
                                            <th class="alert-success">{{ __('promotions.current_academic_year') }}  </th>
                                            <th class="alert-success">{{ __('promotions.current_grade') }}  </th>
                                            <th class="alert-success">{{ __('promotions.current_section') }}  </th>
                                            <th>{{trans('Students_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($promotions as $promotion)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$promotion->student->name}}</td>
                                                <td>{{$promotion->f_grade->name}}</td>
                                                <td>{{$promotion->academic_year}}</td>
                                                <td>{{$promotion->f_classroom->name}}</td>
                                                <td>{{$promotion->f_section->name}}</td>
                                                <td>{{$promotion->t_grade->name}}</td>
                                                <td>{{$promotion->academic_year_new}}</td>
                                                <td>{{$promotion->t_classroom->name}}</td>
                                                <td>{{$promotion->t_section->name}}</td>
                                                <td>

                                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#Delete_one{{$promotion->id}}">{{ __('promotions.return_student') }}  </button>
                                                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#Graduated">{{ __('promotions.graduate_student') }}  </button>
                                                </td>
                                            </tr>
                                        @include('pages.Students.promotion.delete_one')
                                        @include('pages.Students.Graduated.onestudent')
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
    @toastr_js
    @toastr_render
@endsection
