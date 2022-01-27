@extends('layouts.app')
@section('title')
    Rośliny
@endsection
@section('head')
    <style>
        table {
            margin: auto;
            max-width: 90%;
        }

        img {
            max-height: 200px;
            object-fit: cover;
        }

    </style>
@endsection
@section('content')
    <div class="text-center">
        <a class="btn btn-primary" href="{{ route('plants/create') }}">Dodaj roślinę</a>
        <hr>
        @if (count($plants) == 0)
            <p>Nie ma roślin do wyświetlenia.</p>
        @else
            <div class="container">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($plants as $plant)
                        <div class="col-xl-3 col-lg-4 col-sm-6 my-2">
                            <div class="card h-100 border-success">
                                <img src="{{ $plant->image_link }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $plant->name }}</h5>
                                    <p class="card-text">{{ $plant->breed->name }}</p>
                                    @if (Auth::user() != null && $plant->user_id == Auth::user()->id)
                                    <small class="card-text">Ostatnie podlewanie:<br>{{ $plant->last_watering }}</small>
                                    @endif
                                </div>
                                @if (Auth::user() != null && $plant->user_id == Auth::user()->id)
                                    <div class="card-footer p-0">
                                        <a href="{{ route('plants/water', $plant->id) }}" class="btn btn-link"
                                            title="Podlej">
                                            <small>Podlej</small> </a>
                                        <a href="{{ route('plants/edit', $plant->id) }}" class="btn btn-link"
                                            title="Edytuj">
                                            <small>Edytuj</small> </a>
                                        <a href="{{ route('plants/destroy', $plant->id) }}" class="btn btn-link"
                                            onclick="return confirm('Jesteś pewien?')">
                                            <small>Usuń</small>
                                        </a>
                                    </div>
                                @endif
                                <div class="card-footer">
                                    <small class="text-muted">Właściciel: {{ $plant->user->name }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
