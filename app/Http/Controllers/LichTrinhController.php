<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log; // Thêm dòng này
use Illuminate\Http\Request;
use App\Models\Phim;
use App\Models\Lichtrinh;
use App\Models\Rap;
use App\Models\Ve;
use App\Models\Phong;

use Carbon\Carbon;
class LichTrinhController extends Controller
{
    
    public function lichtrinh(Request $request)
    {

        Lichtrinh::where('ngay', '<', date('Y-m-d'))->update(['trang_thai' => false]);
        Lichtrinh::where('ngay', '=', date('Y-m-d'))->where('thoi_gian_ket_thuc', '<=', date('H:i:s'))->update(['trang_thai' => false]);
        // dd(date('Y-m-d')); // In ra ngày hiện tại

        Phim::where('ngay_ket_thuc', '<', date('Y-m-d'))->update(['trang_thai' => false]);
        // Ticket::join('schedules', 'tickets.schedule_id', '=', 'schedules.id')
        //     ->where('schedules.date', '<', date('Y-m-d'))
        //     ->update([
        //         'tickets.status' => false,
        //         'tickets.receivedCombo' => true,
        //     ]);

        $lichtrinhs = Lichtrinh::all();
        $raps = Rap::with('phongs')->where('trang_thai', 1)->get();
        // dd($raps);
        // $audios = Audio::all();
        // $subtitles = Subtitle::all();
        if (isset($request->rap) && isset($request->date)) {
            $date_cur = $request->date;
            $rap_cur = Rap::find($request->rap);
        } else {
            $date_cur = Carbon::today()->format('Y-m-d');
            $rap_cur = Rap::find(1);
        }
        $phims = Phim::whereDate('ngay_ket_thuc', '>=', $date_cur)->get();
        // dd($rap_cur);
        // dd($rap_cur->phongs);
        // $phong = Phong::find($id_phong); 
        // $latestSchedule = $phong->latestLichTrinhByDate($date_cur);
        // dd( $rap_cur->id_rap->$latestSchedule);
    

        return view('admin.lichtrinh.listlichtrinh', [
            'raps' => $raps,
            'date_cur' => $date_cur,
            'rap_cur' => $rap_cur,
            'lichtrinhs' => $lichtrinhs,
            'phims' => $phims,
            // 'audios' => $audios,
            // 'subtitles' => $subtitles,
            // 'endTimeLatest' => ''
            // 'latestSchedule' => $latestSchedule,
        ]);
    }

