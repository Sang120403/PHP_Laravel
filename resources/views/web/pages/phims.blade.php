@extends('web.layout.index')
@section('movies')
    active
@endsection
@section('content')
    <section class="container-lg clearfix">
        <!-- Main content -->
        <div class="mt-5" id="Movies">
            <ul class="nav justify-content-start mb-4 align-items-center">
                <li class="nav-item">
                    <button class="h5 nav-link link-warning active fw-bold border-bottom border-2 border-warning"
                            aria-expanded="true"
                            data-bs-toggle="collapse"
                            data-bs-target="#phimdangchieu" disabled>
                        @lang('lang.movie_is_playing')
                    </button>
                </li>
                <li class="vr mx-5"></li>
                <li class="nav-item">
                    <button class="h5 nav-link link-secondary"
                            aria-expanded="false"
                            data-bs-toggle="collapse" data-bs-target="#phimsapchieu">
                        @lang('lang.movie_upcoming')
                    </button>
                </li>

                <li class="vr mx-5"></li>
                <li class="nav-item me-auto">
                    <button class="h5 nav-link link-secondary"
                            aria-expanded="false"
                            data-bs-toggle="collapse" data-bs-target="#vebantruoc">
                        @lang('lang.pre_sale')
                    </button>
                </li>

                <button class="btn" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <i class="fa-solid fa-filter"></i> @lang('lang.sort_by')
                </button>
            </ul>


            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                 aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasRightLabel">@lang('lang.sort_by')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <form action="/locphim" method="get">
                        @csrf
                        <div class="form-group m-2 mb-3">
                            <label for="cast" class="form-label">@lang('lang.casts')</label>
                            <select id="cast" class="form-control cast-input" name="casts[]" multiple>
                                @foreach($casts as $cast)
                                    <option value="{{ $cast->id_dien_vien }}">{{ $cast->ten_dien_vien }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group m-2 mb-3">
                            <label for="director" class="form-control-label">@lang('lang.directors')</label>
                            <select id="director" class="form-control director-input" name="directors[]" multiple>
                                @foreach($directors as $director)
                                    <option value="{{ $director->id_dao_dien }}">{{ $director->ten_dao_dien }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="m-2 form-group mb-3">
                            <label class="form-label" for="movieGenres">@lang('lang.genre')</label>
                            <select id="movieGenres" class="form-control director-input" name="movieGenres[]" multiple>
                                @foreach($movieGenres->where('trang_thai',1) as $movieGenre)
                                    <option value="{{ $movieGenre->id_loai_phim }}">{{ $movieGenre->ten_loai_phim }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="m-2 form-group mb-3">
                            <label class="form-label" for="rating">@lang('lang.rated')</label>
                            <select id="rating" class="form-select" name="rating">
                                <option value="" selected>@lang('lang.all')</option>
                                @foreach($rating as $value)
                                    <option value="{{ $value->id_gioi_han_do_tuoi }}"
                                            title="{{ $value->mieu_ta }}">
                                        {{ $value->ten_gioi_han }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary m-2 mt-4 w-100">@lang('lang.submit')</button>
                    </form>
                </div>
            </div>

            <div id="phimsapchieu" class="row g-4 mt-2 row-cols-1 row-cols-md-2 collapse" data-bs-parent="#Movies">
                @foreach($moviesSoon as $movie)
                        <!-- Movie -->
                        <div class="card-col">
                            <article class="card px-0 overflow-hidden" style="background: #f5f5f5">
                                <div class="row g-0">
                                    <div class="col-lg-4 col-12">
                                        <a href="/chitiet_phim/{{ $movie->id_phim }}">
                                            @if(strstr($movie->image,"https") == "")
                                                <img class="img-fluid rounded "
                                                     src="{{ asset('images/latmat6.jpg') }}"
                                                     alt="" style="width: 210px; height: 280px">
                                            @else
                                                <img class="img-fluid rounded " style="width: 210px; height: 280px" src="{{ asset('images/latmat6.jpg') }}" alt="">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="col-lg-8 col-12">
                                        <div class="card-body">
                                            <a href="/chitiet_phim/{{ $movie->id_phim }}" class="link link-dark text-decoration-none">
                                                <h5 class="card-title">{{ $movie->ten_phim }}</h5>
                                                <p class="card-text text-danger">{{ $movie->thoi_luong_phim }} phút</p>
                                                <p class="card-text">Thể loại:
                                                    @foreach($movie->loaiphims as $loaiphim)
                                                        @if ($loop->first)
                                                            <a class="link link-dark" href="#">{{ $loaiphim->ten_loai_phim }}</a>
                                                        @else
                                                            | <a class="link link-dark" href="#">{{ $loaiphim->ten_loai_phim }}</a>
                                                        @endif
                                                    @endforeach
                                                </p>
                                                <p class="card-text">Đạo diễn:
                                                    @foreach($movie->daodiens as $director)
                                                        @if ($loop->first)
                                                            <a class="link link-dark text-decoration-none" href="#">{{ $director->ten_dao_dien }}</a>
                                                        @else
                                                            , <a class="link link-dark text-decoration-none" href="#">{{ $director->ten_dao_dien }}</a>
                                                        @endif
                                                    @endforeach
                                                </p>
                                                <p class="card-text">Diễn viên:
                                                    @foreach($movie->dienviens as $cast)
                                                        @if ($loop->first)
                                                            <a class="link link-dark text-decoration-none" href="#">{{ $cast->ten_dien_vien }}</a>
                                                        @else
                                                            , <a class="link link-dark text-decoration-none" href="#">{{ $cast->ten_dien_vien }}</a>
                                                        @endif
                                                    @endforeach
                                                </p>
                                                <p class="card-text">@lang('lang.rated'):
                                                    <span class="badge @if($movie->rating->name == 'C18') bg-danger
                                                                        @elseif($movie->rating->name == 'C16') bg-warning
                                                                        @elseif($movie->rating->name == 'C13') bg-success
                                                                        @elseif($movie->rating->name == 'P') bg-primary
                                                                        @else bg-info
                                                                        @endif me-1"
                                                    >
                                                        {{ $movie->rating->ten_gioi_han }}
                                                    </span> - {{ $movie->rating->mieu_ta }}
                                                </p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <!-- Movie: end -->
                @endforeach
            </div>

            <div id="phimdangchieu" class="row g-4 mt-2 row-cols-1 row-cols-md-2 collapse show" data-bs-parent="#Movies">
                @foreach($movies as $movie)
                        <!-- Movie -->
                        <div class="card-col">
                            <article class="card px-0 overflow-hidden" style="background: #f5f5f5">
                                <div class="row g-0">
                                    <div class="col-lg-4 col-12">
                                        <a href="/chitiet_phim/{{ $movie->id_phim }}">
                                            @if(strstr($movie->image,"https") == "")
                                                <img class="img-fluid rounded "
                                                     src="images/phim/{{ $movie->image }}"
                                                     alt="" style="width: 210px; height: 280px">
                                            @else
                                                <img class="img-fluid rounded " src="images/phim/{{ $movie->image }}" alt="" style="width: 210px; height: 280px">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="col-lg-8 col-12">
                                        <div class="card-body">
                                            <a href="/chitiet_phim/{{ $movie->id_phim }}" class="link link-dark text-decoration-none">
                                                <h5 class="card-title">{{ $movie->ten_phim }}</h5>
                                                <p class="card-text text-danger">{{ $movie->thoi_luong_phim }} phút</p>
                                                <p class="card-text">Thể loại:
                                                    @foreach($movie->loaiphims as $loaiphim)
                                                        @if ($loop->first)
                                                            <a class="link link-dark" href="#">{{ $loaiphim->ten_loai_phim }}</a>
                                                        @else
                                                            | <a class="link link-dark" href="#">{{ $loaiphim->ten_loai_phim }}</a>
                                                        @endif
                                                    @endforeach
                                                </p>
                                                <p class="card-text">Đạo diễn:
                                                    @foreach($movie->daodiens as $daodien)
                                                        @if ($loop->first)
                                                            <a class="link link-dark text-decoration-none" href="#">{{ $daodien->ten_dao_dien }}</a>
                                                        @else
                                                            , <a class="link link-dark text-decoration-none" href="#">{{ $daodien->ten_dao_dien }}</a>
                                                        @endif
                                                    @endforeach
                                                </p>
                                                <p class="card-text">Diễn viên:
                                                    @foreach($movie->dienviens as $dienvien)
                                                        @if ($loop->first)
                                                            <a class="link link-dark text-decoration-none" href="#">{{ $dienvien->ten_dien_vien }}</a>
                                                        @else
                                                            , <a class="link link-dark text-decoration-none" href="#">{{ $dienvien->ten_dien_vien }}</a>
                                                        @endif
                                                    @endforeach
                                                </p>
                                                <p class="card-text">Rated:
                                                    <span class="badge @if($movie->rating->ten_gioi_han == 'C18') bg-danger
                                                                        @elseif($movie->rating->ten_gioi_han == 'C16') bg-warning
                                                                        @elseif($movie->rating->ten_gioi_han == 'P') bg-success
                                                                        @elseif($movie->rating->ten_gioi_han == 'P') bg-primary
                                                                        @else bg-info
                                                                        @endif me-1"
                                                    >
                                                        {{ $movie->rating->ten_gioi_han }}
                                                    </span> - {{ $movie->rating->mieu_ta }}
                                                </p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <!-- Movie: end -->
                @endforeach
            </div>

            <div id="vebantruoc" class="row g-4 mt-2 row-cols-1 row-cols-md-2 collapse" data-bs-parent="#Movies">
                @foreach($moviesEarly as $movie)
                    <!-- Movie -->
                    <div class="card-col">
                        <article class="card px-0 overflow-hidden" style="background: #f5f5f5">
                            <div class="row g-0">
                                <div class="col-lg-4 col-12">
                                    <a href="/chitiet_phim/{{ $movie->id }}">
                                        @if(strstr($movie->image,"https") == "")
                                            <img class="img-fluid rounded "
                                                 src="{{ asset('images/latmat6.jpg') }}"
                                                 alt="" style="width: 210px; height: 280px">
                                        @else
                                            <img class="img-fluid rounded " src="{{ asset('images/latmat6.jpg') }}" alt="" style="width: 210px; height: 280px">
                                        @endif
                                    </a>
                                </div>
                                <div class="col-lg-8 col-12">
                                    <div class="card-body">
                                        <a href="chitiet_phim/{{ $movie->id_phim }}" class="link link-dark text-decoration-none">
                                            <h5 class="card-title">{{ $movie->ten_phim }}</h5>
                                            <p class="card-text text-danger">{{ $movie->thoi_luong_phim }} phút</p>
                                            <p class="card-text">Thể loại:
                                                @foreach($movie->loaiphims as $loaiphim)
                                                    @if ($loop->first)
                                                        <a class="link link-dark" href="#">{{ $loaiphim->ten_loai_phim }}</a>
                                                    @else
                                                        | <a class="link link-dark" href="#">{{ $loaiphim->ten_loai_phim }}</a>
                                                    @endif
                                                @endforeach
                                            </p>
                                            <p class="card-text">Đạo diễn:
                                                @foreach($movie->daodiens as $daodien)
                                                    @if ($loop->first)
                                                        <a class="link link-dark text-decoration-none" href="#">{{ $daodien->ten_dao_dien }}</a>
                                                    @else
                                                        , <a class="link link-dark text-decoration-none" href="#">{{ $daodien->ten_dao_dien }}</a>
                                                    @endif
                                                @endforeach
                                            </p>
                                            <p class="card-text text-truncate">Diễn viên:
                                                @foreach($movie->dienviens as $dienvien)
                                                    @if ($loop->first)
                                                        <a class="link link-dark text-decoration-none" href="#">{{ $dienvien->ten_dien_vien }}</a>
                                                    @else
                                                        , <a class="link link-dark text-decoration-none" href="#">{{ $dienvien->ten_dien_vien }}</a>
                                                    @endif
                                                @endforeach
                                            </p>
                                            <p class="card-text">Rated:
                                                <span class="badge @if($movie->rating->ten_gioi_han == 'C18') bg-danger
                                                                        @elseif($movie->rating->ten_gioi_han == 'C16') bg-warning
                                                                        @elseif($movie->rating->ten_gioi_han == 'P') bg-success
                                                                        @elseif($movie->rating->ten_gioi_han == 'P') bg-primary
                                                                        @else bg-info
                                                                        @endif me-1"
                                                >
                                                        {{ $movie->rating->ten_gioi_han }}
                                                    </span> - {{ $movie->rating->mieu_ta }}
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    <!-- Movie: end -->
                @endforeach
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('.director-input').select2({
                tags: true
            });

            $('#rating').select2({
                tags: true
            })

            $('#movieGenres').select2({
                tags: true
            });

            $('.cast-input').select2({
                tags: true
            });

            $("#Movies .nav .nav-item .nav-link").on("click", function () {
                $("#Movies .nav-item").find(".active").removeClass("active link-warning fw-bold border-bottom border-2 border-warning").addClass("link-secondary").prop('disabled', false);
                $(this).addClass("active link-warning fw-bold border-bottom border-2 border-warning").removeClass("link-secondary").prop('disabled', true);
            });
        });
    </script>
@endsection
