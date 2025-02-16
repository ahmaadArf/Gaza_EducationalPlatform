@extends('layouts.master')
@section('css')
@section('title')
{{ trans('subject.edit_content') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
{{ trans('subject.edit_content') }}
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

                    <form method="post" action="{{ route('teacher.dashboard.subjects.update',$topic->id) }}" autocomplete="off">
                        @csrf
                        @method('put')
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputEmail4">{{ trans('subject.title') }}</label>
                                <input type="text" value="{{ $topic->title }}" name="title" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputEmail4">{{ trans('subject.link') }}</label>
                                <input type="url" value="{{ $topic->link }}" name="link" class="form-control">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputAddress">{{ trans('subject.notes') }}</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4">{{$topic->description }}</textarea>
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary">{{trans('Students_trans.submit')}}</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')

@endsection
