@extends('admin.layout.index')

@section('css')
<style>
#time + span {
    padding-right: 30px;
}

#time:invalid + span::after {
    position: absolute;
    content: "✖";
    padding-left: 5px;
}

#time:valid + span::after {
    position: absolute;
    content: "✓";
    padding-left: 5px;
}
</style>
@endsection

@section('content')
{{-- @can('schedule_movie') --}}
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>@lang('lang.schedule')</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <form action="admin/lichtrinh" method="get">
                        <div class="row container">
                            <div class="col-5">
                                <div class="input-group">
                                    <span class="input-group-text bg-gray-200">@lang('lang.theater')</span>
                                    <select id="rap" class="form-select ps-2" name="rap" aria-label="">
                                        @foreach($raps as $rap)
                                        <option value="{{ $rap->id_rap }}" @if($rap == $rap_cur) selected @endif>
                                            {{ $rap->ten_rap }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="input-group">
                                    <span class="input-group-text bg-gray-200">@lang('lang.show_date')</span>
                                    <input name="date" id="date" value="{{ date('Y-m-d', strtotime($date_cur)) }}" aria-label="" class="form-control ps-2" type="text">
                                </div>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn bg-gradient-primary">@lang('lang.submit')</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive m-2">
                        <table class="table table-bordered table-striped align-items-center text-center">
                            <colgroup>
                                <col span="1" style="width: 40%;">
                                <col span="1" style="width: 30%;">
                                <col span="1" style="width: 30%;">
                            </colgroup>
                            <thead class="table-primary">
                                <tr>
                                    <th class="text-uppercase font-weight-bolder">@lang('lang.room')</th>
                                    <th class="text-uppercase font-weight-bolder">@lang('lang.room_type')</th>
                                    <th class="text-uppercase font-weight-bolder">@lang('lang.seat')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($rap_cur)
                                        @foreach($rap_cur->phongs as $room)
                                            @if($room->trang_thai == 1)
                                                <tr>
                                                    <td>{{ $room->ten_phong }}</td>
                                                    <td>{{ $room->loaiphongs->ten_loai_phong }}</td>
                                                    <td>{{ $room->ghes->count() }}</td>
                                                </tr>

                                                <tr>
                                                    <td colspan="3">
                                                        <table id="room_{{$room->id_phong}}" class="table table-bordered align-items-center">
                                                            <colgroup>
                                                                <col span="1" style="width: 20%;">
                                                                <col span="1" style="width: 80%;">
                                                            </colgroup>
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-uppercase fw-bold">@lang('lang.time')</th>
                                                                    <th class="text-uppercase fw-bold text-start">@lang('lang.movies')</th>
                                                                    <!-- {{--                                                            <th class="text-uppercase fw-bold">@lang('lang.early_screening')</th>--}} -->
                                                                    <th class="text-uppercase fw-bold">@lang('lang.status')</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
 
                                                                 @foreach($room->lichTrinhByDate(date('Y-m-d', strtotime($date_cur))) as $schedule)
                                                                <tr class="delete_schedule" id="schedules_{{ $schedule->id_lich_trinh }}">
                                                                    
                                                                    <td>
                                                                        {{ date('H:i', strtotime($schedule->thoi_gian_bat_dau)) }}- {{ date('H:i', strtotime($schedule->thoi_gian_ket_thuc)) }}
                                                                    </td>
                                                                    <td class="text-start">
                                                                        {{ $schedule->phims->ten_phim }}
                                                                    </td>
                                                                    
                                                                    @if(date('Y-m-d', strtotime($schedule->ngay))< date('Y-m-d', strtotime($schedule->phims->ngay_phat_hanh)))
                                                                        <td id="early_status{!! $schedule['id_lich_trinh'] !!}" class="align-middle text-center text-sm ">
                                                                            @if($schedule->early == 1)
                                                                            <a href="javascript:void(0)" class="btn_active" onclick="changeearlystatus({!! $schedule['id_lich_trinh'] !!},0)">
                                                                                <span class="badge badge-sm bg-gradient-success">
                                                                                    Early access
                                                                                </span>
                                                                            </a>
                                                                            @else
                                                                            <a href="javascript:void(0)" class="btn_active" onclick="changeearlystatus({!! $schedule['id_lich_trinh'] !!},1)">
                                                                                <span class="badge badge-sm bg-gradient-secondary">
                                                                                    Offline
                                                                                </span>
                                                                            </a>
                                                                            @endif
                                                                        </td>
                                                                        @else
                                                                        <td id="status{!! $schedule['id_lich_trinh'] !!}" class="align-middle text-center text-sm ">
                                                                                {{-- {{ $schedule['id_lich_trinh'] }} --}}

                                                                            @if($schedule->trang_thai == 1)
                                                                            <a href="javascript:void(0)" class="btn_active" onclick="changestatus({!! $schedule['id_lich_trinh'] !!},0)">
                                                                                <span class="badge badge-sm bg-gradient-success">Online</span>
                                                                            </a>
                                                                            @else
                                                                            <a href="javascript:void(0)" class="btn_active" onclick="changestatus({!! $schedule['id_lich_trinh'] !!},1)">
                                                                                <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                                                                            </a>
                                                                            @endif
                                                                        </td>
                                                                        @endif
                                                                        <td>
                                                                            <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#xoaItem{{ $schedule->id_lich_trinh }}" style="padding: 0.2rem 0.5rem;margin-top:10px; font-size: 0.875rem; line-height: 1.5; border-radius: 1rem;">
                                                                                Xóa
                                                                            </button>

                                                                            <div class="modal fade" id="xoaItem{{$schedule->id_lich_trinh }}" tabindex="-1" aria-labelledby="xoaItem{{ $schedule->id_lich_trinh }}" aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="xoaItemlLabel{{ $schedule->id_lich_trinh }}">Xác nhận xóa lịch trình</h5>
                                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <form action="/admin/lichtrinh/xoaItem/{{ $schedule->id_lich_trinh }}" method="POST">
                                                                                                @csrf
                                                                                                <input type="hidden" value="{{ $rap_cur->id_rap }}" name="rap">
                                                                                                <input type="hidden" value="{{ $date_cur }}" name="date">
                                                                                                <input type="hidden" value="{{ $room->id_phong }}" name="room_id">
                                                                                                <input type="hidden" value="{{ $schedule->id_lich_trinh }}" name="idlich">
                                                                                                <!-- Button Xóa được di chuyển vào trong form -->
                                                                                                <button type="submit" class="btn btn-danger">OK</button>
                                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                                                            </form>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                        </div>
                                                                        </td>
                                                                </tr> 
                                                                @endforeach
                                                                <tr>
                                                                    <td>
                                                                        <button class="btn btn-info btn_add" data-bs-toggle="modal" data-bs-target="#CreateScheduleModal_{{ $room->id_phong }}">
                                                                            <i class="fa-regular fa-circle-plus"></i> @lang('lang.add')
                                                                            <a> {{$room->id_phong  }}</a>
                                                                        </button>
                                                                        {{-- {{ date('H:i', strtotime($lichtrinh->thoi_gian_ket_thuc . '+10 minutes')) }} --}}
                                                                        @include('admin.lichtrinh.modallist');

                                                                    </td>
                                                                    <td colspan="3">
                                                                        <div class="d-flex justify-content-end">
                                                                            {{-- <button class="btn btn-warning btn_changeAllStatus" onclick="changeAllStatus({{
                                                                                    $room->id }})">
                                                                                <i class="fa-solid fa-repeat"></i> Thay đổi trạng thái tất cả
                                                                            </button> --}}
                                                                            {{-- <a href="javascript:void(0);" data-date="{{$date_cur}}" data-theater="{{$theater_cur->id}}" data-room="{{$room->id}}" data-url="{{ url('admin/schedule/deleteall') }}" class="btn btn-dark ms-3 delete_all">
                                                                                <i class="fa-regular fa-trash"></i> Delete all
                                                                            </a> --}}
                                                                            <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#xoaModal{{ $room->id_phong }}">
                                                                                Xóa Tất Cả
                                                                            </button>
                                                                            
                                                                            <!-- Modal Xóa -->
                                                                            <div class="modal fade" id="xoaModal{{ $room->id_phong }}" tabindex="-1" aria-labelledby="xoaModalLabel{{ $room->id_phong }}" aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title" id="xoaModalLabel{{ $room->id_phong }}">Xác nhận xóa phòng</h5>
                                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <form action="/admin/lichtrinh/deleteAll" method="POST">
                                                                                                @csrf
                                                                                                <input type="hidden" value="{{ $rap_cur->id_rap }}" name="rap">
                                                                                                <input type="hidden" value="{{ $date_cur }}" name="date">
                                                                                                <input type="hidden" value="{{ $room->id_phong }}" name="room_id">
                                                                                                <!-- Button Xóa được di chuyển vào trong form -->
                                                                                                <button type="submit" class="btn btn-danger">OK</button>
                                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                                                            </form>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>               
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endisset
                            </tbody>
                        </table>
                    </div>
                
                
                
                
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @else --}}
{{-- <h1 align="center">Permissions Deny</h1> --}}
{{-- @endcan --}}
@endsection

