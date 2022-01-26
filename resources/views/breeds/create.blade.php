@extends('layouts.app')
@section('title')
    Utwórz gatunek
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dodaj gatunek') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('breeds/create') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nazwa') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="imageLink" class="col-md-4 col-form-label text-md-end">{{ __('Link do zdjęcia') }}</label>

                                <div class="col-md-6">
                                    <input id="imageLink" type="text" class="form-control @error('imageLink') is-invalid @enderror"
                                        name="imageLink" value="{{ old('imageLink') }}" autofocus>

                                    @error('imageLink')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="phMin" class="col-md-4 col-form-label text-md-end">{{ __('Minimalne ph') }}</label>

                                <div class="col-md-6">
                                    <input id="phMin" type="number" min="0" max="14" step="0.1" class="form-control @error('phMin') is-invalid @enderror"
                                        name="phMin" value="{{ old('phMin') }}" required autofocus>

                                    @error('phMin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="row mb-3">
                                <label for="phMax" class="col-md-4 col-form-label text-md-end">{{ __('Maksymalne ph') }}</label>
                                <div class="col-md-6">
                                    <input id="phMax" type="number" min="0" max="14" step="0.1" class="form-control @error('phMax') is-invalid @enderror"
                                        name="phMax" value="{{ old('phMax') }}" required autofocus>

                                    @error('phMax')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Dodaj') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
