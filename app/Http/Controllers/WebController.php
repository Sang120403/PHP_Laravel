<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log; // Thêm dòng này
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

use App\Models\Phim;
use App\Models\Loaiphong;
use App\Models\Rap;
use App\Models\Lichtrinh;
use App\Models\Gioihandotuoi;
use App\Models\Dienvien; 
use App\Models\Daodien;
use App\Models\Loaiphim;
use App\Models\Banner;
use App\Models\Ve;
use App\Models\Ve_Ghe;
use App\Models\Ghe;
use App\Models\Loaighe;
use App\Models\Giave;
use App\Models\Combo;
use App\Models\Tintuc;
use App\Models\Ve_Combo;
use App\Models\User;


class WebController extends Controller
{
    //
    public function home()
    {
//         DB::select("UPDATE schedules SET status = 0 WHERE date < CURDATE()");

   
//     DB::select("UPDATE schedules SET status = 0 WHERE date = CURDATE() AND endTime <= CURTIME()");

  
//     DB::select("UPDATE movies SET status = 0 WHERE endDate < CURDATE()");

   
//     DB::select("UPDATE tickets 
//                 JOIN schedules ON tickets.schedule_id = schedules.id
//                 SET tickets.status = 0, tickets.receivedCombo = 1 
//                 WHERE schedules.date < CURDATE()");

    
//     $news = DB::select("SELECT * FROM news WHERE status = 1 ORDER BY id DESC LIMIT 3");

    
//     $banners = DB::select("SELECT * FROM banners WHERE status = 1");

    
//     $movies = DB::select("SELECT * FROM movies 
//                           WHERE status = 1 AND endDate > CURDATE() AND releaseDate <= CURDATE() 
//                           ORDER BY releaseDate DESC LIMIT 6");

    
//     $moviesEarly = DB::select("SELECT DISTINCT movies.* FROM movies 
//                                JOIN schedules ON movies.id = schedules.movie_id 
//                                WHERE schedules.early = 1 AND schedules.date > CURDATE() 
//                                ORDER BY movies.releaseDate ASC");

// $mv=DB::select('select*from movies');
//     // dd($banners);
    
  
    // return view('web.pages.home', [
    //     'movies' => $movies,
    //     'moviesEarly' => $moviesEarly,
    //     'banners' => $banners,
    //     'news' => $news,
    // ]);
        // $user=User::where('xacminh_email',0)->delete();
       
        $currentDate = Carbon::now();

        $movies = Phim::where('trang_thai', 1)
                    ->where('ngay_ket_thuc', '>', $currentDate)
                    ->with('daodiens')
                    ->orderBy('ngay_phat_hanh', 'desc')
                    ->take(6)
                    ->get();
             
        

                    $moviesEarly = Phim::whereHas('lichtrinhs', function ($query) use ($currentDate) {
                        $query->where('early', 1)
                        ->where('ngay', '>', $currentDate);
                    })
                    ->where('trang_thai', 1)
                    ->where('ngay_ket_thuc', '>', $currentDate)
                    ->with('daodiens')
                    ->orderBy('ngay_phat_hanh', 'desc')
                    ->get();
    
    

     

        $banners =Banner::where('trang_thai', 1)->get();
 
                    

        $news = Tintuc::where('trang_thai', 1)
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get();
    
        

    return view('web.pages.home', [
            'movies' => $movies,
            'moviesEarly' => $moviesEarly,
            'banners' => $banners,
            'news' => $news,
        ]);
    }

    public function chitiet_phim($id, Request $request)
    {
        $currentDate = Carbon::now();

        $movie = Phim::find($id);
                   

       $schedulesEarly=new Collection();


       $roomTypes=Loaiphong::all();

       $cities=[];


       $theaters=Rap::where('trang_thai', 1)->get();
     
       foreach ($theaters as $theater) {
        if (array_search($theater->city, $cities)) {
            continue;
        } else {
            array_push($cities, $theater->city);
        }
    }

    $schedulesEarly = $movie->lichtrinhs->filter(function ($schedule) {
            return  $schedule->early == true;
        });
        if (isset($request->city)) {
            $city_cur = $request->city;
        } else {
            $city_cur = !empty($cities) ? $cities[0] : null;
        }
        
        if (isset($request->date)) {
            $date_cur = $request->date;
        } else {
            $date_cur = date('Y-m-d');
    }

    $theaters_city = Rap::where('trang_thai', 1)->where('thanh_pho', $city_cur)->get();
    return view('web.pages.chitiet_phim', [
            'movie' => $movie,
            'schedulesEarly' => $schedulesEarly,
            'theater_city' => $theaters_city,
            'date_cur' => $date_cur,
            'cities' => $cities,
            'city_cur' => $city_cur,
            'roomTypes' => $roomTypes,
            'theaters' => $theaters,
            'theaters_city' => $theaters_city,
        ]);
    }

