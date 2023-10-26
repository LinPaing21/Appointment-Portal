@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row g-0">	<!-- Wrapper -->

        <x-docter-nav :docterId="$docter_id"/>

        <main class="col-10 bg-secondary"> <!-- Main (Top Nav & Content) -->
            <div class="container-fluid mt-1 p-4"> <!-- Content -->
                <div class="row mb-3 justify-content-between">
                    <div class="col-2">
                        <h3 class="text-white">Dashboard</h3>
                    </div>
                    <div class="col-3">
                        <div class="float-end">
                            <h5 class="text-decoration-underline text-white">Today Date</h5>
                            <p class="text-white">{{ date("Y-m-d") }}</p>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">	<!-- Content Row 0 -->
                    <div class="col">
                        <div class="alert alert-info">
                            <p class="h5">Welcome!</p>
                            {{-- <p>{{ $user->name }}</p> --}}
                            <p class="h3 fw-bold">{{ auth()->user()->name }}</p>
                            <p>Thanks for joinning with us. We are happy to help you to manage appointment easily.</p>
                            <p class="text-muted">View your patients' appointments and select your choice to help them.</p>
                            <a class="btn btn-primary text-white" href="{{  route('docters.showSessions', $docter_id)  }}">View My Patients</a>
                        </div>
                    </div>
                </div>

                <div class="row flex-column flex-lg-row">
                    <h2 class="h4"><a href="{{ route('docters.home') }}" class="text-white text-decoration-none">Status</a></h2>

                    <div class="col-6">
                        <div class="row mb-2">
                            <div class="col-6">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h3 class="card-title h2">{{ $booking_count }}</h3>
                                        <a href="{{ route('docters.showAppointments', $docter_id) }}" class="text-decoration-none text-success" >
                                            <i class="fa-solid fa-bookmark"></i>
                                            Appointment Requests
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h3 class="card-title h2">{{ $schedules->count() }}</h3>
                                        <a href="{{ route('docters.showSessions', $docter_id) }}" class="text-decoration-none text-success">
                                            <i class="fa-regular fa-chart-bar"></i>
                                            My Sessions
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Schedule Date</th>
                                    <th scope="col">Schedule Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($schedules->count())
                                    @foreach ($schedules as $schedule)
                                    <tr>
                                        <td>{{ $schedule->title }}</td>
                                        <td>{{ substr($schedule->start_time, 0, 10) }}</td>
                                        <td>{{ substr($schedule->start_time, 10) }}</td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" class="text-center">&#8226; There is no schedule for you yet. &#8226;</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div> <!-- Content Row 1 -->


            </div> <!-- Content -->

        </main> <!-- Main (Nav & Content) -->

    </div> <!-- Wrapper -->
</div>
@endsection
