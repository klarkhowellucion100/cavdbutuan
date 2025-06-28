<x-guestlayout.layout>
    <section id="page-content">
        <div class="container">
            <!-- post content -->
            <!-- Page title -->
            <div class="page-title">
                <h1>NEWS - CAVD ON THE MOVE</h1>
            </div>
            <!-- end: Page title -->
            <!-- Blog -->
            <form method="GET" action="{{ route('news.guest.index') }}" class="mb-3 d-flex gap-2 align-items-center">
                <input type="text" name="search" class="form-control"
                    placeholder="Search by name, transaction no., etc." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
                @if (request('search'))
                    <a href="{{ route('news.guest.index') }}" class="btn btn-secondary">Clear</a>
                @endif
            </form>
            <div id="blog" class="grid-layout post-4-columns m-b-30" data-item="post-item">

                <!-- Post item-->
                @foreach ($news as $perNews)
                    <div class="post-item border">
                        <div class="post-item-wrap">
                            <div class="post-image">
                                <a href="{{ route('news.guest.show', $perNews->id) }}">
                                    <img alt="" src="{{ asset('storage/' . $perNews->image) }}">
                                </a>
                                <span class="post-meta-category"><a
                                        href="{{ route('news.guest.show', $perNews->id) }}">CAVD</a></span>
                            </div>
                            <div class="post-item-description">
                                <span class="post-meta-date"><i class="fa fa-calendar-o"></i>
                                    {{ \Carbon\Carbon::parse($perNews->published_at)->format('l, F j, Y') }}
                                </span>
                                <h2><a href="{{ route('news.guest.show', $perNews->id) }}">{{ $perNews->title }}</a>
                                </h2>
                                </a></h2>
                                @php
                                    $lettersOnly = preg_replace('/[^a-zA-Z]/', '', $perNews->content);
                                    $limit = 200;
                                    $letterCount = 0;
                                    $result = '';

                                    for ($i = 0; $i < strlen($perNews->content); $i++) {
                                        if (ctype_alpha($perNews->content[$i])) {
                                            $letterCount++;
                                        }
                                        if ($letterCount > $limit) {
                                            break;
                                        }
                                        $result .= $perNews->content[$i];
                                    }
                                @endphp
                                <p>
                                    {{ $result }}...
                                </p>
                                <a href="{{ route('news.guest.show', $perNews->id) }}" class="item-link">Read More <i
                                        class="icon-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- end: Post item-->
            </div>
            <!-- end: Blog -->
            <!-- Pagination -->
            <ul class="pagination">
                {{ $news->appends(request()->query())->links() }}
            </ul>
            <!-- end: Pagination -->
        </div>
        <!-- end: post content -->
    </section>
</x-guestlayout.layout>
