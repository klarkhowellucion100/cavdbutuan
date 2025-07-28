<x-userlayout.layout>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="p-3">Messages List</h5>
                        <form method="GET" action="{{ route('contactus.userviews.index') }}"
                            class="mb-3 d-flex gap-2 align-items-center">
                            <input type="text" name="search" class="form-control"
                                placeholder="Search by name, transaction no., etc." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">Search</button>
                            @if (request('search'))
                                <a href="{{ route('contactus.userviews.index') }}" class="btn btn-secondary">Clear</a>
                            @endif
                        </form>
                        <div class="table-responsive">
                            <form id="operationForm" method="POST">
                                @csrf
                                <table class="table align-middle text-center">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Contact No.</th>
                                            <th>Email</th>
                                            <th>Message</th>
                                            <th>Status</th>
                                            <th>Reply</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($messages as $perMessage)
                                            <tr>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($perMessage->created_at)->format('l, F j, Y') }}
                                                </td>
                                                <td>
                                                    {{ $perMessage->name }}
                                                </td>
                                                <td>
                                                    {{ $perMessage->contact_number }}
                                                </td>
                                                <td>
                                                    {{ $perMessage->email }}
                                                </td>
                                                <td>
                                                    {{ $perMessage->message }}
                                                </td>
                                                <td>
                                                    @if ($perMessage->email_status == 1)
                                                        <span class="text-success" style="font-weight: bold;">Replied</span>
                                                    @else
                                                       <span class="text-danger" style="font-weight: bold;">Pending</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('contactus.userviews.reply', $perMessage->id) }}"
                                                        class="btn btn-sm btn-outline-success">
                                                        <i class="">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
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
                            {{ $messages->appends(request()->query())->links() }}
                        </x-paginationlayout>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-userlayout.layout>
