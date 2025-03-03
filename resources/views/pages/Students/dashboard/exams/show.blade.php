@extends('layouts.master')
@section('css')
    @livewireStyles
    @section('title')
{{ __('quiz.take_test') }}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
{{ __('quiz.take_test') }}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')

    @livewire('show-question', ['quizze_id' => $quizze_id, 'student_id' => $student_id])

@endsection
@section('js')

    @livewireScripts
@endsection
