@extends('layouts.app')
@section('title')
    Gatunki
@endsection
@section('head')
    <style>
        table {
            margin: auto;
            max-width: 90%;
        }

        img {
            max-height: 300px;
            object-fit: cover;
        }

    </style>
@endsection
@section('content')
    <div class="text-center">
        <a class="btn btn-primary" href="{{ route('breeds/create') }}">Dodaj gatunek</a>
        <hr>
        @if (count($breeds) == 0)
            <p>Nie ma gatunków do wyświetlenia.</p>
        @else

            <div class="container">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($breeds as $breed)
                        <div class="col-xl-3 col-lg-4 col-sm-6 my-2">
                            <div class="card h-100 border-primary">
                                <img src="{{ $breed->image_link }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $breed->name }}</h5>
                                    <p class="card-text">Dozwolone ph: {{ $breed->phMin }} - {{ $breed->phMax }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
