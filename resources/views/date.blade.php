@extends('layouts.app')
@push('css')
    <style>
        table input {
            width: 40px;
        }
        .color-1 {
            background: cadetblue !important;
        }

        .color-2 {
            background: chocolate !important;;
        }

        .color-3 {
            background: darkgoldenrod !important;;
        }

        .color-4 {
            background: forestgreen !important;;
        }

        .color-5 {
            background: brown !important;;
        }

        .color-6 {
            background: blueviolet !important;;
        }

        .color-7 {
            background: fuchsia !important;;
        }

        .color-8 {
            background: darkblue !important;;
        }

        .color-9 {
            background: black !important;;
        }

        .color {
            width: 60px;
            height: 40px;
        }
    </style>
@endpush
@section('content')
    <div class="container mt-4">
        <form method="post">
            @csrf
            <div class="row">
                @foreach ($months as $key => $month)
                    <div class="col-12 table-responsive">
                        <h4>Tháng {{ $key }}</h4>
                        <table class="table table-bordered  text-center border">
                            <tr>
                                @for($i = 1; $i <= 11; $i++)
                                    <th>{{ $i }}</th>
                                @endfor
                            </tr>
                            <tr>
                                @if ($key < 10)
                                @php
                                    $key = '0' . $key
                                @endphp
                                @endif
                                @for($i = 1; $i <= 11; $i++)
                                        @if ($i < 10)
                                            @php
                                                $i = '0' . $i
                                            @endphp
                                        @endif
                                    <td>
                                        <input class="text-center" type="text" name="days[{{ "$year-$key-$i" }}]" value="{{ @$dates["$year-$key-$i"] }}">
                                    </td>
                                @endfor
                            </tr>
                            <tr>
                                @for($i = 12; $i <= 22; $i++)
                                    <th>{{ $i }}</th>
                                @endfor
                            </tr>
                            <tr>
                                @for($i = 12; $i <= 22; $i++)
                                    <td>
                                        <input class="text-center" type="text" name="days[{{ "$year-$key-$i" }}]" value="{{ @$dates["$year-$key-$i"] }}">
                                    </td>
                                @endfor
                            </tr>
                            <tr>
                                @for($i = 23; $i <= $month; $i++)
                                    <th>{{ $i }}</th>
                                @endfor
                            </tr>
                            <tr>
                                @for($i = 23; $i <= $month; $i++)
                                    <td>
                                        <input class="text-center" type="text" name="days[{{ "$year-$key-$i" }}]" value="{{ @$dates["$year-$key-$i"] }}">
                                    </td>
                                @endfor
                            </tr>
                        </table>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <button class="btn btn-success px-5">Save</button>
                </div>
            </div>
        </form>
        <form method="get">
            <div class="row mt-4">
                <div class="col-3">
                    <input type="date" name="from_date" class="form-control" value="2022-01-01">
                </div>
                <div class="col-3">
                    <input type="date" name="to_date" class="form-control" value="2022-12-31">
                </div>
                <div class="col-2">
                    <button class="btn btn-success px-5">Filter</button>
                </div>
            </div>
        </form>
        <div class="row mt-4">
            <div class="col-12">
                <table class="table table-bordered font-weight-bold text-center">
                    <tr>
                        @for($i = 0; $i <= 30; $i++)
                            <td class="color-{{ @$numbers[$i] }}">{{ $i }}</td>
                        @endfor
                    </tr>
                    <tr>
                        @for($i = 31; $i <= 61; $i++)
                            <td class="color-{{ @$numbers[$i] }}">{{ $i }}</td>
                        @endfor
                    </tr>
                    <tr>
                        @for($i = 61; $i <= 91; $i++)
                            <td class="color-{{ @$numbers[$i] }}">{{ $i }}</td>
                        @endfor
                    </tr>
                    <tr>
                        @for($i = 91; $i <= 99; $i++)
                            <td class="color-{{ @$numbers[$i] }}">{{ $i }}</td>
                        @endfor
                    </tr>
                </table>
            </div>
        </div>
        <div class="row my-4">
            @for($i = 1; $i < 10; $i++)
            <div class="col-3">
                <div class="d-flex align-items-center">
                    <div class="mx-3 my-1 color color-{{ $i }}">
                    </div>
                    Trùng lặp {{ $i }}
                </div>
            </div>
            @endfor
        </div>
    </div>
@endsection
