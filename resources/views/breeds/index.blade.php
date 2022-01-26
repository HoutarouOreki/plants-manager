
@extends('layouts.app')
@section('title')
    Gatunki
@endsection
@section('content')
    @foreach ($breeds as $breed)
        {{ $breed->name }}
    @endforeach
@endsection