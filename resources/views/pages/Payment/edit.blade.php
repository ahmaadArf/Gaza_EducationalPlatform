@extends('layouts.master')
@section('css')

@section('title')
  {{ __('payment.edit_payment_voucher') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
{{ __('payment.edit_payment_voucher') }} : <label style="color: red">{{$payment_student->student->name}}</label>
@stop
<!-- breadcrumb -->
@endsection
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

                            <form action="{{route('dashboard.payment_students.update','test')}}" method="post" autocomplete="off">
                                @method('PUT')
                                @csrf
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ __('payment.amount') }} : <span class="text-danger">*</span></label>
                                        <input  class="form-control" name="Debit" value="{{$payment_student->amount}}" type="number" >
                                        <input  type="hidden" name="student_id" value="{{$payment_student->student->id}}" class="form-control">
                                        <input  type="hidden" name="id"  value="{{$payment_student->id}}" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ __('payment.description') }} : <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{$payment_student->description}}</textarea>
                                    </div>
                                </div>

                            </div>

                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Students_trans.submit')}}</button>
                        </form>

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')


@endsection
