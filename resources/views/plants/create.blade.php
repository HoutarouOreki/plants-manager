@extends('layouts.app')
@section('title')
    Dodaj roślinę
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
                        <div class="card-header">{{ __('Dodaj roślinę') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('plants/create') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="breed"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Gatunek') }}</label>

                                    <div class="col-md-6">
                                        <select class="form-control @error('breed') is-invalid @enderror" name="breed">
                                            @foreach ($breeds as $breed)

                                            @endforeach
                                        </select>
                                        <input id="breed" type="text"
                                            class="form-control @error('breed') is-invalid @enderror" name="breed"
                                            value="{{ old('breed') }}" required autofocus>

                                        @error('breed')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
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
