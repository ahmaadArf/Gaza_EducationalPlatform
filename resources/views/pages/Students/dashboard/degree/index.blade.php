@extends('layouts.master')
@section('css')

    @section('title')
     {{ __('degree.grades_report') }}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
    {{ __('degree.grades_report') }}
    @stop
    <!-- breadcrumb -->

    @section('content')
        <!-- row -->
        <div class="row">
            <div class="col-md-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('msg'))
                        <div class="alert alert-{{ session('type') }}">
                            {{ session('msg') }}
                        </div>
                       @endif
                        <form method="post"  action="{{ route('student.dashboard.final-degree.store') }}" autocomplete="off">
                            @csrf
                            <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{ __('degree.search_info') }} </h6><br>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="finalDegree"> {{ __('degree.academic_year') }}</label>
                                        <select class=" custom-select mr-sm-2" name="year">
                                                <option value="2020">{{ '2020' }}</option>
                                                <option value="2021">{{ '2021' }}</option>
                                                <option value="2022">{{ '2022' }}</option>
                                                <option value="2023">{{ '2023' }}</option>
                                                <option value="2024">{{ '2024' }}</option>
                                                <option value="2025">{{ '2025' }}</option>

                                        </select>
                                    </div>
                                </div>

                            </div>
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Students_trans.submit')}}</button>
                        </form>
                        @isset($finalDegrees)
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                                       style="text-align: center">
                                    <thead>
                                    <tr>
                                        <th class="alert-success">#</th>
                                        <th class="alert-success">{{trans('Students_trans.Grade')}}</th>
                                        <th class="alert-success">{{ __('degree.classroom') }} </th>
                                        <th class="alert-success">{{trans('Students_trans.section')}}</th>
                                        <th class="alert-success">{{ __('degree.subject') }} </th>
                                        <th class="alert-warning">{{ __('degree.midterm_grade') }}  </th>
                                        <th class="alert-warning">{{ __('degree.final_grade') }}  </th>
                                        <th class="alert-warning">{{ __('degree.total') }}  </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($finalDegrees as $finalDegree)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{$finalDegree->grade->Name}}</td>
                                            <td>{{$finalDegree->classroom->Name_Class}}</td>
                                            <td>{{$finalDegree->section->Name_Section}}</td>
                                            <td>{{$finalDegree->subject->name}}</td>
                                            <td>{{$finalDegree->mid  }}</td>
                                            <td>{{$finalDegree->final  }}</td>
                                            <td>{{$finalDegree->final+$finalDegree->mid  }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        @endisset

                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->
    @endsection
    @section('js')

    @endsection
