@extends('admin-layout')
@section('content')
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="card mt-4">
                <div class="card-header">
                    <h2 class="mt-3">Thông tin liên hệ</h2>
                    @if (session('success'))
                        <div class="alert alert-primary alert-dismissible col-6" role="alert">
                            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                            <div class="alert-icon">
                                <i class="far fa-fw fa-bell"></i>
                            </div>
                            <div class="alert-message">
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ URL::to('/admin/update-contact') }}">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" name="contact_address"
                                value="{{ $contact->contact_address }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Công ty</label>
                            <input type="text" class="form-control" name="contact_company"
                                value="{{ $contact->contact_company }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" name="contact_phone"
                                value="{{ $contact->contact_phone }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="contact_email"
                                value="{{ $contact->contact_email }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Sửa thông tin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
