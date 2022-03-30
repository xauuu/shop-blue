@extends('layout')
@section('content')
    <!-- Page info -->
    <div class="page-top-info">
        <div class="container">
            <h4>Liên hệ</h4>
            <div class="site-pagination">
                <a href="{{ URL::to('/home') }}">Trang chủ</a> /
                <a href="{{ URL::to('/contact') }}">Liên hệ</a>
            </div>
        </div>
    </div>
    <!-- Page info end -->


    <!-- Contact section -->
    <section class="contact-section mb-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 contact-info">
                    <h3>Liên hệ với tôi</h3>
                    <p>{{ $contact->contact_address }}</p>
                    <p>{{ $contact->contact_phone }}</p>
                    <p>{{ $contact->contact_email }}</p>
                    <div class="contact-social">
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-dribbble"></i></a>
                        <a href="#"><i class="fa fa-behance"></i></a>
                    </div>
                    <form class="contact-form">
                        <input type="text" placeholder="Your name">
                        <input type="text" placeholder="Your e-mail">
                        <textarea placeholder="Message"></textarea>
                        <button class="site-btn">SEND NOW</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="map"><iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3835.7726087400624!2d108.24756751433559!3d15.97324694624704!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142108878ee1dbf%3A0xb466fcf06b910a38!2zS2hvYSBDw7RuZyBuZ2jhu4cgdGjDtG5nIHRpbiB2w6AgVHJ1eeG7gW4gdGjDtG5nIC0gxJDhuqFpIGjhu41jIMSQw6AgTuG6tW5n!5e0!3m2!1svi!2s!4v1608540398473!5m2!1svi!2s"
                width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                tabindex="0"></iframe></div>
    </section>
    <!-- Contact section end -->
@endsection
