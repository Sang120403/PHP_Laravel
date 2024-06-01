@extends('web.layout.index')
@section('css')

@endsection
@section('content')
<section class="container-lg clearfix">
    
    <!-- Slider -->
    <div id="carouselExampleControls" class="carousel slide shadow" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($banners as $banner)
            <div class="carousel-item @if($loop->first) active @endif">
                {{-- @if(strstr($banner->image,"https") == "")
                <img src="{{ asset('images/banner/banner.jpg') }}" class="d-block w-100" style="max-height: 600px; object-fit: contain; object-position: 50% 100%" alt="...">
                @else --}}
                <img src="images/banner/{{ $banner->hinh }}" class="d-block w-100" style="max-height: 600px; object-fit: contain; object-position: 50% 100%" alt="...">
                {{-- @endif --}}
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!--end slider -->
    @include('web.common.search')
    <!-- Main content -->
    <div class="mt-5" id="mainContent">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="h5 nav-link active" href="#phimmoi" aria-controls="phimmoi" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="#phimmoi">
                    @lang('lang.new_film')
                </a>
            </li>
            <li class="nav-item">
                <a class="h5 nav-link link-secondary" href="#vebantruoc" aria-controls="vebantruoc" aria-expanded="false" data-bs-toggle="collapse" data-bs-target="#vebantruoc">@lang('lang.pre_sale')</a>
            </li>
        </ul>

        <div id="vebantruoc" class="row g-4 mt-2 row-cols-1 row-cols-md-2 collapse" data-bs-parent="#mainContent">
            @foreach($moviesEarly as $movie)
            <!-- Movie -->
            <div class="card-col">
                <article class="card px-0 overflow-hidden" style="background: #f5f5f5; ">
                    <div class="row g-0">
                        <div class="col-lg-4 col-12">
                            <a href="/chitiet_phim/{{ $movie->id_phim }}">
                                @if(strstr($movie->image,"https") == "")
                                <img src="{{ asset('images/latmat6.jpg') }}" class="img-fluid rounded" style="width: 210px; height: 280px" alt="...">
                                @else
                                <img src="{{ asset('images/latmat6.jpg') }}" class="img-fluid rounded" style="width: 210px; height: 280px" alt="...">
                                @endif
                            </a>
                        </div>
                        <div class="col-lg-8 col-12">
                            <div class="card-body">
                                <a href="chitiet_phim/{{ $movie->id_phim }}" class="link link-dark text-decoration-none">
                                    <h5 class="card-title">{{ $movie->ten_phim }}</h5>
                                    <p class="card-text text-danger">{{ $movie->thoi_luong_phim }} phút</p>
                                    <p class="card-text">
                                        @foreach($movie->loaiphims as $genre)
                                        @if ($loop->first)
                                        <a class="link link-dark" href="#">{{ $genre->ten_loai_phim }}</a>
                                        @else
                                        | <a class="link link-dark" href="#">{{ $genre->ten_loai_phim }}</a>
                                        @endif
                                        @endforeach
                                    </p>
                                    <p class="card-text">Rated: <b class="text-danger">{{ $movie->rating->ten_gioi_han }}</b>
                                        - {{ $movie->rating->mieu_ta }}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
            <!-- Movie: end -->
            @endforeach
        </div>

        <div id="phimmoi" class="row g-4 mt-2 row-cols-1 row-cols-md-2 collapse show" data-bs-parent="#mainContent">
            @foreach($movies as $movie)

            <!-- Movie -->
            <div class="card-col">
                <article class="card px-0 overflow-hidden" style="background: #f5f5f5; ">
                    <div class="row g-0">
                        <div class="col-lg-4 col-12">
                            <a href="/chitiet_phim/{{ $movie->id_phim }}">
                                @if(strstr($movie->image,"https") == "")
                                <img src="images/phim/{{ $movie->image }}" class="img-fluid rounded" style="width: 210px; height: 280px" alt="...">
                                @else
                                <img src="{{ asset('images/latmat6.jpg') }}" class="img-fluid rounded" style="width: 210px; height: 280px" alt="...">
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
                                 
                                <p>

                                </p>
                                   <p class="card-text">Đạo diễn:
                                        @foreach($movie->daodiens as $daodien)
                                            @if ($loop->first)
                                                <a class="link link-dark text-decoration-none" href="chitiet_daodien/{{ $daodien->id_dao_dien }}">{{ $daodien->ten_dao_dien }}</a>
                                            @else
                                                , <a class="link link-dark text-decoration-none" href="chitiet_daodien/{{ $daodien->id_dao_dien }}">{{ $daodien->ten_dao_dien }}</a>
                                            @endif
                                        @endforeach
                                    </p>
                                

                                
                                    <p class="card-text" style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1;
                                                        -webkit-box-orient: vertical">
                                        Diễn viên:
                                        @foreach($movie->dienviens as $dienvien)
                                        @if ($loop->first)
                                        
                                        <a class="link link-dark text-decoration-none" href="chitiet_dienvien/{{ $dienvien->id_dien_vien }}">{{ $dienvien->ten_dien_vien }}</a>
                                        @else
                                        ,  <a class="link link-dark text-decoration-none" href="chitiet_dienvien/{{ $dienvien->id_dien_vien }}">{{ $dienvien->ten_dien_vien }}</a>
                                        @endif
                                        @endforeach 
                                          

                                    </p>
                                    <p class="card-text">@lang('lang.rated'):
                                        <span class="badge @if($movie->rating->ten_gioi_han == 'C18') bg-danger
                                                                        @elseif($movie->rating->ten_gioi_han == 'C16') bg-warning
                                                                        @elseif($movie->rating->ten_gioi_han == 'C13') bg-success
                                                                        @elseif($movie->rating->ten_gioi_han == 'P') bg-primary
                                                                        @else bg-info
                                                                        @endif me-1">
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

        <div class="row m-2 mb-5 justify-content-end">
            <a href="/phims" class="btn btn-outline-warning w-auto">@lang('lang.more') ></a>
        </div>

        <div class="mt-5">
            @if($news->count() > 0)
            <h5 class="page-heading">@lang('lang.latest_news')</h5>
            @endif
            <div class="row mt-2 g-2 row-cols-1 row-cols-sm-2 row-cols-md-3 justify-content-start">
                {{-- Post item  --}}
                @foreach($news as $value)
                <div class="col">
                    <div class="card border-0">
                        <div class="row g-0">
                            <div class="col-lg-4 col-12">
                                <a class="link" href="/chitiet_tintuc/{{ $value->id_tin_tuc }}">
                                    @if(strstr($value->hinh_tin_tuc,"https") == "")
                                    <img style="width: 300px" src="{{ $value->hinh_tin_tuc }}" class="img-fluid mt-3 w-100" alt="user1">
                                    @else
                                    <img style="width: 300px" src="{{ $value->hinh_tin_tuc }}" class="img-fluid mt-3 w-100" alt="user1">
                                    @endif
                                </a>
                            </div>
                            <div class="col-lg-8 col-12">
                                <div class="card-body">
                                    <a href="#" class="link link-dark text-decoration-none">
                                        <h5 class="card-title" style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical">
                                          {{ $value->tieu_de }} </h5>
                                        <p class="card-text text-truncate">{!! strip_tags($value->content) !!}</p>
                                        <p class="card-text"><small class="text-muted">{!! date('d F Y', strtotime($value->created_at )) !!}</small></p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @if($news->count() > 0)
            <div class="row m-2 mb-5 justify-content-end">
                <a href="/tintuc" class="btn btn-outline-warning w-auto">@lang('lang.more') ></a>
            </div>
            @endif
            <div class="zalo-chat-widget" data-oaid="4011839899851309095" data-welcome-message="Rất vui khi được hỗ trợ bạn, vui lòng để lại lời nhắn HMCinema sẽ trả lời bạn trong giây lát !" data-autopopup="0" data-width="" data-height=""></div>


        </div>

    </div>
</section>

@endsection