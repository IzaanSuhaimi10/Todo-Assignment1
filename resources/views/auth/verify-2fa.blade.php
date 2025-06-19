@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Two-Factor Authentication</h3>
    <form method="POST" action="{{ route('verify.store') }}">
        @csrf

        <div class="form-group">
            <label for="two_factor_code">Enter the code sent to your email:</label>
            <input type="text" name="two_factor_code" class="form-control" required>
            @error('two_factor_code')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Verify</button>
    </form>
</div>
@endsection
