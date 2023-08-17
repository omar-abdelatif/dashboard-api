@extends('layouts.app')

@section('content')

    @if (session('success'))
        <div id="success" class="alert alert-success w-50 mx-auto text-center mt-5">
            <p class="m-0">{{ session('success') }}</p>
        </div>
    @elseif ($errors->any())
        @foreach ($errors->all() as $error)
            <div id="error" class="alert alert-danger w-50 mx-auto text-center mt-5">
                <p class="mb-0">{{ $error }}</p>
            </div>
        @endforeach
    @endif

    <div class="card mb-4">
        <div class="card-header">
            {{ __('My profile') }}
        </div>

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{auth()->user()->id}}">
            <div class="card-body">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success" role="alert">{{ $message }}</div>
                @endif

                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <svg class="icon">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                        </svg>
                    </span>
                    <input class="form-control" type="text" name="name" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}" required>
                    @error('name')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <svg class="icon">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-envelope-open') }}"></use>
                        </svg>
                    </span>
                    <input class="form-control" type="text" name="email" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required>
                    @error('email')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <svg class="icon">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                        </svg>
                    </span>
                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="{{ __('New password') }}" required>
                    @error('password')
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="input-group mb-4">
                    <span class="input-group-text">
                        <svg class="icon">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                        </svg>
                    </span>
                    <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" placeholder="{{ __('New password confirmation') }}" required>
                </div>

                <div class="input-group mb-4">
                    <span class="input-group-text">
                        <svg class="icon">
                            <use xlink:href="{{ asset('icons/coreui.svg#cil-image') }}"></use>
                        </svg>
                    </span>
                    <input type="file" class="form-control @error('img') is-invalid @enderror" value="{{ old('img', auth()->user()->img) }}" name="img" required>
                    @error('img')
                        <span class="invalid-feedback">
                            {{$message}}
                        </span>
                    @enderror
                </div>

            </div>

            <div class="card-footer">
                <button class="btn btn-sm btn-primary" type="submit">{{ __('Submit') }}</button>
            </div>

        </form>

    </div>
@endsection
