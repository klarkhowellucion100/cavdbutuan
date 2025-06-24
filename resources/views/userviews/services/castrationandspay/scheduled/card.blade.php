<x-userlayout.layout>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Vaccination Card</h4>
                    </div>
                    <div class="header-action">
                        <i data-toggle="collapse" data-target="#images-1">
                            <svg width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                            </svg>
                        </i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="pb-3">
                        <a href="{{ route('castrationandspay.user.scheduled.index') }}"
                            class="btn btn-primary waves-effect waves-light w-md">
                            Back
                        </a>
                    </div>

                    @if ($vaccinationCard->id === null)
                    @else
                        <!-- Show the uploaded image -->
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="text-primary" style="font-weight: bold">Client Name</td>
                                    <td>{{ $vaccinationCard->full_name }}</td>
                                </tr>
                                <tr>
                                    <td class="text-primary" style="font-weight: bold">Service Type</td>
                                    <td>{{ $vaccinationCard->service_type }}</td>
                                </tr>
                                <tr>
                                    <td class="text-primary" style="font-weight: bold">Animal Type</td>
                                    <td>{{ $vaccinationCard->animal_type }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="card-body text-center">
                            <img src="{{ asset('storage/' . $vaccinationCard->vaccination_card) }}"
                                class="img-fluid rounded" alt="Responsive image">
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-userlayout.layout>
