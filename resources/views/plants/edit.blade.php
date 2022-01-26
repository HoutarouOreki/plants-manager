@extends('layouts.app')
@section('title')
    Edycja rośliny
@endsection
@section('content')
    @if (count($breeds) === 0)
    <div class="text-center">
        <p class="text-center">Najpierw musisz utworzyć jakieś gatunki roślin!</p>
        <a class="btn btn-primary center" href="{{ route('breeds/create') }}">Utwórz gatunek</a>
    </div>
    @else
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Edycja rośliny') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('plants/update', $plant) }}">
                                {{ csrf_field() }}
                                <input name="_method" type="hidden" value="PUT">

                                <div class="row mb-3">
                                    <label for="breed"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Gatunek') }}</label>

                                    <div class="col-md-6">
                                        <select class="form-control @error('breed_id') is-invalid @enderror" name="breed_id">
                                            @foreach ($breeds as $breed)
                                                <option value="{{$breed->id}}" {{ $plant->breed->id == $breed->id ? 'selected' : (old('breed_id') == $breed->id ? 'selected' : '') }}>{{$breed->name}}</option>
                                            @endforeach
                                        </select>

                                        @error('breed_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nazwa') }}</label>
    
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" value="{{ $plant->name }}" required autofocus>
    
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="visibility" class="col-md-4 col-form-label text-md-end">{{ __('Widoczność') }}</label>

                                    <div class="col-md-6">
                                        <select class="form-control @error('visibility') is-invalid @enderror" name="visibility">
                                            @php
                                                $visibilities = [['private', 'Prywatna'], ['public', 'Publiczna']];
                                            @endphp
                                            @foreach ($visibilities as $visibility)
                                                <option value="{{ $visibility[0] }}" {{ $plant->visibility == $visibility[0] ? 'selected' : '' }}>{{$visibility[1]}}</option>
                                            @endforeach
                                        </select>
    
                                        @error('visibility')
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

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-success">
                                            {{ __('Zaktualizuj') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
