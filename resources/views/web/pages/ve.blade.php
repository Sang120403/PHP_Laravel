@php use Illuminate\Support\Facades\Auth; @endphp
@extends('web.layout.index')
@section('css')
    .vnpay-red {
    color: #e50019;
    font-weight: 700;
    }
    .vnpay-blue {
    color: #004a9c;
    font-weight: 700;
    }
    .vnpay-logo>sup {
    line-height: 1;
    font-size: 60%;
    top: -1em;
    }
    .vnpay-red {
    color: #e50019;
    font-weight: 700;
    }
@endsection
@section('content')
    <section class="container-fluid clearfix row">
        {{--  Breadcrumb  --}}
        <nav aria-label="breadcrumb mt-5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="link link-dark">@lang('lang.home')</a></li>
                <li class="breadcrumb-item"><a href="#" class="link link-dark">@lang('lang.movie_is_playing')</a></li>
                <li class="breadcrumb-item"><a href="/chitiet_phim/{{ $movie->id_phim }}" class="link link-dark">{{ $movie->ten_phim }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="#" class="link link-secondary disabled text-decoration-none">@lang('lang.ticket')</a>
                </li>
            </ol>
        </nav>

        <div class="row">
            {{--Thông tin vé--}}
            <div class="col-12 col-lg-3">
                <h4>@lang('lang.ticket_information')</h4>
                <div id="ticket_info" class="card mb-3 bg-dark text-light px-0 sticky-top">
                    <div class="row">
                        <div class="col-12 col-md-3 col-lg-12 d-flex justify-content-center">
                            @if(strstr($movie->image,"https") == "")
                                <img class="img p-3 w-100" alt="..." style="max-height: 361px; max-width: 241px"
                                     src="images/phim/{{ $movie->image }}">
                            @else
                                <img class="img p-3 w-100" alt="..." style="max-height: 361px; max-width: 241px"
                                     src="images/phim/{{ $movie->image }}">
                            @endif
                        </div>
                        <div class="col-12 col-md-9 col-lg-12">
                            <div class="card-body">
                                <h5 class="card-title">{{ $movie->ten_phim }}</h5>
                                <ul class="list-group">
                                    <li class="list-group-item bg-transparent text-light border-0">
                                        @lang('lang.showtime_web'):
                                        <strong class="ps-2">
                                            {{ date('d/m/Y', strtotime($schedule->ngay)).' '.date('H:i', strtotime($schedule->gio_bat_dau)) }}
                                        </strong>
                                    </li>
                                    <li class="list-group-item bg-transparent text-light border-0">
                                        @lang('lang.theater'): <strong class="ps-2">{{ $room->raps->ten_rap }}</strong>
                                    </li>
                                    <li class="list-group-item bg-transparent text-light border-0">
                                        @lang('lang.room'): <strong class="ps-2">{{ $room->ten_phong }}</strong>
                                    </li>
                                    <li class="list-group-item bg-transparent text-light border-0">
                                        @lang('lang.rated'): <strong class="ps-2">
                                        <span class="badge @if($movie->rating->ten_gioi_han == 'C18') bg-danger
                                                            @elseif($movie->rating->ten_gioi_han == 'C16') bg-warning
                                                            @elseif($movie->rating->ten_gioi_han == 'C13') bg-success
                                                            @elseif($movie->rating->ten_gioi_han == 'P') bg-primary
                                                            @else bg-info
                                                            @endif me-1">
                                            {{ $movie->rating->ten_gioi_han }}
                                        </span> - {{ $movie->rating->mieu_ta }}
                                        </strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="background: #2e292e;">
                        <div class="d-flex flex-column">
                            <div class="d-flex text-light p-2">
                                <span class="flex-shrink-0"><i class="fa-solid fa-popcorn"></i>&numsp;Combo:</span>
                                <div id="ticket_combos" class="flex-grow-1 text-end d-flex flex-column"></div>
                            </div>
                            <div class="d-flex text-light p-2">
                                    <span class="flex-shrink-0">
                                        <i class="fa-solid fa-seat-airline text-uppercase"></i>&numsp;@lang('lang.seat'):
                                    </span>
                                <div id="ticket_seats" class="flex-grow-1 justify-content-end d-flex"></div>
                            </div>
                            <div class="d-flex text-light p-2">
                                <span class="flex-shrink-0"><i class="fa-solid fa-equals"></i>&numsp;@lang('lang.total_price'):</span>
                                <div class="flex-grow-1 text-end .ticketTotal"><span id="ticketSeat_totalPrice"></span> đ</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{--Chọn Ghế/Combo/Thanh toán--}}
            <div class="col-12 col-lg-9">
                {{--Process bar--}}
                <ul class="nav justify-content-around fw-bold">
                    <li class="nav-item">
                        <a class="nav-link active text-warning"
                           href="#Seats"
                           aria-controls="seat"
                           aria-expanded="true"
                           data-bs-toggle="collapse"
                           data-bs-target="#Seats">1. @lang('lang.choose_seat')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled text-secondary" href="#Combos">2. @lang('lang.choose_combo')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled text-secondary" href="#Payment">3. @lang('lang.payment')</a>
                    </li>
                </ul>
                <div class="progress" role="progressbar" aria-label="Example 1px high" aria-valuenow="10" aria-valuemin="0"
                     aria-valuemax="30" style="height: 2px">
                    <div class="progress-bar bg-warning" style="width: 34%"></div>
                </div>
                {{--Process bar : end--}}

                <div id="mainTicket">
                    {{--Ghế ngồi--}}
                    <div id="Seats" class="collapse show" data-bs-parent="#mainTicket">
                        <h4 class="mt-5">@lang('lang.choose_seat')</h4>
                        <div class="container-fluid py-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card mb-4">
                                        <div class="card-header pb-0">
                                            <h6>{{$room->ten_phong}}</h6>
                                        </div>
                                        <div class="card-body px-0 pt-0 pb-2">
                                            {{--Giá vé--}}
                                            <div class="d-flex container my-3 justify-content-center">
                                                <ul class="list-group list-group-horizontal">
                                                    <li class="list-group-item border-0">
                                                        <strong>@lang('lang.ticket_price'):</strong>
                                                    </li>
                                                    @foreach($seatTypes as $seatType)
                                                        <li class="list-group-item border-0">
                                                            <div class="d-flex">
                                                                <div class="d-inline-block me-2"
                                                                     style="width: 24px; height: 24px; background-color: {{ $seatType->mau_loai_ghe }}">
                                                                </div>
                                                                {{  number_format($seatType->phu_phi+$price+$room->loaiphongs->phu_phi,0,",",".") }} đ
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <div class="vr"></div>
                                                <ul class="list-group list-group-horizontal">
                                                    <li class="list-group-item border-0">
                                                        <div class="d-flex">
                                                            <div class="d-inline-block me-2 text-center"
                                                                 style="width: 24px; height: 24px; background-color: #dc3545">
                                                                <i class="fa-solid text-light fa-check"></i>
                                                            </div>
                                                            Ghế đang chọn
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item border-0">
                                                        <div class="d-flex">
                                                            <div class="d-inline-block me-2"
                                                                 style="width: 24px; height: 24px; background-color: #c3c3c3">
                                                            </div>
                                                            Ghế đã bán
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item border-0">
                                                        <div class="d-flex">
                                                            <div class="d-inline-block me-2 text-center text-dark"
                                                                 style="width: 24px; height: 24px; background-color: #cccccc">
                                                                X
                                                            </div>
                                                            Ghế bảo trì
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="d-block overflow-x-auto text-center">
                                                <div class="d-inline-block flex-nowrap mt-2 my-auto mb-4 text-center justify-content-center">
                                                    {{--Màn hình--}}
                                                    @lang('lang.screen')
                                                    <div class="row bg-dark mx-auto" style="height: 2px; max-width: 540px"></div>
                                                    <div class="row d-block m-2" style="margin: 2px">
                                                        <div class="d-flex flex-nowrap align-middle my-0 mx-1 py-1 px-0 disabled"
                                                             style="width: 30px; height: 30px; line-height: 22px; font-size: 10px">
                                                        </div>
                                                    </div>

                                                    {{--Ghế--}}
                                                    @foreach($room->rows as $row)
                                                        <div class="row d-flex flex-nowrap justify-content-center" id="Row_{{ $row->row }}"
                                                              style="@if($room->ghes->count() > 300)width: 1500px;@endif margin: 2px" >
                                                            @foreach($room->ghes as $seat)
                                                                @if($loop->first)
                                                                    <div class="seat d-inline-block align-middle disabled seat_empty"
                                                                         style="width: 30px; height: 30px; margin: 2px 0;" choice="empty"></div>
                                                                    <div class="seat d-inline-block align-middle disabled seat_empty"
                                                                         style="width: 30px; height: 30px; margin: 2px 0;" choice="empty"></div>
                                                                @endif
                                                                @if($seat->row == $row->row)
                                                                    @for($m = 0; $m < $seat->ms; $m++)
                                                                        <div class="seat d-inline-block align-middle disabled seat_empty"
                                                                             style="width: 30px; height: 30px; margin: 2px 0;" choice="empty"></div>
                                                                    @endfor
                                                                    @if($seat->status == 1)
                                                                    <div class="seat d-inline-block mx-1 align-middle py-1 px-0 seat_enable"
                                                                    id="{{ $seat->row.$seat->col}}"
                                                                    choice="0"
                                                                    style="background-color: {{ $seat->loaighes->mau_loai_ghe }}; cursor: pointer; width: 30px; height: 30px; line-height: 22px; font-size: 10px; margin: 2px 0;"
                                                                    onclick="seatChoice('{{$seat->row}}', {{$seat->col}},{{$seat->loaighes->phu_phi + $room->loaiphongs->phu_phi + $price}})">
                                                                   {{$seat->row.$seat->col }}
                                                               </div>
                                                                    @else
                                                                        <div class="seat d-inline-block align-middle py-1 px-0 text-dark disabled"
                                                                             style="background-color: #cccccc; width: 30px; height: 30px;
                                                                             line-height: 22px; font-size: 10px; margin: 2px 0;" choice="1">
                                                                            X
                                                                        </div>
                                                                    @endif
                                                                    @for($n = 0; $n < $seat->me; $n++)
                                                                        <div class="seat d-inline-block align-middle disabled seat_empty"
                                                                             style="width: 30px; height: 30px; margin: 2px 0;" choice="empty"></div>
                                                                    @endfor
                                                                @endif
                                                                    @if($loop->last)
                                                                        <div class="seat d-inline-block align-middle disabled seat_empty"
                                                                             style="width: 30px; height: 30px; margin: 2px 0;" choice="empty"></div>
                                                                        <div class="seat d-inline-block align-middle disabled seat_empty"
                                                                             style="width: 30px; height: 30px; margin: 2px 0;" choice="empty"></div>
                                                                    @endif
                                                            @endforeach
                                                        </div>
                                                            @for($m = 0; $m < $row->mb; $m++)
                                                                <div class="row d-flex flex-nowrap" style="margin: 2px">
                                                                    <div class="d-inline-block align-middle disabled seat_empty"
                                                                         style="width: 30px; height: 30px; margin: 2px 0;"></div>
                                                                </div>
                                                            @endfor
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-start w-50 ms-2 mt-4 float-end">
                            <button class="btn btn-warning text-decoration-underline text-center btn_next">
                                @lang('lang.next') <i class="fa-solid fa-angle-right"></i>
                            </button>
                            
                                {{-- <form action="/tao_ve" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="ticket_seats" id="ticket_seats_input">
                                    <input type="hidden" name="schedule_id" id ="ticker_lichtrinh" value="{{ $schedule->id_lich_trinh }}"> --}}

                                    <button
                                    id="seatChoiceNext"
                                    aria-expanded="false"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#Combos"
                                        class="d-none"
                                                    >   
                                </button>
                                {{-- </form> --}}
                        </div>
                    </div>

                    {{--Combo--}}
                    <div id="Combos" class="mt-5 collapse" data-bs-parent="#mainTicket">
                        <h4>@lang('lang.choose_combo')</h4>
                        <div class="row g-2 mt-2 row-cols-2" data-bs-parent="#mainContent">
                            @foreach($combos as $combo)
                                <!-- Combo -->
                                <div class="col">
                                    <div class="card px-0 overflow-hidden" id="Combo_{{$combo->id_combo}}"
                                         style="background: #f5f5f5">
                                        <div class="row g-0">
                                            <div class="col-lg-4 col-12">
                                                @if(strstr($combo->hinh,"https") == "")
                                                    <img class="img-fluid w-100" alt="..." style="max-height: 361px; max-width: 241px"
                                                         src="images/combo/{{ $combo->hinh }}">
                                                @else
                                                    <img class="img-fluid w-100" alt="..." style="max-height: 361px; max-width: 241px"
                                                         src="images/combo/{{ $combo->hinh }}">
                                                @endif
                                            </div>
                                            <div class="col-lg-8 col-12">
                                                <div class="card-body">
                                                    <h5 class="card-title text-dark">{{ $combo->ten_combo }}</h5>
                                                    <p class="card-text text-dark">
                                                        @foreach($combo->foods as $food)
                                                            @if($loop->first)
                                                                {{ $food->pivot->so_luong . ' ' . $food->ten_food }}
                                                            @else
                                                                + {{ $food->pivot->so_luong . ' ' . $food->ten_food }}
                                                            @endif
                                                        @endforeach
                                                    </p>
                                                    <p class="card-text">Giá: <span class="fw-bold">{{ number_format($combo->gia) }} đ</span></p>
                                                </div>
                                                <div class="card-body input_combo_block">
                                                    <div class="input-group">
                                                        <button class="btn minus_combo disabled"
                                                                onclick="minusCombo({{$combo->id_combo}}, {{$combo->gia}}, '{{ $combo->ten_combo }}')">
                                                            <i class="fa-solid fa-circle-minus"></i>
                                                        </button>
                                                        <input type="number" class="form-control input_combo" name="combo[{{$combo->id_combo}}]" value="0"
                                                               readonly min="0" max="4"
                                                               style="max-width: 80px" aria-label="">
                                                        <button class="btn plus_combo"
                                                                onclick="plusCombo({{$combo->id_combo}}, {{$combo->gia}}, '{{ $combo->ten_combo }}')">
                                                            <i class="fa-solid fa-circle-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Combo: end -->
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            <button id="comboBack" class="btn btn-warning mx-2 text-decoration-underline text-center btn_back"
                                    onclick="comboBack()"
                                    aria-expanded="false"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#Seats"
                            ><i class="fa-solid fa-angle-left"></i> @lang('lang.previous')
                            </button>

                            <button class="btn btn-warning mx-2  text-decoration-underline text-center btn_next"
                                    id="nextButton"
                                    aria-controls="Payment"
                                    aria-expanded="false"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#Payment"
                            >@lang('lang.next') <i class="fa-solid fa-angle-right"></i></button>
                        </div>
                    </div>

                    {{--Thanh toán--}}
                    <div id="Payment" class="mt-5 collapse" data-bs-parent="#mainTicket">
                        <form id="paymentForm" action="/payment/create" method="post">
                            @csrf
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td>Tên</td>
                                    <td>điểm hiện có</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td id="username">{{ Auth::user()->fullName }}</td>
                                    <td id="userPoint">{{ Auth::user()->point }}</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="input-group">
                                <span class="input-group-text">Sử dụng điểm</span>
                                <input id="point" class="form-control" min="20000"  name="point" type="number" placeholder="0"
                                       aria-label="">
                            </div>
                            <h4 class="mt-4">@lang('lang.discount')</h4>
                            <div class="bg-dark-subtle p-5">
                                <div class="row row-cols-1">
                                    <div class="form-check pe-4" id="bankCode">
                                        <div class="input-group">
                                            <input type="text" class="form-control border-dark" id="discount"
                                                   aria-label="" placeholder="nhập mã khuyến mãi...">
                                            <a id="btn_apply_discount" class="btn btn-danger">@lang('lang.apply')</a>
                                        </div>
                                    </div>
                                    <table class="table table-bordered mt-2">
                                        <tbody>
                                            <tr id="disList">
                                                <td id="disCode"></td>
                                                <td id="disPercent"></td>
                                                <td id="disStatus"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <h4 class="mt-4">@lang('lang.payment')</h4>

                            <div class="bg-dark-subtle p-5">
                                <div class="row row-cols-1">
                                    <div class="col container">
                                        <div class="form-check pe-4" id="bankCode">
                                            <input id="bankCode1" class="btn-check" type="radio" name="bankCode" value="VNPAYQR" aria-label="">
                                            <label for="bankCode1"
                                                   class="fw-semibold btn btn-light btn-outline-primary h3 p-3 my-2 w-100 text-start text-dark">
                                                Thanh toán bằng ứng dụng hỗ trợ
                                                <span class="vnpay-logo">
                                                    <span class="vnpay-red">VN</span><span class="vnpay-blue">PAY</span><sup class="vnpay-red">QR</sup>
                                                </span>
                                                <img src="/paymentv2/images/icons/mics/64x64-vnpay-qr.svg" alt="">
                                            </label>

                                            <input id="bankCode2" class="btn-check" type="radio" name="bankCode" value="VNBANK" aria-label="">
                                            <label for="bankCode2"
                                                   class="fw-semibold btn btn-light btn-outline-primary h3 p-3 my-2 w-100 text-start text-dark">
                                                Thanh toán qua thẻ ATM/Tài khoản nội địa
                                            </label>

                                            <input id="bankCode3" class="btn-check" type="radio" name="bankCode" value="INTCARD" aria-label="">
                                            <label for="bankCode3"
                                                   class="fw-semibold btn btn-light btn-outline-primary h3 p-3 my-2 w-100 text-start text-dark">
                                                Thanh toán qua thẻ quốc tế
                                            </label>
                                        </div>
                                        <input type="hidden" id="amount" name="amount" value="20000">
                                        <input type="hidden" id="language" name="language" value="@lang('lang.language')">
                                        <input type="hidden" id="timePayment" name="time" value="">
                                        <input type="hidden" id="ticket_id" name="ticket_id" value="">
                                        <input type="hidden" id="hasDiscount" name="hasDiscount" value="false">
                                    </div>
                                </div>
                            </div>


                            <div class="d-flex justify-content-center mt-4">
                                <button type="button" class="btn btn-warning mx-2 text-decoration-underline text-center"
                                        onclick="paymentBack()"
                                        aria-expanded="true"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#Combos">
                                    <i class="fa-solid fa-angle-left"></i> @lang('lang.previous')
                                </button>
                                <button type="button" onclick="paymentNext()"
                                        class="btn btn-warning mx-2 text-decoration-underline text-uppercase text-center">
                                    Đặt vé <i class="fa-solid fa-angle-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
