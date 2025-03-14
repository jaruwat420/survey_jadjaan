<section class="fp__blog fp__blog2">
    <div class="fp__blog_overlay pt_95 pt_xs_60 pb_100 xs_pb_70">
        <div class="container">
            <div class="row wow fadeInUp" data-wow-duration="1s">
                <div class="col-md-8 col-lg-7 col-xl-6 m-auto text-center">
                    <div class="fp__section_heading mb_25">
                        <h4>-ข่าว & บล็อก</h4>
                        <h2>บล็อกข่าวล่าสุดของเรา</h2>
                        <span>
                            <img src="images/heading_shapes.png" alt="shapes" class="img-fluid w-100">
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($blogs as $blog)
                <div class="col-xl-4 col-sm-6 col-lg-4 wow fadeInUp" data-wow-duration="1s">
                    <div class="fp__single_blog">
                        <a href="#" class="fp__single_blog_img">
                            <img src="{{ asset($blog->image) }}" alt="blog"
                                class="img-fluid w-100">
                        </a>
                        <div class="fp__single_blog_text">
                            <a class="category" href="#">{{ $blog->blog_type }}</a>
                            <ul class="d-flex flex-wrap mt_15">
                                <li><i class="fas fa-user"></i>{{ $blog->user_name }}</li>
                                <li><i class="fas fa-calendar-alt"></i>{{ $blog->created_at}}</li>
                            </ul>
                            <a class="title" href="{{ $blog->blog_link }}">{{ $blog->blog_title }}</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
