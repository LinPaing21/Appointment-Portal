@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center g-0">	<!-- Wrapper -->
        <p class="lead text-center"><a href="{{ route('docters.home') }}" class="text-decoration-none mb-3">&larr; Go back to home page</a></p>
        <h2 class="text-center">{{ $histories->first()->patient->user->name }}'s History</h2>
        <x-history :histories="$histories" />
    </div> <!-- Wrapper -->
</div>
@endsection