@php
    $selectedSeats = [];
    foreach ($tickets as $ticket) {
        if($ticket->trang_thai_thanh_toan==(int)1)
        {
        foreach ($ticket->veghes as $ticketSeat) {
            $selectedSeats[] = $ticketSeat->row . $ticketSeat->col;
        }
    }
    }
@endphp

<script>
    $(document).ready(function() {
        var selectedSeats = @json($selectedSeats);
        
        selectedSeats.forEach(function(seatID) {
            var $seat = $('#' + seatID);
            $seat.replaceWith(`
                <div class="seat d-inline-block mx-1 align-middle py-1 px-0 text-dark disabled"
                    id="${seatID}" choice="1" style="background-color: #c3c3c3; width: 30px; height: 30px; line-height: 22px; font-size: 10px; margin: 2px 0;">
                    ${seatID}
                </div>
            `);
        });
    });
</script>

<script>
   // $(document).ready(() => {
            var tongve = 0;
            var selectedSeats = [];
            $i = 0;
            let $iCombo = [];
            let $arrSeatHtml = [];
            let $ticket_seats = {};
            let $ticket_combos = {};
            let $ticket_id = -1;
            let $countdown = {
                interval: null
            };
            let $sum = 0;
            let $holdState = false;

            startTimer = (duration, display, countdown) => {
                var timer = duration, minutes, seconds;
                countdown.interval = setInterval(function () {
                    minutes = parseInt(timer / 60, 10);
                    seconds = parseInt(timer % 60, 10);

                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;

                    display.textContent = minutes + ":" + seconds;
                    $('#timePayment').val(minutes);
                    timer--;
                    if (timer === -2) {
                        clearInterval(countdown.interval);
                        Swal.fire({
                        title: 'Thông Báo',
                        text: 'Đã Quá Thời Gian Thanh Toán!',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                         $.ajax({
                            url: "/xoave",
                             type: 'DELETE',
                             dataType: 'json',
                             data: {
                                'ticket_id': $ticket_id,
                             },
                             
                         });
                         setTimeout(function() {
                            window.location.replace('/');
                        }, 2000);
                    }
                }, 1000);
            }

            
            function seatChoice(row, col, price) {
                console.log($i);
                var seatID = row + col;
                var selectedSeat = document.getElementById(seatID);
                var $seatCurrent = $('#' + seatID);
                var choice = parseInt($seatCurrent.attr('choice'));

                if (choice === 1) {
                    $i--;
                    $seatCurrent.replaceWith($arrSeatHtml[seatID]);
                    $(`#ticketSeat_${seatID}`).remove();
                    $sum -= price;
                    $('#ticketSeat_totalPrice').text($sum.toLocaleString('vi-VN'));
                    delete $ticket_seats[seatID];
                } else {
                    $i++;
                    // Kiểm tra giới hạn chọn ghế
                    if ($i > 8) {
                        $i--;
                        alert('Chỉ được chọn tối đa 8 ghế');
                        return;
                    }

                    $arrSeatHtml[seatID] = $seatCurrent.clone();
                    $seatCurrent.replaceWith(`<div class="seat d-inline-block mx-1 align-middle py-1 px-0 seat_enable"
                        id="${seatID}" choice="1" onclick="seatChoice('${row}', ${col}, ${price})"
                        style="background-color: #dc3545; cursor: pointer; width: 30px; height: 30px; line-height: 22px; font-size: 10px;
                        margin: 2px 0;"><i class="fa-solid text-light fa-check"></i>
                        </div>`);

                    $('#ticket_seats').append(`<p id="ticketSeat_${seatID}">${seatID}, </p>`);
                    $ticket_seats[seatID] = [row, col, price];
                    $sum += price;
                    $('#ticketSeat_totalPrice').text($sum.toLocaleString('vi-VN'));
                }
            }

            checkSeats = () => {
                $seats = $('#Seats').find('.seat');
                for (let i = 0; i < $seats.length; i++) {
                    if ($seats[i].getAttribute('choice') === '1') {
                        seatLeft1 = $seats[i-1].getAttribute('choice');
                        seatRight1 = $seats[i+1].getAttribute('choice');
                        seatLeft2 = $seats[i-2].getAttribute('choice');
                        seatRight2 = $seats[i+2].getAttribute('choice');
                        if ($i >= 2) {
                            if(seatLeft1 === '0' && seatRight1 === '0') {
                                alert('Không để cách 1 ghế trống kế bên');
                                return false;
                            }
                            // if ((seatLeft2 === 'empty' && seatLeft1 === '0') && (seatRight1 === '1' && seatRight2 === '0')) {
                            //     return true;
                            // }
                        }
                        else {
                            if((seatLeft2 === false && seatLeft1 === '0') || (seatRight2 === false && seatRight1 === '0')) {
                                alert('Không để trống ghế ngoài cùng');
                                return false;
                            }
                        }
                        console.log(seatLeft2 + ' ' + seatLeft1 + ' <> ' + seatRight1 + ' ' + seatRight2);
                        if ((seatLeft2 === '1' && seatLeft1 === '0') || (seatRight1 === '0' && seatRight2 === '1' )) {
                            alert('Không để ghế trống kế bên');
                            return false;
                        }
                        if((seatLeft2 === 'empty' && seatLeft1 === '0') || (seatRight2 === 'empty' && seatRight1 === '0')) {
                            alert('Không để ghế ngoài cùng');
                            return false;
                        }
                    }
                }
                return true;
            }

            $('#Seats').on('click', '.btn_next', (e) => {
                if (!checkSeats()) {
                    return;
                }
                $('#seatChoiceNext').click();
                
                if ($i !== 0) {
                    $('#timer').remove();
                    $('#ticket_info').append(`
                        <div class="card-footer" style="background: #2e292e;">
                            <div id="timer" class="d-block bg-light text-dark text-center fs-2 m-3" style="width: 200px; height: 100px; line-height:100px"></div>
                        </div>
                    `);

                    var fiveMinutes = 60,
                        display = document.querySelector('#timer');
                    
                    startTimer(fiveMinutes, display, $countdown);


                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "/tao_ve",
                        type: 'post', // Thay đổi phương thức thành POST
                        dataType: 'json',
                        data: {
                            'ticketSeats': $ticket_seats,
                            'schedule': {{$schedule->id_lich_trinh}},
                        },
                        success: function(data) {
                            $ticket_id = data.id_ve;
                            // Xử lý phản hồi thành công (nếu cần)
                        },
                        error: function(xhr, status, error) {
                            if (xhr.status === 401) {
                                alert("Ghế đã được đặt!!!");
                            } else {
                                alert("Đã xảy ra lỗi!");
                            }
                            window.location.reload();
                        }
                    });
                    } else {
                        window.location.reload();
                        alert('Bạn chưa chọn ghế!!!');
                    }
        // Các cài đặt khác ở đây...
            });
            console.log($ticket_seats); // In giá trị của biến $ticket_seats vào console

            comboBack = () => {
                $('#timer').remove();
                clearInterval($countdown.interval);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/xoave",
                    type: 'DELETE',
                    data: {
                        'ticket_id': $ticket_id,
                    },
                });
            }

           
           
            $('#nextButton').click(function() {
                // Log ticket_id
                console.log("ticket_id:", $ticket_id);
                
                // Log ticket_combos
                console.log("ticket_combos:", $ticket_combos);

                $('#amount').val($sum);
                $('#ticket_id').val($ticket_id);
                $('#point').attr('max', $sum * 90 / 100);
                var $check = jQuery.isEmptyObject($ticket_combos);
                if (!$check) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "/taovecombo",
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            'ticket_id': $ticket_id,
                            'ticketCombos': $ticket_combos,
                        },
                        success: function(data) {
                            console.log("Success:", data);
                            $ticket_id = data.id_ve;
                            // Xử lý phản hồi thành công (nếu cần)
                        },
                        error: function(xhr, status, error) {
                            console.error("Error:", xhr.status, status, error);
                            if (xhr.status === 401) {
                                alert("Đã Thêm Combo");
                            } else {
                                alert("Đã xảy ra lỗi!".$ticket_combos);
                            }
                            window.location.reload();
                        }
                    });
                }
            });






            $(".input_combo_block").keydown(function(event) {
                return false;
            });

            plusCombo = (id, price, comboName) => {
                $iCombo++;
                $inputCombo = $('#Combo_' + id).find('.input_combo');
                $inputCombo.val(parseInt($inputCombo.val()) + 1);
                if (parseInt($inputCombo.val()) > 4) {
                    $inputCombo.parent().find('.plus_combo').addClass('disabled');
                    return;
                }
                $inputCombo.parent().find('.minus_combo').removeClass('disabled');
                if (parseInt($inputCombo.val()) === 1)
                    $('#ticket_combos').append(`<p id="ticketCombo_${id}">${comboName} x ${parseInt($inputCombo.val())}</p>`);
                else
                    $(`#ticketCombo_${id}`).replaceWith(`<p id="ticketCombo_${id}">${comboName} x ${parseInt($inputCombo.val())}</p>`);
                $sum += price;
                $('#ticketSeat_totalPrice').text($sum.toLocaleString('vi-VN'));
                $ticket_combos[id] = [id, parseInt($inputCombo.val())];
                if ($inputCombo.val() === '4') {
                    $inputCombo.parent().find('.plus_combo').addClass('disabled');
                    return;
                }
            }

            minusCombo = (id, price, comboName) => {
                $inputCombo = $('#Combo_' + id).find('.input_combo');
                if ($iCombo !== 0) {
                    $iCombo--;
                }
                if (parseInt($inputCombo.val()) === 0) {
                    $inputCombo.parent().find('.minus_combo').addClass('disabled');
                    return;
                }
                $inputCombo.val(parseInt($inputCombo.val()) - 1);
                $inputCombo.parent().find('.plus_combo').removeClass('disabled');
                if (parseInt($inputCombo.val()) === 0) {
                    $(`#ticketCombo_${id}`).remove();
                } else {
                    $(`#ticketCombo_${id}`).replaceWith(`<p id="ticketCombo_${id}">${comboName} x ${parseInt($inputCombo.val())}</p>`);
                }
                $sum -= price;
                $('#ticketSeat_totalPrice').text($sum.toLocaleString('vi-VN'));
                if (parseInt($inputCombo.val()) === 0) {
                    delete $ticket_combos[id];
                } else {
                    $ticket_combos[id] = [id, parseInt($inputCombo.val())];
                }
            }

            paymentBack = () => {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/xoavecombo",
                    type: 'DELETE',
                    data: {
                        'ticket_id': $ticket_id,
                    },
                });
            }

           


// });
</script>
@endsection
