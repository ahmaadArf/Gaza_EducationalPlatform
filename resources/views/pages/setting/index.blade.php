@extends('layouts.master')
@section('css')
@section('title')
    {{ __('setting.setting') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('setting.setting') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')


    @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <form enctype="multipart/form-data" method="post" action="{{route('dashboard.settings.update','test')}}">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-6 border-right-2 border-right-blue-400">
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label font-weight-semibold">{{ __('setting.school_name') }} <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input name="school_name" value="{{ $setting['school_name'] }}" required type="text" class="form-control" placeholder="Name of School">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="current_session" class="col-lg-2 col-form-label font-weight-semibold"> {{ __('setting.current_year') }}<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <select data-placeholder="Choose..." required name="current_session" id="current_session" class="select-search form-control">
                                        <option value=""></option>
                                        @for($y=date('Y', strtotime('- 3 years')); $y<=date('Y', strtotime('+ 1 years')); $y++)
                                            <option {{ ($setting['current_session'] == (($y-=1).'-'.($y+=1))) ? 'selected' : '' }}>{{ ($y-=1).'-'.($y+=1) }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label font-weight-semibold">{{ __('setting.short_school_name') }}  </label>
                                <div class="col-lg-9">
                                    <input name="school_title" value="{{ $setting['school_title'] }}" type="text" class="form-control" placeholder="School Acronym">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label font-weight-semibold">{{ __('setting.phone') }}</label>
                                <div class="col-lg-9">
                                    <input name="phone" value="{{ $setting['phone'] }}" type="text" class="form-control" placeholder="Phone">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label font-weight-semibold">{{ __('setting.email') }} </label>
                                <div class="col-lg-9">
                                    <input name="school_email" value="{{ $setting['school_email'] }}" type="email" class="form-control" placeholder="School Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label font-weight-semibold">{{ __('setting.school_address') }} <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input required name="address" value="{{ $setting['address'] }}" type="text" class="form-control" placeholder="School Address">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label font-weight-semibold">{{ __('setting.first_term_end') }}   </label>
                                <div class="col-lg-9">
                                    <input name="end_first_term" value="{{ $setting['end_first_term'] }}" type="text" class="form-control date-pick" placeholder="Date Term Ends">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label font-weight-semibold"> {{ __('setting.second_term_end') }} </label>
                                <div class="col-lg-9">
                                    <input name="end_second_term" value="{{ $setting['end_second_term'] }}" type="text" class="form-control date-pick" placeholder="Date Term Ends">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label font-weight-semibold">{{ __('setting.school_logo') }} </label>
                                <div class="col-lg-9">
                                    <div class="mb-3">
                                        <img style="width: 200px" height="100px" src="{{ URL::asset('attachments/setting/'.$setting['logo']) }}" alt="">
                                    </div>
                                    <input name="logo" accept="image/*" type="file" class="file-input" data-show-caption="false" data-show-upload="false" data-fouc>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
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
