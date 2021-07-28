@extends('layout.main')

@section('title', "Главная")

@section('content')
    @include('tasks.list')
@endsection