    public function create(Request $request)
    {
        $checkboxlichValue = $request->input('checkboxlich_value', 0);
        $phim = Phim::find($request->phim);
        $ngayphathanh = strtotime($phim->ngay_phat_hanh);
    
        $count = 0;
        if ($checkboxlichValue == 1) {
            // Nếu sử dụng checkbox, tạo lịch trình cho mỗi thời gian bắt đầu
            $thoigianbatdau = $request->startTime;
            while (true) {
                $count++;
                // Kiểm tra sự tồn tại của lịch trình cho thời gian bắt đầu hiện tại
                $lichtrinh_tontai = Lichtrinh::where('id_phong', $request->phong)
                                              ->where('ngay', $request->date)
                                              ->where('thoi_gian_bat_dau', $thoigianbatdau)
                                              ->exists();
                // Nếu không tồn tại lịch trình, tạo mới và lưu vào cơ sở dữ liệu
                if (!$lichtrinh_tontai) {
                    $tongthoigian = strtotime($thoigianbatdau) + ($phim->thoi_luong_phim * 60);
                    $gio_ketthuc = date('H', $tongthoigian);
                    $phut_ketthuc = date('i', $tongthoigian);
                    $phut_endround = (int)((round($phut_ketthuc) % 5 === 0) ? round($phut_ketthuc) : round(($phut_ketthuc + 5 / 2) / 5) * 5);
                    if ($phut_endround == 60) {
                        $gio_ketthuc++;
                        $phut_endround = 0;
                    }
                    $thoigianketthuc = sprintf('%02d:%02d', $gio_ketthuc, $phut_endround);

                    $lichtrinhs = new Lichtrinh([
                        'id_phong' => $request->phong,
                        'id_phim' => $request->phim,
                        'ngay' => $request->date,
                        'thoi_gian_bat_dau' => $thoigianbatdau,
                        'thoi_gian_ket_thuc' => $thoigianketthuc,
                        'early' => (strtotime($request->date) < $ngayphathanh) ? 1 : 0,
                    ]);
                    $lichtrinhs->save();
    
                    $thoigianbatdau = date('H:i', strtotime('+10 minutes', strtotime($thoigianketthuc)));
                } else {
                    // Nếu tồn tại lịch trình, chuyển sang thời gian bắt đầu tiếp theo
                    $thoigianbatdau = date('H:i', strtotime('+10 minutes', strtotime($thoigianbatdau)));
                }
    
                // Kiểm tra điều kiện thoát vòng lặp
                if (strtotime($thoigianbatdau) >= strtotime('22:00')) {
                    break;
                }
            }
        } else {
            // Nếu không sử dụng checkbox, chỉ tạo lịch trình cho thời gian bắt đầu được chỉ định
            $thoigianbatdau = $request->startTime;
            $lichtrinh_tontai = Lichtrinh::where('id_phong', $request->phong)
                                          ->where('ngay', $request->date)
                                          ->where('thoi_gian_bat_dau', $thoigianbatdau)
                                          ->exists();
            // Kiểm tra sự tồn tại của lịch trình cho thời gian bắt đầu chỉ định
            if (!$lichtrinh_tontai) {
                $tongthoigian = strtotime($thoigianbatdau) + ($phim->thoi_luong_phim * 60);
                $gio_ketthuc = date('H', $tongthoigian);
                $phut_ketthuc = date('i', $tongthoigian);
                $phut_endround = (int)((round($phut_ketthuc) % 5 === 0) ? round($phut_ketthuc) : round(($phut_ketthuc + 5 / 2) / 5) * 5);
                if ($phut_endround == 60) {
                    $gio_ketthuc++;
                    $phut_endround = 0;
                }
                $thoigianketthuc = sprintf('%02d:%02d', $gio_ketthuc, $phut_endround);
    
                $lichtrinhs = new Lichtrinh([
                    'id_phong' => $request->phong,
                    'id_phim' => $request->phim,
                    'ngay' => $request->date,
                    'thoi_gian_bat_dau' => $thoigianbatdau,
                    'thoi_gian_ket_thuc' => $thoigianketthuc,
                    'early' => (strtotime($request->date) < $ngayphathanh) ? 1 : 0,
                ]);
                $lichtrinhs->save();
            }
            // dd($thoigianketthuc);

        }
    
        return redirect('admin/lichtrinh?rap=' . $request->rap . '&date=' . $request->date);
    }

    public function status(Request $request)
    {
        $schedule = lichtrinh::find($request->schedule_id_lich_trinh);
        $schedule['trang_thai'] = $request->active;
        $schedule->save();
        return response('success',200);
    }

    public function early_status(Request $request)
    {
        Log::info('Received early status update request:', $request->all());
        $schedule = lichtrinh::find($request->early_id);
        $schedule['early'] = $request->active;
        $schedule->save();
        return response('success',200);
    }
    public function deleteAll(Request $request)
    {

        lichtrinh::where('id_phong', $request->room_id)->where('ngay', $request->date)->delete();
        return redirect('admin/lichtrinh?rap=' . $request->rap . '&date=' . $request->date);
    }
    public function xoaItem($id)
    {
        $schedule = lichtrinh::find($id);
        $schedule ->delete();
        return redirect()->back()->with('success', 'Thể loại phim đã được xóa thành công!');

    }


}