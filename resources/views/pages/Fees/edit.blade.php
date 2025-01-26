@extends('layouts.master')
@section('css')

@section('title')
    {{ __('fees.edit_fee') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ __('fees.edit_fee') }}
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

                    <form action="{{route('dashboard.fees.update',$fee->id)}}" method="post" autocomplete="off">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputEmail4"> {{ __('fees.name_arabic') }} </label>
                                <input type="text" value="{{$fee->getTranslation('title','ar')}}" name="title_ar" class="form-control">
                                <input type="hidden" value="{{$fee->id}}" name="id" class="form-control">
                            </div>

                            <div class="form-group col">
                                <label for="inputEmail4">  {{ __('fees.name_english') }}</label>
                                <input type="text" value="{{$fee->getTranslation('title','en')}}" name="title_en" class="form-control">
                            </div>


                            <div class="form-group col">
                                <label for="inputEmail4">{{ __('fees.amount') }}</label>
                                <input type="number" value="{{$fee->amount}}" name="amount" class="form-control">
                            </div>

                        </div>


                        <div class="form-row">

                            <div class="form-group col">
                                <label for="inputState">{{ __('fees.educational_stage') }} </label>
                                <select class="custom-select mr-sm-2" name="Grade_id">
                                    @foreach($Grades as $Grade)
                                        <option value="{{ $Grade->id }}" {{$Grade->id == $fee->grade_id ? 'selected' : ""}}>{{ $Grade->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="inputZip">{{ __('fees.grade') }} </label>
                                <select class="custom-select mr-sm-2" name="Classroom_id">
                                    <option value="{{$fee->classroom_id}}">{{$fee->classroom->name}}</option>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="inputZip">{{ __('fees.academic_year') }} </label>
                                <select class="custom-select mr-sm-2" name="year">
                                    @php
                                        $current_year = date("Y")
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year}}" {{$year == $fee->year ? 'selected' : ' '}}>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputAddress">{{ __('fees.description') }}</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                                      rows="4">{{$fee->description}}</textarea>
                        </div>
                        <div class="form-group col">
                            <label for="inputZip"> {{ __('fees.fee_type') }}</label>
                            <select class="custom-select mr-sm-2" name="Fee_type">
                                <option value="1" {{$fee->Fee_type==1?'selected' :'' }}>{{ __('fees.tuition_fee') }} </option>
                                <option value="2" {{$fee->Fee_type==2?'selected' :'' }}>{{ __('fees.bus_fee') }} </option>
                            </select>
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary">{{ __('My_Classes_trans.submit') }}</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')

@endsection
