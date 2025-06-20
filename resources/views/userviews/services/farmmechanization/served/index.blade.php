<x-userlayout.layout>
    <div class="container mb-3">
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-inline p-0 m-0 text-center">
                    <li class="">
                        <div class="btn-group btn-group-toggle">
                            <a class="button btn button-icon btn-outline-primary"
                                href="{{ route('farmmechanization.user.pending.index') }}">
                                Pending
                                <p class="mb-0 w-6 badge badge-pill badge-danger">
                                    {{ $pendingVisitationCount->total_count }}</p>
                            </a>
                            <a class="button btn button-icon btn-outline-primary fw-bold"
                                href="{{ route('farmmechanization.user.approved.index') }}">
                                Approved
                                <p class="mb-0 w-6 badge badge-pill badge-warning">
                                    {{ $approvedVisitationCount->total_count }}</p>
                            </a>
                            <a class="button btn button-icon btn-outline-primary  fw-bold"
                                href="{{ route('farmmechanization.user.scheduled.index') }}">
                                Scheduled
                                <p class="mb-0 w-6 badge badge-pill badge-success">
                                    {{ $scheduledVisitationCount->total_count }}</p>
                            </a>
                            <a class="button btn button-icon bg-primary fw-bold"
                                href="{{ route('farmmechanization.user.served.index') }}">
                                Served
                                <p class="mb-0 w-6 badge badge-pill badge-secondary">
                                    {{ $servedClientsCount->total_count }}</p>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="p-3">Served Clients</h5>

                        <div id="calendar"></div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const calendarEl = document.getElementById('calendar');

                                const calendar = new FullCalendar.Calendar(calendarEl, {
                                    initialView: 'dayGridMonth',
                                    height: 'auto',
                                    contentHeight: 'auto',
                                    aspectRatio: 1.5,
                                    events: [
                                        @foreach ($servedClients as $schedule)
                                            {
                                                title: 'Client: {{ number_format($schedule->total_count) }}; Area: {{ number_format($schedule->total_area) }} ha',
                                                start: '{{ $schedule->final_schedule }}',
                                                color: '#28a745',
                                                extendedProps: {
                                                    priority: 1
                                                }
                                            },
                                        @endforeach
                                    ],
                                    eventOrder: function(a, b) {
                                        return a.extendedProps.priority - b.extendedProps.priority;
                                    },
                                    eventDidMount: function(info) {
                                        new bootstrap.Tooltip(info.el, {
                                            title: info.event.title,
                                            placement: 'top',
                                            trigger: 'hover',
                                            container: 'body'
                                        });
                                    },
                                    dateClick: function(info) {
                                        const selectedDate = info.dateStr;
                                        const url = new URL(window.location.href);
                                        url.searchParams.set('filter_date', selectedDate);
                                        window.location.href = url.toString();
                                    }
                                });

                                calendar.render();
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="p-3">Served Clients (Farm Mechanization)</h5>
                        <form method="GET" action="{{ route('farmmechanization.user.served.index') }}"
                            class="mb-3 d-flex gap-2 align-items-center">
                            <input type="text" name="search" class="form-control"
                                placeholder="Search by name, transaction no., etc." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">Search</button>
                            @if (request('search'))
                                <a href="{{ route('farmmechanization.user.served.index') }}"
                                    class="btn btn-secondary">Clear</a>
                            @endif
                        </form>
                        <div class="table-responsive">
                            <form id="servedForm" method="POST">
                                @csrf

                                <table class="table align-middle text-center">
                                    <thead>
                                        <tr>
                                            <th>Transaction No.</th>
                                            <th>Service Schedule</th>
                                            <th>Area (Ha)</th>
                                            <th>Name</th>
                                            <th>Contact No.</th>
                                            <th>Email</th>
                                            <th>Location</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($servedClientsList as $clientList)
                                            <tr>
                                                <td>
                                                    {{ $clientList->transaction_number }}
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($clientList->final_schedule)->format('l, F j, Y') }}
                                                </td>
                                                <td>{{ number_format($clientList->area_size, 2) }}</td>
                                                <td>{{ $clientList->full_name }}</td>
                                                <td>{{ $clientList->contact_number }}</td>
                                                <td>{{ $clientList->email }}</td>
                                                <td>{{ $clientList->barangay }}
                                                    {{ $clientList->municipality }}
                                                    {{ $clientList->province }} {{ $clientList->region }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <x-paginationlayout>
                            {{ $servedClientsList->appends(request()->query())->links() }}
                        </x-paginationlayout>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-userlayout.layout>
