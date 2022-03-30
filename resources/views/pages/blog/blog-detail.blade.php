@extends('layout')
@section('content')
    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="blog__details__content">
                        <div class="blog__details__item">
                            <img src="img/blog/details/blog-details.jpg" alt="">
                            <div class="blog__details__item__title">
                                <span class="tip">{{ $post_detail->category->category_post_name }}</span>
                                <h4>{{ $post_detail->post_title }}</h4>
                                <ul>
                                    <li>by <span>Xau</span></li>
                                    <li>{{ date('d F, Y', strtotime($post_detail->created_at)) }}</li>
                                    <li>{{ $post_detail->post_view }} lượt xem</li>
                                </ul>
                            </div>
                        </div>
                        <div class="blog__details__quote">
                            <div class="icon"><i class="fa fa-quote-left"></i></div>
                            <p>{{ $post_detail->post_desc }}</p>
                        </div>
                        <div class="blog__details__desc">
                            {!! $post_detail->post_detail !!}
                        </div>
                        <div class="blog__details__tags">
                            <a href="#">Fashion</a>
                            <a href="#">Street style</a>
                            <a href="#">Diversity</a>
                            <a href="#">Beauty</a>
                        </div>
                        <div class="blog__details__btns">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="blog__details__btn__item">
                                        @isset($post_detail->prev)
                                            <h6><a href="{{ URL::to('/blog-detail/' . $post_detail->prev->post_slug) }}"><i
                                                        class="fa fa-angle-left"></i> Previous posts</a></h6>
                                        @endisset

                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="blog__details__btn__item blog__details__btn__item--next">
                                        @isset($post_detail->next)
                                            <h6><a href="{{ URL::to('/blog-detail/' . $post_detail->next->post_slug) }}">Next
                                                    posts <i class="fa fa-angle-right"></i></a></h6>
                                        @endisset

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog__details__comment">
                            <h5>Bình luận</h5>
                            <a href="#" class="leave-btn">Để lại bình luận</a>
                            @foreach ($post_detail->comment as $item)
                                <div class="blog__comment__item">
                                    <div class="blog__comment__item__pic">
                                        @if ($item->customer->customer_avatar != '')
                                            <img class="avac" src="{{ $item->customer->customer_avatar }}" alt="">
                                        @else
                                            <div class="cmt-avt">{{ $item->customer->customer_name[0] }}</div>
                                        @endif
                                    </div>
                                    <div class="blog__comment__item__text">
                                        <h6>{{ $item->customer->customer_name }}</h6>
                                        <p>{{ $item->post_comment_content }}</p>
                                        <ul>
                                            <li><i class="fa fa-clock-o"></i> {{ $item->post_comment_time }}</li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        @if (session('customer_id'))
                            <div class="mt-5">
                                <form>
                                    @csrf
                                    <textarea id="cmt" rows="3" placeholder="Viết bình luận ...."></textarea>
                                    <button id="post_cmt" type="button" data-post_id="{{ $post_detail->post_id }}"
                                        class="btn btn-danger">Gửi bình
                                        luận</button>
                                </form>
                            </div>
                        @else
                            <div>Bạn cần đăng nhập để bình luận sản phẩm này</div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="blog__sidebar">
                        <div class="blog__sidebar__item">
                            <div class="section-title-blog">
                                <h4>Danh mục bài viết</h4>
                            </div>
                            <ul>
                                @foreach ($category_post as $item)
                                    <li><a href="#">{{ $item->category_post_name }}
                                            <span>({{ count($item->count_post) }})</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="blog__sidebar__item">
                            <div class="section-title-blog">
                                <h4>Bài viết mới nhất</h4>
                            </div>
                            @foreach ($recent_post as $item)
                                <a href="{{ URL::to('/blog-detail/' . $item->post_slug) }}" class="blog__feature__item"
                                    title="{{ $item->post_title }}">
                                    <div class="blog__feature__item__pic">
                                        <img src="{{ URL::asset('uploads/post-img/' . $item->post_img) }}" width="80"
                                            alt="">
                                    </div>
                                    <div class="blog__feature__item__text">
                                        <h6 style="white-space: nowrap;
                                                        width: 200px;
                                                        overflow: hidden;
                                                        text-overflow: ellipsis;">{{ $item->post_title }}</h6>
                                        <span>{{ date('d F, Y', strtotime($item->created_at)) }}</span>
                                    </div>
                                </a>
                            @endforeach

                        </div>
                        <div class="blog__sidebar__item">
                            <div class="section-title-blog">
                                <h4>Tags cloud</h4>
                            </div>
                            <div class="blog__sidebar__tags">
                                <a href="#">Fashion</a>
                                <a href="#">Street style</a>
                                <a href="#">Diversity</a>
                                <a href="#">Beauty</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->

@endsection
