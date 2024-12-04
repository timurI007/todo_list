@extends('layouts.app')

@section('title', 'Registration')

@section('content')
    <form method="post" action="{{ route('register') }}">
        @csrf
        Name: <input name="name" type="text" required value="{{ old('name') }}">
        <br>
        Email: <input name="email" type="email" required value="{{ old('email') }}">
        <br>
        Password: <input name="password" type="password" required>
        <br>
        Repeat Password: <input name="repeat_password" type="password" required>
        <br>
        <input type="submit" value="Sign in">
    </form>

    <x-error-list />
@endsection
