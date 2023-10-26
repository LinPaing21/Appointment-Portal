@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row g-0">	<!-- Wrapper -->

        <x-patient-nav :patientId="$patient_id"/>

        <main class="col-10 bg-secondary"> <!-- Main (Top Nav & Content) -->
            <div class="container-fluid mt-1 p-4"> <!-- Content -->
                <div class="row mb-3 justify-content-between">
                    <div class="col-2">
                        <h3 class="text-white">Home</h3>
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
                            <p>Find your most suitable docters & make appointment.</p>
                            <p class="text-muted">If you return to see all docters, click docter list.</p>
                            <form method="GET" action="/patients/home" class="form-group input-group">
                                <input type="text" class="form-control" name="name" placeholder="Search" value="{{ request('name') }}" style="background-color: #fff;">
                                <button class="btn btn-secondary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </form>

                        </div>
                    </div>
                </div> <!-- Content Row 0 -->

                <div class="row flex-column flex-lg-row"> <!-- Content Row 1 -->
                    <h2 class="h4"><a href="{{ route('patients.home') }}" class="text-white text-decoration-none">Docter List</a></h2>
                    @if ($docters->count())
                        @foreach ($docters as $docter)
                            <div class="col-4">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h3 class="card-title h2">{{ $docter->user->name }}</h3>
                                        <span class="text-success">
                                            {{ $docter->speciality }}
                                        </span>
                                    </div>
                                    <div class="card-footer">
                                        <a href="{{ route('patients.create', $docter->id) }}" class="btn btn-primary">Make Appointment</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12">
                            <p class="border border-2 border-danger text-white fs-3 p-1"> There is no docter you search!</p>
                        </div>
                    @endif

                </div> <!-- Content Row 1 -->
                {{ $docters->links() }}
            </div> <!-- Content -->

        </main> <!-- Main (Nav & Content) -->

    </div> <!-- Wrapper -->
</div>
@endsection