{{-- @section('scripts') --}}
{{-- // @isset($rap_cur)
// @foreach($rap_cur->phongs as $room)
// console.log("Room ID: {{$room->id_phong}}");
// $('#remainingSchedules_{{$room->id_phong}}').change(function() {
//     console.log("Checkbox change detected.");
//     if ($(this).is(':checked')) {
//         console.log("Checkbox is checked.");
//         console.log("Start Time Input ID: #startTime_{{ $room->id_phong }}");
//         $('#CreateScheduleModal_{{ $room->id }}').find('#startTime_{{ $room->id_phong }}').prop('readonly', true);
//     } else {
//         console.log("Checkbox is unchecked.");
//         console.log("Start Time Input ID: #startTime_{{ $room->id_phong }}");
//         $('#CreateScheduleModal_{{ $room->id }}').find('#startTime_{{ $room->id_phong }}').prop('readonly', false);
//     }
// });
// @endforeach
// @endisset --}}



<script>
    function changestatus(schedule_id_lich_trinh, active) {
        if (active === 1) {
            $("#status" + schedule_id_lich_trinh).html
            (' <a href="javascript:void(0)"  class="btn_active" onclick="changestatus(' + schedule_id_lich_trinh + ',0)">\
                    <span class="badge badge-sm bg-gradient-success">Online</span>\
            </a>')
        } else {
            $("#status" + schedule_id_lich_trinh).html(' <a  href="javascript:void(0)" class="btn_active"  onclick="changestatus(' + schedule_id_lich_trinh + ',1)">\
                    <span class="badge badge-sm bg-gradient-secondary">Offline</span>\
            </a>')
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/admin/lichtrinh/status",
            type: 'GET',
            dataType: 'json',
            data: {
                'active': active,
                'schedule_id_lich_trinh': schedule_id_lich_trinh
            },
            success: function(data) {
                if (data['success']) {
                    // alert(data.success);
                } else if (data['error']) {
                    alert(data.error);
                }
            }
        });
    }
</script>

<script>
function changeearlystatus(early_id, active) {
    if (active === 1) {
        $("#early_status" + early_id).html(' <a href="javascript:void(0)"  class="btn_active" onclick="changeearlystatus(' + early_id + ',0)">\
                <span class="badge badge-sm bg-gradient-success">Early access</span>\
        </a>');
    } else {
        $("#early_status" + early_id).html(' <a  href="javascript:void(0)" class="btn_active"  onclick="changeearlystatus(' + early_id + ',1)">\
                <span class="badge badge-sm bg-gradient-secondary">Offline</span>\
        </a>');
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/admin/lichtrinh/early_status",
        type: 'GET', // Đảm bảo rằng đây là POST nếu phương thức xử lý POST
        dataType: 'json',
        data: {
            'active': active,
            'early_id': early_id
        },
        success: function(data) {
            if (data['success']) {
                console.log(data.success); // In ra để kiểm tra
            } else if (data['error']) {
                alert(data.error);
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}

</script>

</script>
