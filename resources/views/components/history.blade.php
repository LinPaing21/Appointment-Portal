@props(['histories'])

<main class="col-10 bg-secondary"> <!-- Main (Top Nav & Content) -->
    <div class="container-fluid mt-1 p-4"> <!-- Content -->
        <div class="row mb-3 justify-content-between">
            <div class="col-4">
                <h3 class="text-white"><i class="fa-solid fa-clock-rotate-left"></i> History</h3>
            </div>
            <div class="col-3">
                <div class="float-end">
                    <h5 class="text-decoration-underline text-white">Today Date</h5>
                    <p class="text-white">{{ date("Y-m-d") }}</p>
                </div>
            </div>
        </div>
        <div class="row flex-column flex-lg-row"> <!-- Content Row 1 -->
            <div class="col">
                <div class="card mb-3" style="height: 280px">
                    <div class="card-body">
                        <div class="text-end">
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="fa-solid fa-arrow-down-short-wide"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-sort-amount-up"></i>
                            </button>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Docter</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($histories->count())
                                    @foreach ($histories as $history)
                                    <tr>
                                        <td>{{ $history->title }}</td>
                                        <td>{{ $history->docter->user->name }}</td>
                                        <td>{{ $history->date }}</td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center">&#8226; There is no history. &#8226;</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- Content -->

</main> <!-- Main (Nav & Content) -->
