@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row g-0">	<!-- Wrapper -->

        <x-patient-nav :patientId="$patient_id"/>

        <x-history :histories="$histories" />

    </div> <!-- Wrapper -->
</div>
@endsection
