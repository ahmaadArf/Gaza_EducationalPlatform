@extends('layouts.master')
@section('css')

@section('title')
    {{ __('payment.payment_vouchers') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   {{ __('payment.payment_vouchers') }}
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
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{ __('payment.name') }}</th>
                                            <th>{{ __('payment.amount') }}</th>
                                            <th>{{ __('payment.description') }}</th>
                                            <th>{{ __('payment.processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($payment_students as $payment_student)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$payment_student->student->name}}</td>
                                            <td>{{ number_format($payment_student->amount, 2) }}</td>
                                            <td>{{$payment_student->description}}</td>
                                                <td>
                                                    <a href="{{route('dashboard.payment_students.edit',$payment_student->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_receipt{{$payment_student->id}}" ><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @include('pages.Payment.delete')
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
