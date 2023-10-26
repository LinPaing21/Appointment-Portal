@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row g-0">	<!-- Wrapper -->

        <x-docter-nav :docterId="$docter_id"/>

        <main class="col-10 bg-secondary"> <!-- Main (Top Nav & Content) -->
            <div class="container-fluid mt-1 p-4"> <!-- Content -->
                <div class="row mb-3 justify-content-between">
                    <div class="col-4">
                        <h3 class="text-white"><i class="fa-solid fa-bookmark"></i> Patients' Appointments</h3>
                    </div>
                    <div class="col-3">
                        <div class="float-end">
                            <h5 class="text-decoration-underline text-white">Today Date</h5>
                            <p class="text-white">{{ date("Y-m-d") }}</p>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 flex-column flex-lg-row">
                    @if ($bookings->count())
                        @foreach ($bookings as $booking)
                            <div class="col-6 mb-3">
                                <div class="card" style="height: ">
                                    <h5 class="card-header">Booking Date: {{ substr($booking->created_at, 0, 10) }}</h5>
                                    <div class="card-body">
                                        <h2 class="card-title text-success fw-bolder">{{ $booking->title  }}</h2>
                                        <p class="card-text">Appointment ID: {{ $booking->id }}</p>
                                        <p class="card-text">Patient Name: {{ $booking->patient->user->name}}</p>
                                        <p class="card-text">Patient Phone No: {{ $booking->patient->phone}}</p>
                                        <p class="card-text">Patient DateOfBirth: {{ $booking->patient->dob}}</p>
                                        <h5 class="fw-bolder">Schedule Date: {{ substr($booking->start_time, 0, 10) }}</h5>
                                        <h5 class="fw-bolder">Session Start Time: {{ substr($booking->start_time, 10) }}</h5>
                                        <a href="/docters/{{ $docter_id }}/edit/{{ $booking->id }}" class="btn btn-success"><i class="fa-solid fa-check"></i> Accept</a>
                                        <form class="d-inline" action="/docters/{{ $docter_id }}/destroy/{{ $booking->id }}"  onclick="return confirm('Are you sure?')" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-check"></i> Deny</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 mb-3">
                            <p class="text-white">There is no booking for you. Please check back later.</p>
                        </div>
                    @endif
                </div>
                {{ $bookings->links() }}
            </div> <!-- Content -->

        </main> <!-- Main (Nav & Content) -->

    </div> <!-- Wrapper -->
</div>
@endsection