    public function phims()
    {
        // Lấy danh sách diễn viên và đạo diễn
        $casts = Dienvien::all();
        $directors = Daodien::all();
        
        // Lấy danh sách phim đã ra mắt và đang chiếu
        $movies = Phim::orderBy('ngay_phat_hanh', 'desc')
                    ->where('trang_thai', 1)
                    ->where('ngay_phat_hanh', '<=', date('Y-m-d'))
                    ->where('ngay_ket_thuc', '>', date('Y-m-d'))
                    ->get();
        
        // Lấy danh sách phim sắp ra mắt
        $moviesSoon = Phim::where('trang_thai', 1)
                    ->where('ngay_phat_hanh', '>', date('Y-m-d'))
                    ->get();
        
                    $moviesEarly = Phim::join('lich_trinh', 'phim.id_phim', '=', 'lich_trinh.id_phim')
                    ->select('phim.*')
                    ->where('phim.trang_thai', 1)
                    ->where('phim.ngay_phat_hanh', '>', date('Y-m-d'))
                    ->where('lich_trinh.early', true)
                    ->groupBy('phim.id_phim', 'phim.ten_phim', 'phim.image', 'phim.thoi_luong_phim', 'phim.ngay_phat_hanh', 'phim.ngay_ket_thuc', 'phim.quoc_giasx','phim.id_gioi_han_do_tuoi','phim.trailer','phim.trang_thai') // Thêm cột phim.quoc_giasx vào GROUP BY
                    ->get();
                


        
        // Lấy danh sách thể loại phim
        $movieGenres = Loaiphim::all();
        
        // Lấy danh sách đánh giá phim
        $rating = Gioihandotuoi::all();
        
        return view('web.pages.phims', [
            'movies' => $movies,
            'movieGenres' => $movieGenres,
            'rating' => $rating,
            'casts' => $casts,
            'directors' => $directors,
            'moviesEarly' => $moviesEarly,
            'moviesSoon' => $moviesSoon
        ]);
    }

//loc theo phim
    public function locphim(Request $request)
    {
        // Lấy các dữ liệu cần thiết trước khi thực hiện truy vấn
        $casts = Dienvien::all();
        $directors = Daodien::all();
        $movieGenres = Loaiphim::all();
        $rating = Gioihandotuoi::all();

        if (!$request->casts && !$request->directors && !$request->movieGenres && !$request->rating) {
            return redirect('/phims');
        }

        // Khởi tạo query builder
        $query = Phim::query();

        // Thêm điều kiện lọc theo thể loại phim
        if ($request->movieGenres) {
            $query->whereHas('loaiphims', function ($q) use ($request) {
                $q->whereIn('loai_phim.id_loai_phim', $request->movieGenres);
            });
        }

        // Thêm điều kiện lọc theo diễn viên
        if ($request->casts) {
            $query->whereHas('dienviens', function ($q) use ($request) {
                $q->whereIn('dien_vien.id_dien_vien', $request->casts);
            });
        }

        // Thêm điều kiện lọc theo đạo diễn
        if ($request->directors) {
            $query->whereHas('daodiens', function ($q) use ($request) {
                $q->whereIn('dao_dien.id_dao_dien', $request->directors);
            });
        }

        // Thêm điều kiện lọc theo giới hạn độ tuổi
        if ($request->rating) {
            $query->where('phim.id_gioi_han_do_tuoi', $request->rating);
        }

        // Lọc các phim có trạng thái là true
        $query->where('trang_thai', 1);

        // Lấy kết quả truy vấn
        $movies = $query->get();

        // Phân loại các phim
        $moviesShowing = $movies->filter(function ($movie) {
            return ($movie->ngay_phat_hanh <= date('Y-m-d') && $movie->ngay_ket_thuc >= date('Y-m-d'));
        });

        $moviesSoon = $movies->filter(function ($movie) {
            return $movie->ngay_phat_hanh > date('Y-m-d');
        });

        $moviesEarly = $movies->filter(function ($movie) {
            return $movie->lichtrinhs->contains('early', 1);
        });

        return view('web.pages.phims', [
            'movies' => $moviesShowing,
            'moviesSoon' => $moviesSoon,
            'moviesEarly' => $moviesEarly,
            'movieGenres' => $movieGenres,
            'rating' => $rating,
            'casts' => $casts,
            'directors' => $directors
        ]);
    }






//dao dien
    public function chitiet_daodien($id)
    {
        $director = Daodien::find($id);
        return view('web.pages.chitiet_daodien', [
            'director' => $director,
        ]);
    }

//diễn viên
    public function chitiet_dienvien($id)
    {
        $cast = Dienvien::find($id);
        return view('web.pages.chitiet_dienvien', [
            'cast' => $cast,
        ]);
    }
//tin tức
    public function tintuc(Request $request)
    {
        $news=Tintuc::all();
        return view('web.pages.tintucs',['news'=>$news]);
    }
//chi tiết tin tức
    public function chitiet_tintuc($id)
    {
        $news=Tintuc::find($id);
        $news_all = Tintuc::where('trang_thai', 1)
        ->where('id_tin_tuc', '!=', $id)
        ->orderBy('created_at', 'desc') // Sắp xếp theo thời gian tạo
        ->take(4)
        ->get();

        return view('web.pages.chitiet_tintuc',[
            'news'=>$news,
            'news_all'=>$news_all,
        ]);
    }
//lịch theo phim
    public function lichtheophim(Request $request)
    {
        $theaters = Rap::where('trang_thai', 1)->get();
        $roomTypes = Loaiphong::all();
        $movies = Phim::whereDate('ngay_phat_hanh', '<=', Carbon::today()->format('Y-m-d'))
            ->where('ngay_ket_thuc', '>=', Carbon::today()->format('Y-m-d'))
            ->where('trang_thai', 1)->get();


        return view('web.pages.lichtheophim', [
            'movies' => $movies,
            'theaters' => $theaters,
            'roomTypes' => $roomTypes,
        ]);
    }

//Vé 
    public function ve($schedule_id)
    {
        $xoave=Ve::where('trang_thai_thanh_toan',null)->get();
       
        foreach($xoave as $xoa)
        {
            $xoa->delete();
        }
        // Xóa các vé chưa thanh toán và không được giữ cho lịch trình này
        Ve::where('trang_thai_giu_ve', 0)
            ->where('trang_thai_dat_ve', 0)
            ->where('id_lich_trinh', $schedule_id)
            ->delete();

        // Lấy danh sách các vé đang được giữ cho lịch trình này
        $danhSachVeGiu = Ve::where('trang_thai_giu_ve', true)
            ->where('id_lich_trinh', $schedule_id)
            ->get();

     
        // Lấy thông tin lịch trình
        $schedule = Lichtrinh::find($schedule_id);

        // Lấy danh sách các loại ghế
        $seatTypes = Loaighe::all();

        // Xác định giá vé dựa trên thời gian bắt đầu của lịch trình
        Log::info('Thời gian bắt đầu lịch trình:', ['thoi_gian_bat_dau' => $schedule->thoi_gian_bat_dau]);
        $timeStart = strtotime($schedule->thoi_gian_bat_dau);
        $timeBefore5PM = strtotime(date('H:i:s', strtotime('17:00')));
        $generation = $timeStart < $timeBefore5PM ? '08:00' : '17:00';
        $price = Giave::where('generation', 'vtt')
            ->where('ngay', 'like', '%' . date('l', strtotime($schedule->ngay)) . '%')
            ->where('thoi_gian_sau', $generation)
            ->value('gia_ve');

        // Lấy phụ thu phòng chiếu
        $roomSurcharge = $schedule->phongs->loaiphongs->phu_phi;
        $room = $schedule->phongs;
    
        $combos=Combo::where('status',1)->get();
        $movie = $schedule->phims;
        $tickets = Ve::where('id_lich_trinh', $schedule_id)->get();
        
        return view('web.pages.ve', [
            'schedule' => $schedule,
            'room' => $room,
            'seatTypes' => $seatTypes,
            'roomSurcharge' => $roomSurcharge,
            'price' => $price,
            'movie' => $movie,
            'tickets' => $tickets,
            'combos'=>$combos,
        ]);
    }

