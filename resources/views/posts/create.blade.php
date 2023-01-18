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
                @error('message')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="col-12 mt-3">
                    <div class="form-group">
                        <label for="name">Biệt danh</label>
                        <input type="text" id="name" name="name" class="form-control">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="month">Tháng / năm</label>
                        <div class="row">
                            <div class="col-6">
                                <select name="month" class="form-control" id="">
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}"> Tháng {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-6">
                                <select name="year" class="form-control" id="">
                                    @for($i = 2023; $i <= 2033; $i++)
                                        <option value="{{ $i }}"> Năm {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="price_estimate">Chi phí dự kiến</label>
                        <input type="number" id="price_estimate" name="price_estimate" class="form-control">
                        <span id="amount-preview"></span>
                        @error('price_estimate')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="formFile" class="form-label">Hình ảnh <span class="text-danger">*</span></label>
                        <input class="form-control" name="image" type="file" id="formFile" accept="image/*">
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="editor">Nơi viết gì đó...</label>
                        <textarea name="body" id="editor" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-12 mt-3 mb-5">
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
        $(document).ready(function () {
            amountPreview();
        })
        $(document).on('keyup', '#price_estimate', (function () {
            let amount = $(this).val()
            $('#amount-preview').text(addCommas(amount) + ' đồng')
        }))

        function amountPreview ()
        {
            let amount = $('#price_estimate').val()
            if (amount > 0) {
                $('#amount-preview').text(addCommas(amount) + ' đồng')
            } else {
                $('#amount-preview').text('')
            }
        }

        function addCommas(nStr)
        {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }
    </script>
@endpush
