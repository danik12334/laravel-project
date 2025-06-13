@extends('layouts.app')

@section('title', 'Вход')

@section('content')
<style>
    .auth-form-container {
        max-width: 450px;
        margin: 60px auto;
        padding: 30px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .auth-form-container h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #555;
    }

    input[type="email"],
    input[type="password"] {
        width: 94%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 16px;
        transition: border-color 0.3s ease;
    }

    input:focus {
        border-color: #3490dc;
        outline: none;
        box-shadow: 0 0 0 3px rgba(52, 144, 220, 0.2);
    }

    button[type="submit"] {
        width: 100%;
        padding: 12px;
        background-color: #3490dc;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
        background-color: #2779bd;
    }

    .text-danger {
        color: red;
        font-size: 14px;
        margin-top: 5px;
        display: block;
    }

    @media (max-width: 500px) {
        .auth-form-container {
            margin: 20px;
            padding: 20px;
        }
    }
</style>

<div class="auth-form-container">
    <h2>Войти в аккаунт</h2>

    @if(session('success'))
        <div style="color: green; margin-bottom: 15px;">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('auth.login') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" name="password" id="password" required>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit">Войти</button>
    </form>
</div>
@endsection