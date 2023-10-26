@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row g-0">	<!-- Wrapper -->

        <x-patient-nav :patientId="$patient_id"/>

        <main class="col-10 bg-secondary"> <!-- Main (Top Nav & Content) -->
            <div class="container-fluid mt-1 p-4"> <!-- Content -->
                <div class="row mb-3 justify-content-between">
                    <div class="col-4">
                        <h3 class="text-white"><i class="fa-solid fa-bookmark"></i> My Bookings</h3>
                    </div>
                    <div class="col-3">
                        <div class="float-end">
                            <h5 class="text-decoration-underline text-white">Today Date</h5>
                            <p class="text-white">{{ date("Y-m-d") }}</p>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 flex-column flex-lg-row">
                    @if ($schedules->count())
                        @foreach ($schedules as $schedule)
                        <div class="col-12 mb-3">
                            <div class="card" style="height: ">
                                <h5 class="card-header">Booking Date: {{ substr($schedule->created_at, 0, 10) }}</h5>
                                <div class="card-body">
                                    <h2 class="card-title text-success fw-bolder">{{ $schedule->title  }}</h2>
                                    <p class="card-text">Appointment ID: {{ $schedule->id }}</p>
                                    <p class="card-text">Docter Name: {{ $schedule->docter->user->name}}</p>
                                    <h5 class="fw-bolder">Schedule Date: {{ substr($schedule->start_time, 0, 10) }}</h5>
                                    <h5 class="fw-bolder">Session Start Time: {{ substr($schedule->start_time, 10) }}</h5>
                                    @if (!$schedule->accept)
                                        <div class="alert alert-warning p-2">
                                            <p>Docter is not accept yet.</p>
                                            <h4>Pending ......</h4>
                                        </div>
                                        <a href="/patients/{{ $patient_id }}/edit/{{ $schedule->id }}" class="btn btn-info">Edit Booking</a>
                                    @endif
                                    <form class="d-inline" action="/patients/{{ $patient_id }}/destroy/{{ $schedule->id }}"  onclick="return confirm('Are you sure?')" method="POST">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" class="btn btn-danger" value="Cancel Booking">
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="col-12 mb-3">
                            <p class="text-white">You doesn't have bookings for upcoming days.</p>
                        </div>
                    @endif

                </div>
                {{ $schedules->links() }}
            </div> <!-- Content -->

        </main> <!-- Main (Nav & Content) -->

    </div> <!-- Wrapper -->
</div>
@endsection
