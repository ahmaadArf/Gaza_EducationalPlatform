@extends('layouts.master')
@section('css')
@section('title')
    {{ trans('main_trans.list_students') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.list_students') }}
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
                            <a href="{{ route('dashboard.students.create') }}" class="btn btn-success btn-sm"
                                role="button" aria-pressed="true">{{ trans('main_trans.add_student') }}</a><br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('Students_trans.name') }}</th>
                                            <th>{{ trans('Students_trans.email') }}</th>
                                            <th>{{ trans('Students_trans.gender') }}</th>
                                            <th>{{ trans('Students_trans.Grade') }}</th>
                                            <th>{{ trans('Students_trans.classrooms') }}</th>
                                            <th>{{ trans('Students_trans.section') }}</th>
                                            <th>{{ trans('Students_trans.Processes') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->email }}</td>
                                                <td>{{ $student->gender->name }}</td>
                                                <td>{{ $student->grade->name }}</td>
                                                <td>{{ $student->classroom->name }}</td>
                                                <td>{{ $student->section->name }}</td>
                                                <td>
                                                    <div class="dropdown show">
                                                        <a class="btn btn-success btn-sm dropdown-toggle" href="#"
                                                            role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            {{ __('Students_trans.operations') }}
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item"
                                                                href="{{ route('dashboard.students.show', $student->id) }}"><i
                                                                    style="color: #ffc107"
                                                                    class="far fa-eye "></i>&nbsp; {{ __('Students_trans.view_student_data') }}  </a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('dashboard.students.edit', $student->id) }}"><i
                                                                    style="color:green" class="fa fa-edit"></i>&nbsp;
                                                                    {{ __('Students_trans.edit_student_data') }}  </a>
                                                                <a class="dropdown-item"
                                                                href="{{ route('dashboard.graduated.edit', $student->id) }}"><i
                                                                    style="color:green" class="fas fa-sign-out-alt"></i>&nbsp;
                                                                    {{ __('Students_trans.graduate_student') }} </a>
                                                                    <a class="dropdown-item" href="{{route('dashboard.fees_Invoices.show',$student->id)}}"><i style="color: #0000cc" class="fa fa-edit"></i>&nbsp; {{ __('Students_trans.add_fee_invoice') }}  &nbsp;</a>
                                                                    <a class="dropdown-item" href="{{route('dashboard.receipt_students.show',$student->id)}}"><i style="color: #9dc8e2" class="fas fa-money-bill-alt"></i>&nbsp; &nbsp;{{ __('Students_trans.receipt_voucher') }}  </a>
                                                                    <a class="dropdown-item" href="{{route('dashboard.processingFee.show',$student->id)}}"><i style="color: #9dc8e2" class="fas fa-money-bill-alt"></i>&nbsp; &nbsp;  {{ __('Students_trans.fee_scheduling') }} </a>
                                                                    <a class="dropdown-item" href="{{route('dashboard.payment_students.show',$student->id)}}"><i style="color:goldenrod" class="fas fa-donate"></i>&nbsp; &nbsp; {{ __('Students_trans.disbursement_voucher') }}</a>
                                                            <a class="dropdown-item"
                                                                data-target="#Delete_Student{{ $student->id }}"
                                                                data-toggle="modal"
                                                                href="##Delete_Student{{ $student->id }}"><i
                                                                    style="color: red" class="fa fa-trash"></i>&nbsp;
                                                                    {{ __('Students_trans.delete_student_data') }}  </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @include('pages.Students.delete')
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