    public function tao_ve(Request $request)
    {
        // $ticketSeats = $request->input('ticket_seats');

        // // Lấy giá trị của schedule_id từ request
        // $scheduleId = $request->input('schedule_id');
        // $scheduleId = intval($scheduleId); // Chuyển sang kiểu số nguyên

        try {
            foreach ($request->ticketSeats as $seat) {
                // Kiểm tra xem ghế đã được đặt chưa
                $seatExists = Ve_Ghe::where('row', $seat[0])
                                    ->where('col', $seat[1])
                                    ->whereHas('ve', function ($query) use ($request) {
                                        $query->where('id_lich_trinh', $request->schedule);
                                    })
                                    ->exists();

                if ($seatExists) {
                    return response()->json(['error' => 'Ghế đã được đặt!!!'], 401);
                }
            }

            // Tạo vé mới
            $ticket = new Ve([
                'id_lich_trinh' => $request->schedule,
                'id_user' => 1,
                'trang_thai_giu_ve' => 1,
                'trang_thai_dat_ve' => 1,
                'ma_code' => rand(1000000000, 9999999999)
            ]);
            $ticket->save();
            
            // Lưu thông tin ghế vào chi tiết vé
            foreach ($request->ticketSeats as $seat) {
                $ticketSeat = new Ve_Ghe([
                    'row' => $seat[0],
                    'col' => $seat[1],
                    'gia_ve' => $seat[2],
                    'id_ve' => $ticket->id_ve,
                    
                ]);
                $seat = Ghe::where('row', $seat[0])->where('col', $seat[1])->where('id_phong', $ticket->lichtrinhs->id_phong)->get()->first();
                $ticketSeat->ten_loai_ghe = $seat->loaighes->ten_loai_ghe;
                $ticketSeat->save();
            }
          

            

            return response()->json(['id_ve' => $ticket->id_ve]);
        } catch (\Exception $e) {
            // Xử lý lỗi
            return response()->json(['error' => 'Có lỗi xảy ra trong quá trình tạo vé'], 500);
        }


    }

