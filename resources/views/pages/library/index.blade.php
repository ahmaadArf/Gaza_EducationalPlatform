@extends('layouts.master')
@section('css')
@section('title')
{{ trans('books.book_list') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
{{ trans('books.book_list') }}
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
                                <a href="{{route('dashboard.library.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true"> {{ trans('books.add_new_book') }}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> {{ trans('books.book_name') }}</th>
                                            <th> {{ trans('books.teacher_name') }}</th>
                                            <th> {{ trans('books.education_stage') }}</th>
                                            <th> {{ trans('books.grade_level') }}</th>
                                            <th>{{ trans('books.section') }}</th>
                                            <th>{{ trans('books.Processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($books as $book)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$book->title}}</td>
                                                <td>{{$book->teacher->name}}</td>
                                                <td>{{$book->grade->name}}</td>
                                                <td>{{$book->classroom->name}}</td>
                                                <td>{{$book->section->name}}</td>
                                                <td>
                                                    <a href="{{route('dashboard.downloadAttachment',$book->file_name)}}" title="{{ trans('books.download_book') }} " class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="fas fa-download"></i></a>
                                                    <a href="{{route('dashboard.library.edit',$book->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_book{{ $book->id }}" title="{{ trans('books.delete_book') }}"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>

                                        @include('pages.library.destroy')
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
