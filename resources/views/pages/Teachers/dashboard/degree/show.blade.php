@extends('layouts.master')
@section('css')
@section('title')
{{ __('degree.list_of_students')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ __('degree.list_of_students')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('status'))
    <div class="alert alert-danger">
        <ul>
            <li>{{ session('status') }}</li>
        </ul>
    </div>
@endif
@if (session('msg'))
    <div class="alert alert-{{ session('type') }}">
        {{ session('msg') }}
    </div>
@endif

<form action="{{ route('teacher.dashboard.final-degree.store') }}" method="post" autocomplete="off">

    @csrf
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
        style="text-align: center">
        <thead>
            <tr>
                <th class="alert-success">#</th>
                <th class="alert-success">{{ trans('Students_trans.name') }}</th>
                <th class="alert-success">{{ __('degree.midterm_grade')}} </th>
                <th class="alert-success">{{ __('degree.final_grade')}}  </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $student->name }}</td>
                    <td>
                        @if (!$student->finaldegrees->where('subject_id',$subject->id)->isEmpty())
                        <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                            <input class="form-control " type="number" disabled
                            value="{{$student->finaldegrees->where('subject_id', $subject->id)->first()->mid}}">
                        @else
                        <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                            <input name="finalMiddegree[{{ $student->id }}]"
                            class="form-control "
                                type="number" value="">
                        @endif

                    </td>
                    <td>
                        @if (!$student->finaldegrees->where('subject_id',$subject->id)->isEmpty())
                        <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                            <input class="form-control " type="number" disabled
                            value="{{$student->finaldegrees->where('subject_id', $subject->id)->first()->final}}">
                        @else
                        <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                            <input name="finalFinaldegree[{{ $student->id }}]"
                            class="form-control "
                                type="number" value="">
                        @endif

                    </td>

                </tr>

            @endforeach

        </tbody>
    </table>
    <P>
        <input type="hidden" name="grade_id" value="{{ $subject->grade->id }}">
        <input type="hidden" name="subject_id" value="{{ $subject->id}}">
        <input type="hidden" name="classroom_id" value="{{ $subject->classroom->id }}">
        <button class="btn btn-success" type="submit">{{ trans('Students_trans.submit') }}</button>
    </P>
</form><br>
<!-- row closed -->
@endsection
@section('js')
@endsection
