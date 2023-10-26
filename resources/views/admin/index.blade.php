@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row g-0">	<!-- Wrapper -->

        <nav class="col-2 bg-light pe-3 border-right"> <!-- Left Side Nav -->
            <div class="list-group text-center text-lg-start">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-chalkboard"></i>
                    <span class="d-none d-lg-inline">Dashboard</span>
                </a>
                <a href="#role" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-bookmark"></i>
                    <span class="d-none d-lg-inline">Role Requests</span>
                </a>
                <a href="#docters" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-user-doctor"></i>
                    <span class="d-none d-lg-inline">Docters</span>
                </a>
                <a href="#patients" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-hospital-user"></i>
                    <span class="d-none d-lg-inline">Patients</span>
                </a>
                <!-- Button trigger modal -->
                <a href="#" class="list-group-item list-group-item-action" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa-solid fa-gear"></i>
                    <span class="d-none d-lg-inline">Setting</span>
                </a>


          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Sorry ;( </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            This feature is not complete yet. Please wait version 2.
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

        </nav> <!-- Left Side Nav -->

        <main class="col-10 bg-secondary"> <!-- Main (Top Nav & Content) -->
            <div class="container-fluid mt-1 p-4"> <!-- Content -->
                <div class="row mb-3 justify-content-between">
                    <div class="col-4">
                        <h3 class="text-white">Admin Dashboard</h3>
                    </div>
                    <div class="col-3">
                        <div class="float-end">
                            <h5 class="text-decoration-underline text-white">Today Date</h5>
                            <p class="text-white">{{ date("Y-m-d") }}</p>
                        </div>
                    </div>
                </div>

                <div class="row flex-column flex-lg-row">
                    <h2 class="h4"><a href="{{ route('docters.home') }}" class="text-white text-decoration-none">Status</a></h2>
                    <div class="col-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h3 class="card-title h2">{{ $requests->count() }}</h3>
                                <a href="#role" class="text-decoration-none text-success" >
                                    <i class="fa-solid fa-bookmark"></i>
                                    Docter Role Requests
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h3 class="card-title h2">{{ $docters->count() }}</h3>
                                <a href="#docters" class="text-decoration-none text-success">
                                    <i class="fa-solid fa-user-doctor"></i>
                                    Docters
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h3 class="card-title h2">{{ $patients->count() }}</h3>
                                <a href="#patients" class="text-decoration-none text-success">
                                    <i class="fa-solid fa-hospital-user"></i>
                                    Patients
                                </a>
                            </div>
                        </div>
                    </div>
                </div> <!-- Content Row 1 -->

                <!-- request data -->
                <div id="role" class="row mt-4 flex-column flex-lg-row">
                    <h3 class="text-white">
                        Docter Role Request
                        <span class="badge bg-danger rounded-pill">{{ $requests->count() }}</span>
                    </h3>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">User_ID</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">License</th>
                                <th scope="col">Specilization</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($requests->count())
                                @foreach ($requests as $request)
                                    <tr>
                                        <td>{{ $request->name }}</td>
                                        <td>{{ $request->user_id }}</td>
                                        <td>{{ $request->email }}</td>
                                        <td>{{ $request->phone }}</td>
                                        <td>{{ $request->license }}</td>
                                        <td>{{ $request->speciality }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admins.makeDocter', $request->id) }}" class="btn btn-sm btn-success text-white"><i class="fa-solid fa-check"></i> Accept</a>
                                                <form action="{{ route('admins.deleteReq', $request->id) }}" onclick="return confirm('Are you sure?')" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-sm btn-danger rounded-start-0 text-white"><i class="fa-solid fa-xmark"></i> Deny</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">&#8226; There is no request yet. &#8226;</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div> <!-- Content Row 2 -->

                <!-- patients -->
                <div id="patients" class="row mt-4 flex-column flex-lg-row">
                    <h3 class="text-white">
                        Patients
                        <span class="badge bg-danger rounded-pill">{{ $patients->count() }}</span>
                    </h3>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">User_ID</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col" class="text-center">Date Of Birth</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($patients->count())
                                @foreach ($patients as $patient)
                                    <tr>
                                        <td>{{ $patient->name }}</td>
                                        <td>{{ $patient->user_id }}</td>
                                        <td>{{ $patient->email }}</td>
                                        <td>{{ $patient->phone }}</td>
                                        <td class="text-center">{{ $patient->dob ? $patient->dob : '-'}}</td>
                                        <td>
                                            <form action="{{ route('admins.deleteUser', $patient->user_id) }}" onclick="return confirm('Are you sure?')" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-danger text-white"><i class="fa-solid fa-trash"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">&#8226; There is no patient yet. &#8226;</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div> <!-- Content Row 3 -->

                <!-- docters -->
                <div id="docters" class="row mt-4 flex-column flex-lg-row">
                    <h3 class="text-white">
                        Docters
                        <span class="badge bg-danger rounded-pill">{{ $docters->count() }}</span>
                    </h3>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">User_ID</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">License</th>
                                <th scope="col">Specilization</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($docters->count())
                                @foreach ($docters as $docter)
                                    <tr>
                                        <td>{{ $docter->name }}</td>
                                        <td>{{ $docter->user_id }}</td>
                                        <td>{{ $docter->email }}</td>
                                        <td>{{ $docter->phone }}</td>
                                        <td>{{ $docter->license }}</td>
                                        <td>{{ $docter->speciality }}</td>
                                        <td>
                                            <form action="{{ route('admins.deleteUser', $docter->user_id) }}" onclick="return confirm('Are you sure?')" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-danger text-white"><i class="fa-solid fa-trash"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">&#8226; There is no docter yet. &#8226;</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div> <!-- Content Row 4 -->

            </div> <!-- Content -->

        </main> <!-- Main (Nav & Content) -->

    </div> <!-- Wrapper -->
</div>
@endsection
