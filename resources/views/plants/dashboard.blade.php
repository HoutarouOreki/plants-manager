@extends('layouts.app')
@section('title')
    Rośliny
@endsection
@section('content')
    <div class="text-center">
        <a class="btn btn-primary" href="{{ route('plants/create') }}">Dodaj roślinę</a>
    </div>
@endsection
