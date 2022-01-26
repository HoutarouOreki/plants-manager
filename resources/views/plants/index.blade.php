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

    </style>
@endsection
@section('content')
    <div class="text-center">
        <a class="btn btn-primary" href="{{ route('plants/create') }}">Dodaj roślinę</a>
        <hr>
        @if (count($plants) == 0)
            <p>Nie ma roślin do wyświetlenia.</p>
        @else
        <table>
            <tr>
                <th>Nazwa</th>
                <th>Obrazek</th>
                <th>Właściciel</th>
            </tr>
            @foreach ($plants as $plant)
                <tr>
                    <td>
                        <a>{{ $plant->name }}</a>
                    </td>
                    <td>
                        <img src="{{ $plant->image_link }}" height="100">
                    </td>
                    <td>
                        <a>{{ $plant->user->name }}</a>
                    </td>
                    @if (Auth::user() != null && $plant->user_id == Auth::user()->id)
                        <td>
                            <a href="{{ route('plants/destroy', $plant->id) }}" class="btn btn-danger btn-xs"
                                onclick="return confirm('Jesteś pewien?')">
                                Usuń
                            </a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </table>
        @endif
    </div>
@endsection
