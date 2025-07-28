<x-userlayout.layout>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Reply</h4>
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
                        <a href="{{ route('contactus.userviews.index') }}"
                            class="btn btn-primary waves-effect waves-light w-md">
                            Back
                        </a>
                    </div>
                    <div class="pb-3">
                        <div class="table_responsive">
                            <table class="table">
                                <tr>
                                    <td style="font-weight: bold">Date</td>
                                    <td> {{ \Carbon\Carbon::parse($contactReplyEdit->created_at)->format('l, F j, Y') }}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="font-weight: bold">Name</td>
                                    <td>{{ $contactReplyEdit->name }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold">Email</td>
                                    <td>{{ $contactReplyEdit->email }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold">Contact Number</td>
                                    <td>{{ $contactReplyEdit->contact_number }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold">Message</td>
                                    <td>{{ $contactReplyEdit->message }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="pb-3">
                        <div class="table_responsive">
                            <table class="table">
                                @foreach ($contactRepliesCurrent as $currentReplies)
                                    <tr>
                                        <td style="font-weight: bold">Replied at: <span class="text-primary">{{ \Carbon\Carbon::parse($currentReplies->created_at)->format('l, F j, Y') }}</span></td>
                                        <td>{{ $currentReplies->reply }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="content col-lg-12 col-md-8 col-sm-12 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST"
                                        action="{{ route('contact.userviews.sendreply', $contactReplyEdit->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Reply</label>
                                            <textarea class="form-control" name="reply" id="exampleFormControlTextarea1" rows="3"
                                                placeholder="Reply Here..."></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary" id="submitBtn">Send
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="line"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-userlayout.layout>
