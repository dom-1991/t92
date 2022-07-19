@extends('layouts.master')
@section('main')
    <div class="box">
        <img src="{{ asset('images/sliders/slider-1.jpg') }}" alt="" style="width: 100%">
    </div>
    <div style="display: none">
        <audio controls autoplay id="audio">
            <source src="{{ asset('audio/audio.mp3') }}" type="audio/mpeg">
        </audio>
    </div>
    <button id="button">Play</button>
@endsection
@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#button').click(function () {
                document.getElementById('audio').play();
            })
            $
        });
    </script>
@endpush
