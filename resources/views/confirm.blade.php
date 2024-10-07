@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <form action="{{ route('confirm.code') }}" method="POST">
                    @csrf
                    <label for="confirmation_code">Enter your confirmation code:</label>
                    <input type="text" name="confirmation_code" id="confirmation_code" required>
                    <button type="submit">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
