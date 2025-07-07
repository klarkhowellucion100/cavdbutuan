<x-userlayout.layout>
    <div class="container mb-3">
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-inline p-0 m-0 text-center">
                    <li class="">
                        <div class="btn-group btn-group-toggle">
                            <a class="button btn button-icon btn-outline-primary fw-bold"
                                href="{{ route('castrationandspay.user.scheduled.index') }}">
                                Scheduled
                                <p class="mb-0 w-6 badge badge-pill badge-warning">
                                    {{ $scheduledOperationCount->total_count }}
                                </p>
                            </a>
                            <a class="button btn button-icon bg-primary"
                                href="{{ route('castrationandspay.user.served.index') }}">
                                Served
                                <p class="mb-0 w-6 badge badge-pill badge-success">
                                    {{ $servedClientsCount->total_count }}
                                </p>
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
                        <h5 class="p-3">Clients Served</h5>

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
                                        @foreach ($servedOperation as $schedule)
                                            {
                                                title: 'Served: {{ number_format($schedule->total_count) }}',
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
                        <h5 class="p-3">Served Clients (Castration and Spay)</h5>
                        <form method="GET" action="{{ route('castrationandspay.user.served.index') }}"
                            class="mb-3 d-flex gap-2 align-items-center">
                            <input type="text" name="search" class="form-control"
                                placeholder="Search by name, transaction no., etc." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">Search</button>
                            @if (request('search'))
                                <a href="{{ route('castrationandspay.user.served.index') }}"
                                    class="btn btn-secondary">Clear</a>
                            @endif
                        </form>
                        <div class="table-responsive">
                            <form id="operationForm" method="POST">
                                @csrf
                                <table class="table align-middle text-center">
                                    <thead>
                                        <tr>
                                            <th>Transaction No.</th>
                                            <th>Operation Date & Time</th>
                                            <th>Service</th>
                                            <th>Name</th>
                                            <th>Contact No.</th>
                                            <th>Email</th>
                                            <th>Location</th>
                                            <th>Pet Type</th>
                                            <th>Pet Name</th>
                                            <th>Pet Sex</th>
                                            <th>Pet Specie</th>
                                            <th>Pet Age</th>
                                            <th>Pet Color</th>
                                            <th>Vaccination Card</th>
                                            <th>Form</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($servedOperationList as $operationList)
                                            <tr>
                                                <td>
                                                    {{ $operationList->transaction_number }}
                                                </td>
                                                <td style="font-weight: bold;">
                                                    {{ \Carbon\Carbon::parse($operationList->visitation_schedule)->format('l, F j, Y') }}
                                                    <span class="text-primary">
                                                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $operationList->time_from)->format('h:i A') }}
                                                        to
                                                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $operationList->time_to)->format('h:i A') }}
                                                    </span>
                                                </td>
                                                <td>{{ $operationList->service_type }}</td>
                                                <td>{{ $operationList->full_name }}</td>
                                                <td>{{ $operationList->contact_number }}</td>
                                                <td>{{ $operationList->email }}</td>
                                                <td>{{ $operationList->barangay }}
                                                    {{ $operationList->municipality }}
                                                    {{ $operationList->province }} {{ $operationList->region }}
                                                </td>
                                                <td>{{ $operationList->animal_type }}</td>
                                                <td>{{ $operationList->animal_name }}</td>
                                                <td>{{ $operationList->animal_sex }}</td>
                                                <td>{{ $operationList->animal_specie }}</td>
                                                <td>
                                                    Year:{{ $operationList->animal_age_year }}
                                                    <br>
                                                    Month:{{ $operationList->animal_age_month }}
                                                </td>
                                                <td>{{ $operationList->animal_color }}</td>
                                                <td>
                                                    <a href="{{ route('castrationandspay.user.served.card', $operationList->id) }}"
                                                        class="btn btn-sm btn-outline-warning">
                                                        <i class="">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0
                                                                0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5
                                                                7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3
                                                                3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125
                                                                1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0
                                                                1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />

                                                            </svg>
                                                        </i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('castrationandspay.user.served.form', $operationList->id) }}"
                                                        class="btn btn-sm btn-outline-success">
                                                        <i class="">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
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
                            {{ $servedOperationList->appends(request()->query())->links() }}
                        </x-paginationlayout>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-userlayout.layout>
