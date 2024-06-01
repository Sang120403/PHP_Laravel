@extends('admin.layout.index')
@section('content')
{{-- @can('movie_genre') --}}
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>@lang('lang.movie_genre')</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <button style="float:right;padding-right:30px;" class="me-5  btn btn-primary float-right mb-3" data-bs-toggle="modal" data-bs-target="#loai_phim">
                            @lang('lang.create')
                        </button>
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">@lang('lang.genre')</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"></th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">@lang('lang.status')</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"></th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($loaiphims as $value)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $value['ten_loai_phim'] }}</h6>
                                                <!-- <p class="text-xs text-secondary mb-0">john@creative-tim.com</p> -->
                                            </div>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td id="#" class="align-middle text-center text-sm ">
                                        <form action="/savestatus" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_loai_phim" value="{!! $value['id_loai_phim'] !!}">
                                            <select name="new_status" onchange="this.form.submit()">
                                                <option value="1" {{ $value['trang_thai'] == 1 ? 'selected' : '' }}>Online</option>
                                                <option value="0" {{ $value['trang_thai'] == 0 ? 'selected' : '' }}>Offline</option>
                                            </select>
                                            <button type="submit" style="display:none;"></button> <!-- Nút ẩn để gửi form -->
                                        </form>
                                    </td>

                                    <td class="align-middle">
                                        <a href="#editModal" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-bs-target="#editModal{{ $value['id_loai_phim'] }}"  data-bs-toggle="modal">
                                            <i class="fa-solid fa-pen-to-square fa-lg">update</i>
                                        </a>
                                    </td>
                                    <td class="align-middle">
                                        <a href="#deleteModal" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-bs-target="#deleteModal{{ $value['id_loai_phim'] }}" data-bs-toggle="modal">
                                            <i class="fa-solid fa-pen-to-square fa-lg">delete</i>
                                        </a>
                                    </td>
                                </tr>
                                @include('admin.loaiphim.delete')
                                @include('admin.loaiphim.edit')
                                @endforeach
                                @include('admin.loaiphim.create')
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $loaiphims->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
