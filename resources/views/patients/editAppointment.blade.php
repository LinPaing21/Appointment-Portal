@extends('layouts.app')

@section('content')
<div class="container my-5">
    <p class="lead"><a href="{{ route('patients.home') }}" class="text-decoration-none mb-3">&larr; Go back to home page</a></p>
    <h2 class="mb-3 ms-md-1 text-center text-md-start">Create An Appointment</h2>
    <div class="row justify-content-center">
        {{-- create article form section --}}
        <div class="col-6">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Docter Name: {{ $schedule->docter->user->name }}</li>
                    <li class="list-group-item">Specialization: {{ $schedule->docter->speciality }}</li>
                    <li class="list-group-item">License No: {{ $schedule->docter->license }}</li>
                    <li class="list-group-item">Phone No: {{ $schedule->docter->phone }}</li>
                    <li class="list-group-item">Email Address: {{ $schedule->docter->user->email }}</li>
                    <li class="list-group-item">
                        <h5>Docter's Schedules</h5>
                        <ul>
                           @foreach ($schedule->docter->schedules as $sch)
                                @if ($sch->accept)
                                    <li class="text-decoration-underline text-info">{{ $sch->start_time }}</li>
                                @endif
                            @endforeach
                        </ul>

                    </li>
                </ul>
            </div>
        </div>

        <div class="col-6 border border-2 border-warning shadow p-3 rounded">
            <form method="POST" action="/patients/{{ $patient_id }}/edit/{{ $schedule->id }}">
                @csrf
                @method('PATCH')
                <input type="hidden" name="docter_id" value="{{ $schedule->docter->id }}">
                @error('docter_id')
                    <span class="text-danger" role="alert">
                        *<small>Something Went Wrong! :(</small>
                    </span>
                @enderror
                <div class="mb-3">
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $schedule->title) }}" required>
                    @error('title')
                        <span class="text-danger" role="alert">
                            *<small>{{ $message }}</small>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Start Time</label>
                    <input type="datetime-local" name="start_time" class="form-control" value="{{ old('start_time', $schedule->start_time) }}" required>
                    @error('start_time')
                        <span class="text-danger" role="alert">
                            *<small>{{ $message }}</small>
                        </span>
                    @enderror
                </div>
                <input type="submit" value="Add Appointment" class="btn btn-primary">
                <a href="{{ route('patients.home') }}" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
