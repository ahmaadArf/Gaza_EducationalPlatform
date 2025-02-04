@extends('layouts.master')
@section('css')
@section('title')
{{ trans('online_classes.online_lessons') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
{{ trans('online_classes.online_lessons') }}
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
                            <div class="card-body">
                                <a href="{{route('dashboard.online_classes.create')}}" class="btn btn-success" role="button" aria-pressed="true">{{ trans('online_classes.add_new_online_lesson') }}   </a>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{ trans('online_classes.stage') }} </th>
                                            <th>{{ trans('online_classes.grade') }} </th>
                                            <th>{{ trans('online_classes.section') }} </th>
                                            <th>{{ trans('online_classes.teacher') }} </th>
                                            <th>{{ trans('online_classes.lesson_title') }} </th>
                                            <th>{{ trans('online_classes.start_date') }} </th>
                                            <th>{{ trans('online_classes.lesson_time') }} </th>
                                            <th>{{ trans('online_classes.lesson_link') }} </th>
                                            <th>{{ trans('online_classes.Processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($online_classes as $online_classe)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$online_classe->grade->name}}</td>
                                            <td>{{ $online_classe->classroom->name }}</td>
                                            <td>{{$online_classe->section->name}}</td>
                                                <td>{{$online_classe->created_by}}</td>
                                                <td>{{$online_classe->topic}}</td>
                                                <td>{{$online_classe->start_time}}</td>
                                                <td>{{$online_classe->duration}}</td>
                                                <td class="text-danger"><a href="{{$online_classe->join_url}}" target="_blank"> {{ trans('online_classes.join_now') }}</a></td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_receipt{{$online_classe->meeting_id}}" ><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @include('pages.online_classes.delete')
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
