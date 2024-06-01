@extends('web.layout.index')
@section('schedules')
    active
@endsection
@section('css')
    .swiper {
    width: 100%;
    height: auto;
    }

    .swiper-slide {
    text-align: center;
    font-size: 18px;
    background: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    }

    .swiper-slide img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
    }
@endsection
@section('content')
    <section class="container-lg clearfix" style="min-height: 1000px">
        <!-- Main content -->
        <div class="mt-5" id="schedules">
            {{-- SubNav --}}
            <ul class="nav justify-content-center mb-4">
                <li class="nav-item">
                    <button class="h5 nav-link link-warning active fw-bold border-bottom border-2 border-warning"
                            aria-expanded="true"
                            data-bs-toggle="collapse"
                            data-bs-target="#lichtheophim" disabled>
                        @lang('lang.movie_showtime')
                    </button>
                </li>
                <li class="vr mx-5"></li>
                <li class="nav-item">
                    <a class="h5 nav-link link-secondary" href="/schedulesByTheater">
                        @lang('lang.theater_showtime')
                    </a>
                </li>
            </ul>

            <div id="lichtheophim" class="collapse show" data-bs-parent="#schedules">
                {{-- Carousel Movies --}}
                <div class="owl-carousel">
                    @foreach($movies as $movie)
                            <?php $film[$movie->id_phim] = $movie ?>
                            <div class="item">
                                <button data-bs-toggle="collapse"
                                        data-bs-target=".multi-collapse_Movie_{{ $movie->id_phim }}"
                                        aria-expanded="false"
                                        aria-controls="movieChoice_{{$movie->id_phim}} movieSchedules_{{$movie->id_phim}}"
                                        class="btn btn-block border-0 p-2">
                                    @if(strstr($movie->image,"https") == "")
                                        <img class="rounded" style="width: 200px; height: 300px" alt="..."
                                             src="images/phim/{{ $movie->image }}">
                                    @else
                                        <img class="rounded" style="width: 200px; height: 300px" alt="..." src="images/phim/{{ $movie->image }}">
                                    @endif
                                </button>
                            </div>
                    @endforeach
                </div>

                <div id="collapseMovieParent">
                    @foreach($movies as $movie)
                        <!-- Movie -->
                        <div class="collapse multi-collapse_Movie_{{ $movie->id_phim }}" id="movieChoice_{{ $movie->id_phim }}"
                             data-bs-parent="#collapseMovieParent">
                            <div class="d-flex flex-column flex-sm-row align-items-center" style="background: #f5f5f5">
                                <div class="flex-shrink-0 justify-content-center">
                                    <a href="/chitiet_phim/{{ $movie->id_phim }}">
                                        @if(strstr($movie->image,"https") == "")
                                            <img class="img-fluid" style="max-height: 361px; max-width: 241px" alt="..."
                                                 src="images/phim/{{ $movie->image }}">
                                        @else
                                            <img class="img-fluid" style="max-height: 361px; max-width: 241px" alt="..." src="images/phim/{{ $movie->image }}">
                                        @endif
                                    </a>
                                </div>
                                <div class="flex-grow-1 ms-3 mt-3 mt-sm-0">
                                    <h5 class="card-title">{{ $movie->ten_phim }}</h5>
                                    <p class="card-text text-danger">{{ $movie->thoi_luong_phim }} phút</p>
                                    <p class="card-text">Thể loại:
                                        @foreach($movie->loaiphims as $genre)
                                            @if ($loop->first)
                                                <a class="link link-dark" href="#">{{ $genre->ten_loai_phim }}</a>
                                            @else
                                                |, <a class="link link-dark" href="#">{{ $genre->ten_loai_phim }}</a>
                                            @endif
                                        @endforeach
                                    </p>
                                    <p class="card-text">Đạo diễn:
                                        @foreach($movie->daodiens as $director)
                                            @if ($loop->first)
                                                {{ $director->ten_dao_dien }}
                                            @else
                                                , {{ $director->ten_dao_dien }}
                                            @endif
                                        @endforeach
                                    </p>
                                    <p class="card-text">Diễn viên:
                                        @foreach($movie->dienviens as $cast)
                                            @if ($loop->first)
                                                {{ $cast->ten_dien_vien }}
                                            @else
                                                , {{ $cast->ten_dien_vien }}
                                            @endif
                                        @endforeach
                                    </p>
                                    <p class="card-text">@lang('lang.rated'):
                                        <span class="badge @if($movie->rating->ten_gioi_han == 'C18') bg-danger
                                                            @elseif($movie->rating->ten_gioi_han == 'C16') bg-warning
                                                            @elseif($movie->rating->ten_gioi_han == 'C13') bg-success
                                                            @elseif($movie->rating->ten_gioi_han == 'P') bg-primary
                                                            @else bg-info
                                                            @endif me-1"
                                        >
                                            {{ $movie->rating->ten_gioi_han }}
                                        </span> - {{ $movie->rating->mieu_ta }}
                                    </p>
                                </div>
                            </div>
                            <ul class="list-group list-group-horizontal flex-wrap listDate">
                                @for($i = 0; $i <= 7; $i++)
                                    <li class="list-group-item border-0">
                                        <button data-bs-toggle="collapse"
                                                data-bs-target="#schedule_{{$movie->id_phim}}_date_{{$i}}"
                                                @if($i == 0)
                                                    aria-expanded="true"
                                                @else
                                                    aria-expanded="false"
                                                @endif
                                                class="btn btn-block btn-outline-dark p-2 m-2 @if($i==0) active @endif btn-date">
                                            {{ date('d/m', strtotime('+ '.$i.' day', strtotime(today()))) }}
                                        </button>
                                    </li>
                                @endfor
                            </ul>
                        </div>
                        <!-- Movie: end -->
                    @endforeach


                    @foreach($movies as $movie)
                       @if($movie->lichtrinhs->count() > 0)
                            @include('web.layout.schedulesByMovie')
                       @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $("#schedules .nav .nav-item .nav-link").on("click", function () {
                $("#schedules .nav-item").find(".active").removeClass("active link-warning fw-bold border-bottom border-2 border-warning").addClass("link-secondary").prop('disabled', false);
                $(this).addClass("active link-warning fw-bold border-bottom border-2 border-warning").removeClass("link-secondary").prop('disabled', true);
            });

            $("#lichtheorap .d-flex .flex-city .btn").on("click", function () {
                $("#lichtheorap .flex-city").find(".btn").removeClass("btn-warning").addClass("btn-secondary").prop('disabled', false);
                $(this).addClass("btn-warning").removeClass("btn-secondary").prop('disabled', true);
            });

            $(".theater_item .btn_theater").on("click", function () {
                $(".theater_item ").find(".btn_theater").removeClass("btn-warning").prop('disabled', false);
                $(this).addClass("btn-warning").prop('disabled', true);
            });

            $(".listDate button").on('click', function () {
                $(".listDate").find(".btn").removeClass('active');
                $(this).addClass("active");
            })

            var $owlMovies = $('.owl-carousel');
            $owlMovies.owlCarousel({
                loop:true,
                nav:false,
                margin:10,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:3
                    },
                    960:{
                        items:4
                    },
                    1400:{
                        items:6
                    }
                },
                autoplay:true,
                autoplayTimeout:2000,
                autoplayHoverPause:true,
            });
            $owlMovies.on('mousewheel', '.owl-stage', function (e) {
                if (e.deltaY>0) {
                    $owlMovies.trigger('next.owl');
                } else {
                    $owlMovies.trigger('prev.owl');
                }
                e.preventDefault();
            });
        })
    </script>
@endsection
