@extends('layouts.app')
@section('body')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-1 col-2">
                <a href="{{ route('homepage') }}" class="btn btn-primary">
                    <i class="fas fa-chevron-left"></i>
                </a>
            </div>
            <div class="col-md-11 col-10">
                <h3>Bạn muốn chia sẻ gì?</h3>
            </div>
            <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-12 mt-3">
                    <div class="form-group">
                        <label for="name">Biệt danh</label>
                        <input type="text" id="name" name="name" class="form-control">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="formFile" class="form-label">Ảnh nền <span class="text-danger">*</span></label>
                        <input class="form-control" name="image" type="file" id="formFile">
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="editor">Nơi viết gì đó...</label>
                        <textarea name="body" id="editor" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="d-flex justify-content-end w-100">
                        <button class="btn btn-primary">Đăng</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor');
    </script>
@endpush
