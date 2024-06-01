<div class="modal fade" id="CreateScheduleModal_{{ $room->id_phong }}" tabindex="-1" aria-labelledby="CreateScheduleModalLabel_{{ $room->id_phong }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CreateScheduleModalLabel_{{ $room->id_phong }}">@lang('lang.add_schedule')</h5>
                <button style="color: blue" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">hihi</button>
            </div>
            <div class="modal-body">

                <form action="{{ url('admin/lichtrinh/create') }}" method="POST">
                    @csrf
                    <div class="mb-3" id="startTimeContainer_{{ $room->id_phong }}">
                        @php
                            $hasSchedule = false;
                            $newStartTime = '08:00';
                        @endphp
                        @foreach($room->latestLichTrinhByDate(date('Y-m-d', strtotime($date_cur))) as $lichtrinh)
                            @if($lichtrinh['id_lich_trinh'] != null)
                                @php
                                    $hasSchedule = true;
                                    $lastEndTime = strtotime($lichtrinh['thoi_gian_ket_thuc']);
                                    $newStartTime = date('H:i', strtotime('+10 minutes', $lastEndTime)); // Cộng thêm 10 phút
                                @endphp
                                <label for="startTime_{{ $room->id_phong }}" class="form-label">@lang('lang.start_time')</label>
                                <input type="time" class="form-control" id="startTime_{{ $room->id_phong }}" name="startTime" value="{{ $newStartTime }}" placeholder="hihi">
                                @break
                            @endif
                        @endforeach
                        @if (!$hasSchedule)
                            <label for="startTime_{{ $room->id_phong }}" class="form-label">@lang('lang.start_time')</label>
                            <input type="time" class="form-control" id="startTime_{{ $room->id_phong }}" name="startTime" value="08:00" placeholder="hihi">
                        @endif
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remainingSchedules_{{ $room->id_phong }}" name="checkboxlich">
                        <label class="form-check-label" for="remainingSchedules_{{ $room->id_phong }}">Hiển Thị Tất Cả Lịch</label>
                    </div>
                    <div class="mb-3">
                        <label for="movie_{{ $room->id }}" class="form-label">@lang('lang.movie')</label>
                        <select class="form-control" id="movie_{{ $room->id_phong }}" name="phim" required>
                            @foreach($phims as $movie)
                            <option value="{{ $movie->id_phim }}" @if ($loop->first) selected @endif>{{ $movie->ten_phim }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" id="checklichvalue_{{ $room->id_phong }}" name="checkboxlich_value" value="0">
                    <input type="hidden" name="phong" value="{{ $room->id_phong }}">
                    <input type="hidden" name="date" value="{{ $date_cur }}">
                    <input type="hidden" name="rap" value="{{ $rap_cur->id_rap }}">
                    <button type="submit" class="btn btn-primary">@lang('lang.save_changes')</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $('#remainingSchedules_{{ $room->id_phong }}').change(function() {
            var isChecked = $(this).is(':checked');
            if (isChecked) {
                $('#startTimeContainer_{{ $room->id_phong }}').hide();
                $('#checklichvalue_{{ $room->id_phong }}').val(1); 
                
                @if($hasSchedule)
                    var lastEndTime = '{{ $newStartTime }}';
                    $('#startTime_{{ $room->id_phong }}').val(lastEndTime);
                @else
                    $('#startTime_{{ $room->id_phong }}').val('08:00');
                @endif
            } else {
                $('#startTimeContainer_{{ $room->id_phong }}').show();
                $('#checklichvalue_{{ $room->id_phong }}').val(0); 
            }
        });
    });
</script>

    
