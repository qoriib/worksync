@extends('_layouts.auth')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h3 class="mb-4 text-center">Register WorkSync</h3>

        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('register.handle') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control" required autofocus>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success w-100">Register</button>
        </form>

        <div class="mt-3 text-center">
            Sudah punya akun? <a href="{{ route('login.view') }}">Login</a>
        </div>
    </div>
</div>
@endsection