    public function xoave(Request $request)
    {
        Ve::destroy($request->ticket_id);
        return response('delete success', 200);
    }
    public function xoavecombo(Request $request)
    {
        Ve_Combo::where('id_ve',$request->ticket_id)->delete();
        return response('delete success', 200);
    }

    public function taovecombo(Request $request)
    {
        // Ghi nhật ký dữ liệu đầu vào
    

        $ticket = Ve::find($request->ticket_id);
    
        
        // Kiểm tra ticket có tồn tại không
        if (!$ticket) {
            return response()->json(['error' => 'Ticket not found'], 404);
        }
        
        foreach ($request->ticketCombos as $ticketCombo) {
            $combo = Combo::find($ticketCombo[0]);
            $details = '';
            foreach ($combo->foods as $food) {
                $details .= $food->pivot->so_luong . ' ' . $food->ten_food . ' + ';
            }
            $details = substr($details, 0, -3);

            $newTkCb = new Ve_Combo([
                'ten_combo' => $combo->ten_combo,
                'gia_combo' => $combo->gia,
                'mieu_ta' => $details,
                'so_luong' => $ticketCombo[1],
                'id_ve' => $ticket->id_ve
            ]);

            $newTkCb->save();
        }

        return response()->json(['id_ve' => $ticket->id_ve, 'message' => 'add combo success'], 200);
    }


    public function profile()
    {
        if (Auth::check()) {
            $user = Auth::user();
        } else {
            return redirect('/');
        }
        $sum = 0;
        foreach ($user->ves as $ticket) {
            $sum += $ticket['tong_tien_ve'];
        }
        $sort_ticket = $user->ves->sortDesc();
        // dd($sort_ticket->toArray());
        $sum_percent = ($sum * 100) / 4000000;
        return view('web.pages.profile', ['sort_ticket' => $sort_ticket, 'user' => $user, 'sum' => $sum, 'sum_percent' => $sum_percent]);
    }

    

    

}
