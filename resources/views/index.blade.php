@extends('layouts.app')

@section('css')
    <style>
        main {
            background: url('{{ asset('img/cartoon-of-group-doctors.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            text-align: center;
            height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .center-content {
            background: rgba(255, 255, 255, 0.6);
            padding: 20px;
            border-radius: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="container center-content">
        <h1 class="font-weight-bold">Avoid Hassles & Delays.</h1>
        <p class="text-muted">Are you healty today? Sound like not good!</p>
        <p class="text-muted">Don't worry! Our app is with you. Find your online doctor and appoint now.</p>
        <a href="/login" class="btn btn-primary">Make Appointment</a>
    </div>
@endsection
