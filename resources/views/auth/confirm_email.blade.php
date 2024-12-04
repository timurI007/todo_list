@extends('layouts.app')

@section('title', 'Registration')

@section('content')
    <form method="post" action="{{ route('login') }}">
        @csrf
        Email: <input name="email" type="email" required value="{{ old('email') }}">
        <br>
        <input type="submit" value="Confirm">
    </form>

    <x-error-list />
@endsection
