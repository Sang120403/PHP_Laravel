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
                <li class="breadcrumb-item"><a class="link link-dark text-decoration-none">@lang('lang.casts')</a></li>
                <li class="breadcrumb-item active" aria-current="page">{!! $director['ten_dao_dien'] !!}</li>
            </ol>
        </nav>

        <div class="movie mt-5">
            {{--  Movie title  --}}
            <h2 class="mt-2">{!! $director['ten_dao_dien'] !!}</h2>
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="card border border-4 border-warning rounded-0">
                        @if(strstr($director['hinh_dao_dien'],"https") == "")
                            <img class="card-img-top rounded-0" alt='...'
                                 src="images/daodien/{{ $director['hinh_dao_dien'] }}">
                        @else
                            <img class="card-img-top rounded-0" alt='...'
                                 src="images/daodien/{{ $director['hinh_dao_dien'] }}">
                        @endif
                    </div>
                </div>

                <div class="col-sm-6 col-lg-9">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex align-items-center"><strong class="pe-1">@lang('lang.national')
                                : </strong>{!! $director['ten_dao_dien'] !!}
                        </li>
                        <li class="list-group-item d-flex align-items-center"><strong class="pe-1">@lang('lang.birthday')
                                : </strong>{!! $director['ngaysinh'] !!}
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
                        {!! $director['content'] !!}
                    </div>
                </div>
            </div>
            <div class="row container">
                <h4 class="mt-4">Phim đã tham gia</h4>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <table class="table table-striped">
                        <tbody>
                        @foreach($director->phims as $value)
                            <tr>
                                <td>
                                    <a href="/chitiet_phim/{!! $value['id_phim'] !!}" class="link link-dark text-decoration-none hover_movie">
                                        @if(strstr($value['image'],"https") == "")
                                            <img class="card-img-top rounded-0" alt='...'
                                                 src="{{ asset('images/latmat6.jpg') }}" style="width: 50px">
                                        @else
                                            <img class="card-img-top rounded-0" alt='...'
                                                 src="{!! $value['image'] !!}" style="width: 50px">
                                        @endif
                                        &nbsp; {!! $value['ten_phim'] !!}
                                    </a>
                                </td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

