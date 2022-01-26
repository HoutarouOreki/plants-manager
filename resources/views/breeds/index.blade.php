
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

    </style>
@endsection
@section('content')
<div class="text-center">
    <a class="btn btn-primary" href="{{ route('breeds/create') }}">Dodaj gatunek</a>
    <hr>
    @if (count($breeds) == 0)
        <p>Nie ma gatunków do wyświetlenia.</p>
    @else
    <table>
        <tr>
            <th>Nazwa</th>
            <th>Obrazek</th>
            <th>Zakres ph</th>
        </tr>
        @foreach ($breeds as $breed)
            <tr>
                <td>
                    <a>{{ $breed->name }}</a>
                </td>
                <td>
                    <img src="{{ $breed->image_link }}" height="100">
                </td>
                <td>
                    <a>{{ $breed->phMin }} - {{ $breed->phMax }}</a>
                </td>
            </tr>
        @endforeach
    </table>
    @endif
</div>
@endsection