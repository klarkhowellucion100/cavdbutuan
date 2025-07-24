<x-userlayout.layout>

    <div class="container mb-3">
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-inline p-0 m-0 text-center">
                    <li class="">
                        <div class="btn-group btn-group-toggle">
                            <a class="button btn button-icon bg-primary fw-bold"
                                href="{{ route('dashboard.farmmechanization') }}">
                                Farm Mechanization
                            </a>
                            <a class="button btn button-icon btn-outline-primary" href="#">
                                Castration and Spay
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-4 mt-1">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <h4 class="font-weight-bold">Farm Mechanization Request Status</h4>
                <form action="{{ route('dashboard.farmmechanization.search') }}" method="POST">
                    @csrf
                    <div class="form-group mb-0 d-flex flex-row">
                        <div class="date-icon-set">
                            <input type="date" name="start" class="form-control" value="{{ $filterDateFrom }}" placeholder="From Date">
                        </div>
                        <span class="flex-grow-0">
                            <span class="btn">To</span>
                        </span>
                        <div class="date-icon-set">
                            <input type="date" name="end" value="{{ $filterDateTo }}" class="form-control" placeholder="To Date">
                        </div>
                        <div class="ml-3">
                            <button class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">
                        P {{ number_format($collections->total_collection ?? 0, 2) }}
                    </h4>
                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                        Collections
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">
                        {{ number_format($servedClientsCount->total_count ?? 0) }}
                    </h4>
                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                        Served
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">
                        {{ number_format($pendingVisitationCount->total_count ?? 0) }}
                    </h4>
                    <p class="card-text text-center text-danger" style="font-weight:bold;">
                        Pending
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">
                        {{ number_format($approvedVisitationCount->total_count ?? 0) }}
                    </h4>
                    <p class="card-text text-center text-warning" style="font-weight:bold;">
                        Approved
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">
                        {{ number_format($scheduledVisitationCount->total_count ?? 0) }}
                    </h4>
                    <p class="card-text text-center text-success" style="font-weight:bold;">
                        Scheduled
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Client Requests Summary</h4>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($totalClientRequestCount->total_count ?? 0) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        Total Client Visitation Requests
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($averageClientRequestPerDayCount ?? 0) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        AVG Client Visitation Requests per Day
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($averageClientRequestPerMonthCount ?? 0) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        AVG Client Visitation Requests per Month
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="monthlyChart"></canvas>

                                    <script>
                                        const ctx = document.getElementById('monthlyChart').getContext('2d');
                                        const monthlyChart = new Chart(ctx, {
                                            type: 'line',
                                            data: {
                                                labels: @json($labels),
                                                datasets: @json($datasets).map(dataset => ({
                                                    ...dataset,
                                                    fill: false,
                                                    spanGaps: false // Ensures graph breaks instead of connecting missing data
                                                }))
                                            },
                                            options: {
                                                responsive: true,
                                                interaction: {
                                                    mode: 'index',
                                                    intersect: false,
                                                },
                                                stacked: false,
                                                plugins: {
                                                    title: {
                                                        display: true,
                                                        text: 'Monthly Client Visitation Requests (Year-on-Year)'
                                                    }
                                                },
                                                scales: {
                                                    y: {
                                                        beginAtZero: true,
                                                        title: {
                                                            display: true,
                                                            text: 'Total Client Visitation Requests'
                                                        }
                                                    },
                                                    x: {
                                                        title: {
                                                            display: true,
                                                            text: 'Month'
                                                        }
                                                    }
                                                },
                                                elements: {
                                                    line: {
                                                        tension: 0 // ← Straight lines, not curves
                                                    }
                                                }
                                            }
                                        });
                                    </script>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Area Requests Summary</h4>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($totalAreaRequestTotal->total_area ?? 0, 2) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        Total Area Requests (ha)
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($averageAreaRequestPerDayTotal ?? 0, 2) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        AVG Area Requests per Day (ha)
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($averageAreaRequestPerMonthTotal ?? 0, 2) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        AVG Area Requests per Month (ha)
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="monthlyChartArea"></canvas>

                                    <script>
                                        const ctx2 = document.getElementById('monthlyChartArea').getContext('2d');
                                        const monthlyChartArea = new Chart(ctx2, {
                                            type: 'line',
                                            data: {
                                                labels: @json($labelsArea),
                                                datasets: @json($datasetsArea).map(dataset => ({
                                                    ...dataset,
                                                    fill: false,
                                                    spanGaps: false // Ensures graph breaks instead of connecting missing data
                                                }))
                                            },
                                            options: {
                                                responsive: true,
                                                interaction: {
                                                    mode: 'index',
                                                    intersect: false,
                                                },
                                                stacked: false,
                                                plugins: {
                                                    title: {
                                                        display: true,
                                                        text: 'Monthly Area Requests (Year-on-Year) - Hectares'
                                                    }
                                                },
                                                scales: {
                                                    y: {
                                                        beginAtZero: true,
                                                        title: {
                                                            display: true,
                                                            text: 'Total Area Requests (ha)'
                                                        }
                                                    },
                                                    x: {
                                                        title: {
                                                            display: true,
                                                            text: 'Month'
                                                        }
                                                    }
                                                },
                                                elements: {
                                                    line: {
                                                        tension: 0 // ← Straight lines, not curves
                                                    }
                                                }
                                            }
                                        });
                                    </script>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Clients Served Summary</h4>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($totalClientsServedCount->total_count ?? 0) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        Total Clients Served
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($averageClientsServedPerDayCount ?? 0) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        AVG Clients Served per Day
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($averageClientsServedPerMonthCount ?? 0) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        AVG Clients Served per Month
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="monthlyClientsServedChart"></canvas>

                                    <script>
                                        const ctx3 = document.getElementById('monthlyClientsServedChart').getContext('2d');
                                        const monthlyClientsServedChart = new Chart(ctx3, {
                                            type: 'line',
                                            data: {
                                                labels: @json($labelsClientsServed),
                                                datasets: @json($datasetsClientsServed).map(dataset => ({
                                                    ...dataset,
                                                    fill: false,
                                                    spanGaps: false // Ensures graph breaks instead of connecting missing data
                                                }))
                                            },
                                            options: {
                                                responsive: true,
                                                interaction: {
                                                    mode: 'index',
                                                    intersect: false,
                                                },
                                                stacked: false,
                                                plugins: {
                                                    title: {
                                                        display: true,
                                                        text: 'Monthly Clients Served (Year-on-Year)'
                                                    }
                                                },
                                                scales: {
                                                    y: {
                                                        beginAtZero: true,
                                                        title: {
                                                            display: true,
                                                            text: 'Total Clients Served'
                                                        }
                                                    },
                                                    x: {
                                                        title: {
                                                            display: true,
                                                            text: 'Month'
                                                        }
                                                    }
                                                },
                                                elements: {
                                                    line: {
                                                        tension: 0 // ← Straight lines, not curves
                                                    }
                                                }
                                            }
                                        });
                                    </script>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Areas Served Summary</h4>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($totalAreaServedTotal->total_area ?? 0,2) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        Total Areas Served (ha)
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($averageAreaServedPerDayTotal ?? 0,2) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        AVG Areas Served per Day (ha)
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($averageAreaServedPerMonthCount ?? 0,2) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        AVG Areas Served per Month (ha)
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="monthlyChartAreasServed"></canvas>

                                    <script>
                                        const ctx4 = document.getElementById('monthlyChartAreasServed').getContext('2d');
                                        const monthlyChartAreasServed = new Chart(ctx4, {
                                            type: 'line',
                                            data: {
                                                labels: @json($labelsAreaServed),
                                                datasets: @json($datasetsAreaServed).map(dataset => ({
                                                    ...dataset,
                                                    fill: false,
                                                    spanGaps: false // Ensures graph breaks instead of connecting missing data
                                                }))
                                            },
                                            options: {
                                                responsive: true,
                                                interaction: {
                                                    mode: 'index',
                                                    intersect: false,
                                                },
                                                stacked: false,
                                                plugins: {
                                                    title: {
                                                        display: true,
                                                        text: 'Monthly Areas Served (Year-on-Year) - Hectares'
                                                    }
                                                },
                                                scales: {
                                                    y: {
                                                        beginAtZero: true,
                                                        title: {
                                                            display: true,
                                                            text: 'Total Areas Served (ha)'
                                                        }
                                                    },
                                                    x: {
                                                        title: {
                                                            display: true,
                                                            text: 'Month'
                                                        }
                                                    }
                                                },
                                                elements: {
                                                    line: {
                                                        tension: 0 // ← Straight lines, not curves
                                                    }
                                                }
                                            }
                                        });
                                    </script>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-userlayout.layout>
