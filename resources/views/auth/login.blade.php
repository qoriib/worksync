@extends('_layouts.auth')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h3 class="mb-4 text-center">Login WorkSync</h3>

        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('login.handle') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required autofocus>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <div class="mt-3 text-center">
            Belum punya akun? <a href="{{ route('register.view') }}">Register</a>
        </div>
    </div>
</div>
@endsection