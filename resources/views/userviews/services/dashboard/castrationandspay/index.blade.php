<x-userlayout.layout>

    <div class="container mb-3">
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-inline p-0 m-0 text-center">
                    <li class="">
                        <div class="btn-group btn-group-toggle">
                            <a class="button btn button-icon btn-outline-primary fw-bold"
                                href="{{ route('dashboard.farmmechanization') }}">
                                Farm Mechanization
                            </a>
                            <a class="button btn button-icon bg-primary"
                                href="{{ route('dashboard.castrationandspay') }}">
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
                <h4 class="font-weight-bold">Castration and Spay Request Status</h4>
                <form action="{{ route('dashboard.castrationandspay.search') }}" method="POST">
                    @csrf
                    <div class="form-group mb-0 d-flex flex-row">
                        <div class="date-icon-set">
                            <input type="date" name="start" class="form-control" value="{{ $filterDateFrom }}"
                                placeholder="From Date">
                        </div>
                        <span class="flex-grow-0">
                            <span class="btn">To</span>
                        </span>
                        <div class="date-icon-set">
                            <input type="date" name="end" value="{{ $filterDateTo }}" class="form-control"
                                placeholder="To Date">
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
                        {{ number_format($totalClientRequestCount->total_count ?? 0) }}
                    </h4>
                    <p class="card-text text-center text-warning" style="font-weight:bold;">
                        Requests
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">
                        {{ number_format($totalClientsServedCount->total_count ?? 0) }}
                    </h4>
                    <p class="card-text text-center text-success" style="font-weight:bold;">
                        Served
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Overall Requests</h4>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($totalOverallRequestCount->total_count ?? 0) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        Total Requests
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($averageOverallRequestPerDayCount ?? 0) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        AVG Requests per Day
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($averageOverallRequestPerMonthCount ?? 0) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        AVG Requests per Month
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="monthlyChartOverall"></canvas>

                                    <script>
                                        const ctxOverall = document.getElementById('monthlyChartOverall').getContext('2d');
                                        const monthlyChartOverall = new Chart(ctxOverall, {
                                            type: 'line',
                                            data: {
                                                labels: @json($labelsOverall),
                                                datasets: @json($datasetsOverall).map(dataset => ({
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
                                                        text: 'Monthly Requests (Year-on-Year)'
                                                    }
                                                },
                                                scales: {
                                                    y: {
                                                        beginAtZero: true,
                                                        title: {
                                                            display: true,
                                                            text: 'Total Requests'
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
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="overallPieChart"></canvas>

                                    <script>
                                        const ctxOverallGroup = document.getElementById('overallPieChart').getContext('2d');

                                        const dataOverall = {
                                            labels: {!! json_encode($animalGroupOverall->pluck('animal_type')) !!},
                                            datasets: [{
                                                label: 'Number of Requests',
                                                data: {!! json_encode($animalGroupOverall->pluck('total_per_group')) !!},
                                                backgroundColor: [
                                                    '#FF6384', '#36A2EB', '#FFCE56', '#8BC34A', '#9C27B0',
                                                    '#FF5722', '#795548', '#03A9F4', '#00BCD4', '#CDDC39'
                                                ],
                                                borderColor: '#333',
                                                borderWidth: 1
                                            }]
                                        };

                                        const configOverall = {
                                            type: 'bar',
                                            data: dataOverall,
                                            options: {
                                                responsive: true,
                                                plugins: {
                                                    legend: {
                                                        display: false
                                                    },
                                                    title: {
                                                        display: true,
                                                        text: 'Requests Count by Animal Type'
                                                    }
                                                },
                                                scales: {
                                                    y: {
                                                        beginAtZero: true,
                                                        title: {
                                                            display: true,
                                                            text: 'Count'
                                                        }
                                                    },
                                                    x: {
                                                        title: {
                                                            display: true,
                                                            text: 'Animal Type'
                                                        }
                                                    }
                                                }
                                            },
                                        };

                                        new Chart(ctxOverallGroup, configOverall);
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
                    <h4 class="card-title">Requests Served</h4>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($totalOverallServedCount->total_count ?? 0) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        Total Requests Served
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($averageOverallServedPerDayCount ?? 0) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        AVG Requests Served per Day
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($averageOverallServedPerMonthCount ?? 0) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        AVG Requests Served per Month
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="monthlyChartOverallServed"></canvas>

                                    <script>
                                        const ctxOverallServed = document.getElementById('monthlyChartOverallServed').getContext('2d');
                                        const monthlyChartOverallServed = new Chart(ctxOverallServed, {
                                            type: 'line',
                                            data: {
                                                labels: @json($labelsOverallServed),
                                                datasets: @json($datasetsOverallServed).map(dataset => ({
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
                                                        text: 'Monthly Requests Served (Year-on-Year)'
                                                    }
                                                },
                                                scales: {
                                                    y: {
                                                        beginAtZero: true,
                                                        title: {
                                                            display: true,
                                                            text: 'Total Requests Served'
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
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="overallServedBarChart"></canvas>

                                    <script>
                                        const ctxOverallServedGroup = document.getElementById('overallServedBarChart').getContext('2d');

                                        const dataOverallServedGroup = {
                                            labels: {!! json_encode($animalGroupOverallServed->pluck('animal_type')) !!},
                                            datasets: [{
                                                label: 'Number of Request Served',
                                                data: {!! json_encode($animalGroupOverallServed->pluck('total_per_group')) !!},
                                                backgroundColor: [
                                                    '#FF6384', '#36A2EB', '#FFCE56', '#8BC34A', '#9C27B0',
                                                    '#FF5722', '#795548', '#03A9F4', '#00BCD4', '#CDDC39'
                                                ],
                                                borderColor: '#333',
                                                borderWidth: 1
                                            }]
                                        };

                                        const configOverallServedGroup = {
                                            type: 'bar',
                                            data: dataOverallServedGroup,
                                            options: {
                                                responsive: true,
                                                plugins: {
                                                    legend: {
                                                        display: false
                                                    },
                                                    title: {
                                                        display: true,
                                                        text: 'Served Count by Animal Type'
                                                    }
                                                },
                                                scales: {
                                                    y: {
                                                        beginAtZero: true,
                                                        title: {
                                                            display: true,
                                                            text: 'Count'
                                                        }
                                                    },
                                                    x: {
                                                        title: {
                                                            display: true,
                                                            text: 'Animal Type'
                                                        }
                                                    }
                                                }
                                            },
                                        };

                                        new Chart(ctxOverallServedGroup, configOverallServedGroup);
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
                    <h4 class="card-title">Castration Requests</h4>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($totalCastrationRequestCount->total_count ?? 0) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        Total Castration Requests
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($averageCastrationRequestPerDayCount ?? 0) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        AVG Castration Requests per Day
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($averageCastrationRequestPerMonthCount ?? 0) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        AVG Castration Requests per Month
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="monthlyChartCastration"></canvas>

                                    <script>
                                        const ctxCastration = document.getElementById('monthlyChartCastration').getContext('2d');
                                        const monthlyChart = new Chart(ctxCastration, {
                                            type: 'line',
                                            data: {
                                                labels: @json($labelsCastration),
                                                datasets: @json($datasetsCastration).map(dataset => ({
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
                                                        text: 'Monthly Castration Requests (Year-on-Year)'
                                                    }
                                                },
                                                scales: {
                                                    y: {
                                                        beginAtZero: true,
                                                        title: {
                                                            display: true,
                                                            text: 'Total Castration Requests'
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
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="castrationPieChart"></canvas>

                                    <script>
                                        const ctxCastrationGroup = document.getElementById('castrationPieChart').getContext('2d');

                                        const data = {
                                            labels: {!! json_encode($animalGroupCastration->pluck('animal_type')) !!},
                                            datasets: [{
                                                label: 'Number of Castrations',
                                                data: {!! json_encode($animalGroupCastration->pluck('total_per_group')) !!},
                                                backgroundColor: [
                                                    '#FF6384', '#36A2EB', '#FFCE56', '#8BC34A', '#9C27B0',
                                                    '#FF5722', '#795548', '#03A9F4', '#00BCD4', '#CDDC39'
                                                ],
                                                borderColor: '#333',
                                                borderWidth: 1
                                            }]
                                        };

                                        const config = {
                                            type: 'bar',
                                            data: data,
                                            options: {
                                                responsive: true,
                                                plugins: {
                                                    legend: {
                                                        display: false
                                                    },
                                                    title: {
                                                        display: true,
                                                        text: 'Castration Count by Animal Type'
                                                    }
                                                },
                                                scales: {
                                                    y: {
                                                        beginAtZero: true,
                                                        title: {
                                                            display: true,
                                                            text: 'Count'
                                                        }
                                                    },
                                                    x: {
                                                        title: {
                                                            display: true,
                                                            text: 'Animal Type'
                                                        }
                                                    }
                                                }
                                            },
                                        };

                                        new Chart(ctxCastrationGroup, config);
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
                    <h4 class="card-title">Castration Served</h4>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($totalCastrationServedCount->total_count ?? 0) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        Total Castration Requests Served
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($averageCastrationServedPerDayCount ?? 0) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        AVG Castration Requests Served per Day
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($averageCastrationServedPerMonthCount ?? 0) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        AVG Castration Requests Served per Month
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="monthlyChartCastrationServed"></canvas>

                                    <script>
                                        const ctxCastrationServed = document.getElementById('monthlyChartCastrationServed').getContext('2d');
                                        const monthlyChartCastrationServed = new Chart(ctxCastrationServed, {
                                            type: 'line',
                                            data: {
                                                labels: @json($labelsCastrationServed),
                                                datasets: @json($datasetsCastrationServed).map(dataset => ({
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
                                                        text: 'Monthly Castration Requests Served (Year-on-Year)'
                                                    }
                                                },
                                                scales: {
                                                    y: {
                                                        beginAtZero: true,
                                                        title: {
                                                            display: true,
                                                            text: 'Total Castration Requests Served'
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
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="castrationServedBarChart"></canvas>

                                    <script>
                                        const ctxCastrationServedGroup = document.getElementById('castrationServedBarChart').getContext('2d');

                                        const dataCastrationServedGroup = {
                                            labels: {!! json_encode($animalGroupCastrationServed->pluck('animal_type')) !!},
                                            datasets: [{
                                                label: 'Number of Castrations',
                                                data: {!! json_encode($animalGroupCastrationServed->pluck('total_per_group')) !!},
                                                backgroundColor: [
                                                    '#FF6384', '#36A2EB', '#FFCE56', '#8BC34A', '#9C27B0',
                                                    '#FF5722', '#795548', '#03A9F4', '#00BCD4', '#CDDC39'
                                                ],
                                                borderColor: '#333',
                                                borderWidth: 1
                                            }]
                                        };

                                        const configCastrationServedGroup = {
                                            type: 'bar',
                                            data: dataCastrationServedGroup,
                                            options: {
                                                responsive: true,
                                                plugins: {
                                                    legend: {
                                                        display: false
                                                    },
                                                    title: {
                                                        display: true,
                                                        text: 'Castration Served Count by Animal Type'
                                                    }
                                                },
                                                scales: {
                                                    y: {
                                                        beginAtZero: true,
                                                        title: {
                                                            display: true,
                                                            text: 'Count'
                                                        }
                                                    },
                                                    x: {
                                                        title: {
                                                            display: true,
                                                            text: 'Animal Type'
                                                        }
                                                    }
                                                }
                                            },
                                        };

                                        new Chart(ctxCastrationServedGroup, configCastrationServedGroup);
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
                    <h4 class="card-title">Spay Requests</h4>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($totalSpayRequestCount->total_count ?? 0) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        Total Spay Requests
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($averageSpayRequestPerDayCount ?? 0) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        AVG Spay Requests per Day
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($averageSpayRequestPerMonthCount ?? 0) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        AVG Spay Requests per Month
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="monthlyChartSpay"></canvas>

                                    <script>
                                        const ctxSpay = document.getElementById('monthlyChartSpay').getContext('2d');
                                        const monthlyChartSpay = new Chart(ctxSpay, {
                                            type: 'line',
                                            data: {
                                                labels: @json($labelsSpay),
                                                datasets: @json($datasetsSpay).map(dataset => ({
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
                                                        text: 'Monthly Spay Requests (Year-on-Year)'
                                                    }
                                                },
                                                scales: {
                                                    y: {
                                                        beginAtZero: true,
                                                        title: {
                                                            display: true,
                                                            text: 'Total Spay Requests'
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
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="spayPieChart"></canvas>

                                    <script>
                                        const ctxSpayGroup = document.getElementById('spayPieChart').getContext('2d');

                                        const dataSpayGroup = {
                                            labels: {!! json_encode($animalGroupSpay->pluck('animal_type')) !!},
                                            datasets: [{
                                                label: 'Number of Spay',
                                                data: {!! json_encode($animalGroupSpay->pluck('total_per_group')) !!},
                                                backgroundColor: [
                                                    '#FF6384', '#36A2EB', '#FFCE56', '#8BC34A', '#9C27B0',
                                                    '#FF5722', '#795548', '#03A9F4', '#00BCD4', '#CDDC39'
                                                ],
                                                borderColor: '#333',
                                                borderWidth: 1
                                            }]
                                        };

                                        const configSpay = {
                                            type: 'bar',
                                            data: dataSpayGroup,
                                            options: {
                                                responsive: true,
                                                plugins: {
                                                    legend: {
                                                        display: false
                                                    },
                                                    title: {
                                                        display: true,
                                                        text: 'Spay Count by Animal Type'
                                                    }
                                                },
                                                scales: {
                                                    y: {
                                                        beginAtZero: true,
                                                        title: {
                                                            display: true,
                                                            text: 'Count'
                                                        }
                                                    },
                                                    x: {
                                                        title: {
                                                            display: true,
                                                            text: 'Animal Type'
                                                        }
                                                    }
                                                }
                                            },
                                        };

                                        new Chart(ctxSpayGroup, configSpay);
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
                    <h4 class="card-title">Spay Served</h4>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($totalSpayServedCount->total_count ?? 0) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        Total Spay Requests Served
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($averageSpayServedPerDayCount ?? 0) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        AVG Spay Requests Served per Day
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        {{ number_format($averageSpayServedPerMonthCount ?? 0) }}
                                    </h4>
                                    <p class="card-text text-center text-primary" style="font-weight:bold;">
                                        AVG Spay Requests Served per Month
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="monthlyChartSpayServed"></canvas>

                                    <script>
                                        const ctxSpayServed = document.getElementById('monthlyChartSpayServed').getContext('2d');
                                        const monthlyChartSpayServed = new Chart(ctxSpayServed, {
                                            type: 'line',
                                            data: {
                                                labels: @json($labelsSpayServed),
                                                datasets: @json($datasetsSpayServed).map(dataset => ({
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
                                                        text: 'Monthly Spay Requests Served (Year-on-Year)'
                                                    }
                                                },
                                                scales: {
                                                    y: {
                                                        beginAtZero: true,
                                                        title: {
                                                            display: true,
                                                            text: 'Total Spay Requests Served'
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
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <canvas id="spayServedBarChart"></canvas>

                                    <script>
                                        const ctxSpayServedGroup = document.getElementById('spayServedBarChart').getContext('2d');

                                        const dataSpayServedGroup = {
                                            labels: {!! json_encode($animalGroupSpayServed->pluck('animal_type')) !!},
                                            datasets: [{
                                                label: 'Number of Spay',
                                                data: {!! json_encode($animalGroupSpayServed->pluck('total_per_group')) !!},
                                                backgroundColor: [
                                                    '#FF6384', '#36A2EB', '#FFCE56', '#8BC34A', '#9C27B0',
                                                    '#FF5722', '#795548', '#03A9F4', '#00BCD4', '#CDDC39'
                                                ],
                                                borderColor: '#333',
                                                borderWidth: 1
                                            }]
                                        };

                                        const configSpayServedGroup = {
                                            type: 'bar',
                                            data: dataSpayServedGroup,
                                            options: {
                                                responsive: true,
                                                plugins: {
                                                    legend: {
                                                        display: false
                                                    },
                                                    title: {
                                                        display: true,
                                                        text: 'Spay Served Count by Animal Type'
                                                    }
                                                },
                                                scales: {
                                                    y: {
                                                        beginAtZero: true,
                                                        title: {
                                                            display: true,
                                                            text: 'Count'
                                                        }
                                                    },
                                                    x: {
                                                        title: {
                                                            display: true,
                                                            text: 'Animal Type'
                                                        }
                                                    }
                                                }
                                            },
                                        };

                                        new Chart(ctxSpayServedGroup, configSpayServedGroup);
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
