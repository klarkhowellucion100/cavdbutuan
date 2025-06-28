<x-guestlayout.layout>
    <section id="page-content" class="sidebar-right">
        <div class="container">
            <div class="row">
                <!-- content -->
                <div class="content col-lg-12">
                    <!-- Blog -->
                    <div id="blog" class="single-post">
                        <!-- Post single item-->
                        <div class="post-item">
                            <div class="post-item-wrap">
                                <div class="post-image">
                                    <a href="#">
                                        <img alt="" src="{{ asset('storage/' . $news->image) }}" />
                                    </a>
                                </div>
                                <div class="post-item-description">
                                    <h2>{{ $news->title }}</h2>
                                    <div class="post-meta">
                                        <span class="post-meta-date"><i class="fa fa-calendar-o"></i>
                                            {{ \Carbon\Carbon::parse($news->published_at)->format('l, F j, Y') }}
                                        </span>
                                    </div>
                                    <div style="text-align: justify; line-height: 1.6em;">
                                        {!! nl2br(e($news->content)) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end: Post single item-->
                    </div>
                </div>
                <!-- end: content -->
            </div>
        </div>
    </section>
</x-guestlayout.layout>
