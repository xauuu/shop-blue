@extends('admin-layout')
@section('content')
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="card mt-1">
                <div class="card-header">
                    <h2 class="mt-3">Cập nhật câu hỏi</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ URL::to('/admin/faq/update-faq') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="faq_id" value="{{ $faq->faq_id }}">
                        <div class="mb-3">
                            <label class="form-label">Câu hỏi</label>
                            <input type="text" class="form-control" name="faq_question" value="{{ $faq->faq_question }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Câu trả lời</label>
                            <textarea id="xau" class="form-control" name="faq_answer" rows="3">{{ $faq->faq_answer }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật câu hỏi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    CKEDITOR.replace('xau');
</script>
@endpush
