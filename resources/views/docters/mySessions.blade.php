@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row g-0">	<!-- Wrapper -->

        <x-docter-nav :docterId="$docter_id"/>

        <main class="col-10 bg-secondary">
            <div class="container-fluid mt-1 p-4"> <!-- Content -->
                <div class="row mb-3 justify-content-between">
                    <div class="col-4">
                        <h3 class="text-white"><i class="fa-regular fa-chart-bar"></i>My Schedule</h3>
                    </div>
                    <div class="col-3">
                        <div class="float-end">
                            <h5 class="text-decoration-underline text-white">Today Date</h5>
                            <p class="text-white">{{ date("Y-m-d") }}</p>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 flex-column flex-lg-row">
                    @if ($sessions->count())
                        @foreach ($sessions as $session)
                            <div class="col-6 mb-3">
                                <div class="card" style="height: ">
                                    <h5 class="card-header">Booking Date: {{ substr($session->created_at, 0, 10) }}</h5>
                                    <div class="card-body">
                                        <h2 class="card-title text-success fw-bolder">{{ $session->title  }}</h2>
                                        <p class="card-text">Appointment ID: {{ $session->id }}</p>
                                        <p class="card-text fw-bold"><a href="{{ route('docters.showHistory', $session->patient->id) }}" class="text-decoration-none">Patient Name: {{ $session->patient->user->name}}</a></p>
                                        <p class="card-text">Patient Phone No: {{ $session->patient->phone}}</p>
                                        <p class="card-text">Patient DateOfBirth: {{ $session->patient->dob}}</p>
                                        <h5 class="fw-bolder">Schedule Date: {{ substr($session->start_time, 0, 10) }}</h5>
                                        <h5 class="fw-bolder">Session Start Time: {{ substr($session->start_time, 10) }}</h5>
                                        <form class="d-inline" action="/docters/{{ $docter_id }}/destroy/{{ $session->id }}"  onclick="return confirm('Are you sure?')" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-check"></i> Cancel</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 mb-3">
                            <p>There is no schedule for you. Please check back later.</p>
                        </div>
                    @endif
                </div>

                {{ $sessions->links() }}
            </div> <!-- Content -->

        </main> <!-- Main (Nav & Content) -->

    </div> <!-- Wrapper -->
</div>
@endsection
