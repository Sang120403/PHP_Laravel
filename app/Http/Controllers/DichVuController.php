<?php

namespace App\Http\Controllers;

use App\Models\Combo;
use App\Models\Food;
// use App\Models\Movie;
// use App\Models\Price;
// use App\Models\RoomType;
// use App\Models\Schedule;
// use App\Models\SeatType;
// use App\Models\Ticket;
// use App\Models\TicketCombo;
// use App\Models\TicketFood;
// use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DichVuController extends Controller
{
    public function buyCombo(Request $request) 
    {
        $combos = Combo::where('status', 1)->get();
        $foods = Food::where('trang_thai', 1)->get();
        return view('admin.buyCombo.buycombo', [
            'combos' => $combos,
            'foods' => $foods,
        ]);
    }
}