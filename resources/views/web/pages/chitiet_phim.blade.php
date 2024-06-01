@extends('web.layout.index')
@section('content')
    <style>
        .hover_movie:hover {
            color: #f26b38 !important;
        }
    </style>
    <section class="container-lg">
        {{--  Breadcrumb  --}}
        <nav aria-label="breadcrumb mt-5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="link link-dark text-decoration-none">@lang('lang.home')</a></li>
                <li class="breadcrumb-item"><a href="/phims" class="link link-dark text-decoration-none">@lang('lang.movie_is_playing')</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$movie->ten_phim}}</li>
            </ol>
        </nav>

        <div class="movie mt-5">
            {{--  Movie title  --}}
            <h2 class="mt-2">{!! $movie->ten_phim !!}</h2>

            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="card border border-4 border-warning rounded-0">
                        @if(strstr($movie->image,"https") == "")
                            <img class="card-img-top rounded-0" alt='...'
                                 src="images/phim/{{ $movie->image }}">
                        @else
                            <img class="card-img-top rounded-0" alt='...'
                                 src="images/phim/{{ $movie->image }}">
                        @endif
                    </div>
                    <div class="card-body border border-4 border-warning border-top-0 d-flex align-items-center">
                        <strong class="card-text p-2">@lang('lang.evaluate'): </strong>
                        <div id='score' class="score"></div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-9">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex align-items-center text-danger">{{ $movie->thoi_luong_phim }} @lang('lang.minutes')
                        </li> {{--movie running time--}}
                        <li class="list-group-item d-flex align-items-center"><strong class="pe-1">@lang('lang.national')
                                : </strong>{!! $movie->quoc_giasx !!}
                        </li>
                        <li class="list-group-item d-flex align-items-center"><strong class="pe-1">@lang('lang.release_date')
                                : </strong>{!! $movie->ngay_phat_hanh !!}
                        </li>
                        <li class="list-group-item d-flex align-items-center"><strong class="pe-1">@lang('lang.genre'): </strong>
                            @foreach($movie->loaiphims as $loaiphim)
                                @if ($loop->first)
                                    {{ $loaiphim->ten_loai_phim }}
                                @else
                                    , {{ $loaiphim->ten_loai_phim }}
                                @endif
                            @endforeach
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <strong class="pe-1">@lang('lang.directors'): </strong>
                            @foreach($movie->daodiens as $daodien)
                            {{-- /director/{!! $director['id'] !!} --}}
                                <a href="/chitiet_daodien/{{ $daodien->id_dao_dien }}" class="link link-dark text-decoration-none hover_movie">
                                @if ($loop->first)
                                    {{ $daodien->ten_dao_dien }}
                                @else
                                    , {{ $daodien->ten_dao_dien }}
                                @endif
                                </a>
                            @endforeach
                        </li>
                        <li class="list-group-item d-flex align-items-center text-truncate">
                            <strong class="pe-1">@lang('lang.casts'): </strong>
                            @foreach($movie->dienviens as $dienvien)
                            {{-- /cast/{!! $cast['id'] !!} --}}
                                <a href="/chitiet_dienvien/{{ $dienvien->id_dien_vien }}" class="link link-dark text-decoration-none hover_movie" >
                                @if ($loop->first)
                                    {{ $dienvien->ten_dien_vien }}
                                @else
                                    , {{ $dienvien->ten_dien_vien }}
                                @endif
                                </a>
                            @endforeach
                        </li>
                        <li class="list-group-item d-flex align-items-center"><strong class="pe-1">@lang('lang.rated'): </strong>
                            <span class="badge @if($movie->rating->ten_gioi_han == 'C18') bg-danger
                            @elseif($movie->rating->ten_gioi_han == 'C16') bg-warning
                            @elseif($movie->rating->ten_gioi_han == 'P') bg-success
                            @elseif($movie->rating->ten_gioi_han == 'K') bg-primary
                            @else bg-info
                            @endif me-1">
                                {{ $movie->rating->ten_gioi_han }}
                            </span> - {{ $movie->rating->mieu_ta }}
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row container">
                <div class="accordion-item">
                    <div class="accordion-header">
                        <h4 class="mt-4">@lang('lang.content')</h4>
                    </div>
                    <div class="accordion-body">
                        Duy Ne CGV
                    </div>
                </div>
            </div>
            <div class="row container">
                <h4 class="mt-4">Trailer</h4>

                <div class="">
                    @isset($movie->trailer)
                    <iframe width="800" height="500" src="{{ $movie->trailer }}"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                    </iframe>
                    @endisset
                </div>
            </div>
        </div>
        @if($schedulesEarly->count() > 0)
            <div class="col-12 mt-4">
                <h4>@lang('lang.schedule_early')</h4>
                    @foreach($schedulesEarly as $schedule)
                        @if(date('Y-m-d') == $schedule->ngay)
                            @if(date('H:i', strtotime('+ 20 minutes', strtotime($schedule->thoi_gian_bat_dau))) >= date('H:i'))
                                @if(Auth::check())
                                    <a href="/ve/{{$schedule->id_lich_trinh}}"
                                       class="btn btn-warning rounded-0 p-1 m-0 me-4 border-2 border-light"
                                       style="border-width: 2px; border-style: solid dashed; min-width: 85px">
                                        <p class="btn btn-warning rounded-0 m-0 border border-light border-1">
                                            {{ date('H:i', strtotime($schedule->thoi_gian_bat_dau )).' - '.date('d-m-Y', strtotime($schedule->ngay)) }}
                                        </p>
                                    </a>
                                @else
                                    <a class="btn btn-warning rounded-0 p-1 m-0 me-4 border-2 border-light"
                                       data-bs-toggle="modal"
                                       data-bs-target="#loginModal"
                                       style="border-width: 2px; border-style: solid dashed; min-width: 85px">
                                        <p class="btn btn-warning rounded-0 m-0 border border-light border-1">
                                            {{ date('H:i', strtotime($schedule->thoi_gian_bat_dau )).' | '.date('d-m-Y', strtotime($schedule->ngay)
                                            ) }}
                                        </p>
                                    </a>
                                @endif
                            @endif
                        @endif
                        @if(date('Y-m-d') < $schedule->ngay)
                            @if(Auth::check())
                                <a href="/ve/{{$schedule->id_lich_trinh}}"
                                   class="btn btn-warning rounded-0 p-1 m-0 me-4 border-2 border-light"
                                   style="border-width: 2px; border-style: solid dashed; min-width: 85px">
                                    <p class="btn btn-warning rounded-0 m-0 border border-light border-1">
                                        {{ date('H:i', strtotime($schedule->thoi_gian_bat_dau )).' | '.date('d-m-Y', strtotime($schedule->ngay)) }}
                                    </p>
                                </a>
                            @else
                                <a class="btn btn-warning rounded-0 p-1 m-0 me-4 border-2 border-light"
                                   data-bs-toggle="modal"
                                   data-bs-target="#loginModal"
                                   style="border-width: 2px; border-style: solid dashed; min-width: 85px">
                                    <p class="btn btn-warning rounded-0 m-0 border border-light border-1">
                                        {{ date('H:i', strtotime($schedule->thoi_gian_bat_dau )).' - '.date('d-m-Y', strtotime($schedule->ngay)) }}
                                    </p>
                                </a>
                            @endif
                        @endif
                    @endforeach
            </div>
        @endif
        <div class="col-12 mt-4">
            <h4>@lang('lang.movie_schedule')</h4>
            <ul class="list-group list-group-horizontal flex-wrap">
                @for($i = 0; $i <= 7; $i++)
                    <li class="list-group-item border-0">
                        <button data-bs-toggle="collapse"
                                data-bs-target="#schedule_date_{{$i}}"
                                aria-expanded="false"
                                class="btn btn-block btn-outline-dark p-2 m-2">
                            {{ date('d/m', strtotime('+ '.$i.' day', strtotime(today()))) }}
                        </button>
                    </li>
                @endfor
            </ul>
        </div>
        @include('web.layout.movieDetailSchedules')
        </div>



    </section>
@endsection
@section('js')
@endsection
