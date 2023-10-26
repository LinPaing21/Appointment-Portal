@props(['patientId'])

<nav class="col-2 bg-light pe-3 border-right"> <!-- Left Side Nav -->
    <div class="list-group text-center text-lg-start">
        <a href="{{ route('patients.home') }}" class="list-group-item list-group-item-action">
            <i class="fas fa-home"></i>
            <span class="d-none d-lg-inline">Home</span>
        </a>
        <a href="{{ route('patients.showHistory', $patientId) }}" class="list-group-item list-group-item-action">
            <i class="fa-solid fa-clock-rotate-left"></i>
            <span class="d-none d-lg-inline">My History</span>
        </a>
        <a href="{{ route('patients.showbookings', $patientId) }}" class="list-group-item list-group-item-action">
            <i class="fa-solid fa-bookmark"></i>
            <span class="d-none d-lg-inline">My Bookings</span>
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
