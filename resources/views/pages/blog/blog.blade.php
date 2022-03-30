@extends('layout')
@section('content')
    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                @foreach ($post as $item)
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic set-bg" data-setbg="{{ URL::asset('uploads/post-img/'.$item->post_img) }}"></div>
                            <div class="blog__item__text">
                                <h6><a href="{{ URL::to('/blog-detail/'.$item->post_slug) }}">{{ $item->post_title }}</a></h6>
                                <ul>
                                    <li>by <span>Xấu</span></li>
                                    <li>{{ date('d F, Y', strtotime($item->created_at)) }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-lg-12 text-center">
                    <a href="#" class="primary-btn load-btn">Load more posts</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection
