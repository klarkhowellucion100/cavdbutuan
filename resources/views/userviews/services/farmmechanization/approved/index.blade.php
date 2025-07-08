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
                            <a class="button btn button-icon bg-primary fw-bold"
                                href="{{ route('farmmechanization.user.approved.index') }}">
                                Approved
                                <p class="mb-0 w-6 badge badge-pill badge-warning">
                                    {{ $approvedVisitationCount->total_count }}</p>
                            </a>
                            <a class="button btn button-icon btn-outline-primary fw-bold"
                                href="{{ route('farmmechanization.user.scheduled.index') }}">
                                Scheduled
                                <p class="mb-0 w-6 badge badge-pill badge-success">
                                    {{ $scheduledVisitationCount->total_count }}</p>
                            </a>
                            <a class="button btn button-icon btn-outline-primary fw-bold"
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
                        <h5 class="p-3">Client Visitation Schedule</h5>

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
                                        @foreach ($approvedVisitation as $schedule)
                                            {
                                                title: 'Client: {{ number_format($schedule->total_count) }}; Area: {{ number_format($schedule->total_area) }} ha',
                                                start: '{{ \Carbon\Carbon::parse($schedule->visitation_schedule)->toDateString() }}',
                                                color: '#007bff',
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
                        <h5 class="p-3">Approved Clients (Farm Mechanization)</h5>
                        <form method="GET" action="{{ route('farmmechanization.user.approved.index') }}"
                            class="mb-3 d-flex gap-2 align-items-center">
                            <input type="text" name="search" class="form-control"
                                placeholder="Search by name, transaction no., etc." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">Search</button>
                            @if (request('search'))
                                <a href="{{ route('farmmechanization.user.approved.index') }}"
                                    class="btn btn-secondary">Clear</a>
                            @endif
                        </form>
                        <div class="table-responsive">
                            <form id="visitationForm" method="POST">
                                @csrf
                                <table class="table align-middle text-center">
                                    <thead>
                                        <tr>
                                            <th>Transaction No.</th>
                                            <th>Visit Date</th>
                                            <th>Proposed Land Preparation Date</th>
                                            <th>Area (Ha)</th>
                                            <th>Name</th>
                                            <th>Contact No.</th>
                                            <th>Email</th>
                                            <th>Location</th>
                                            <th>Issue Cash Collection Slip</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($approvedVisitationList as $visitationList)
                                            <tr>
                                                <td>
                                                    {{ $visitationList->transaction_number }}
                                                </td>
                                                <td style="font-weight:bold;">
                                                    {{ \Carbon\Carbon::parse($visitationList->visitation_schedule)->format('l, F j, Y') }}
                                                    <span class="text-primary">
                                                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $visitationList->time_from)->format('h:i A') }}
                                                        to
                                                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $visitationList->time_to)->format('h:i A') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($visitationList->proposed_schedule)->format('l, F j, Y') }}
                                                </td>
                                                <td>{{ number_format($visitationList->area_size, 2) }}</td>
                                                <td>{{ $visitationList->full_name }}</td>
                                                <td>{{ $visitationList->contact_number }}</td>
                                                <td>{{ $visitationList->email }}</td>
                                                <td>{{ $visitationList->barangay }}
                                                    {{ $visitationList->municipality }}
                                                    {{ $visitationList->province }} {{ $visitationList->region }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('farmmechanization.user.approved.show', $visitationList->id) }}"
                                                        class="btn btn-sm btn-outline-primary">
                                                        <i class="">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                            </svg>
                                                        </i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                        </div>

                        <x-paginationlayout>
                            {{ $approvedVisitationList->appends(request()->query())->links() }}
                        </x-paginationlayout>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-userlayout.layout>
