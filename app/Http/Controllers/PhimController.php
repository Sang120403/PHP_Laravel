<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phim;
use App\Models\Loaiphim;
use App\Models\Dienvien;
use App\Models\Daodien;
use App\Models\Gioihandotuoi;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
class PhimController extends Controller
{
    public function phim()
    {
       $phims = Phim::orderBy("id_phim","desc")->Paginate(10);
       return view('admin.phim.listphim',['phims'=> $phims]);

    }
    public function getCreate()
    {
        $dienviens = Dienvien::all();
        $daodiens = Daodien::all();
        $loaiphims = Loaiphim::get()->where('trang_thai',1);
        $gioihandotuois = Gioihandotuoi::all();
        return view('admin.phim.create', [
            'loaiphims' => $loaiphims,
            'daodiens' => $daodiens,
            'dienviens' => $dienviens,
            'gioihandotuois' => $gioihandotuois
        ]);
    }
    public function postCreate(Request $request)
    {

        // if ($request->hasFile('image')) {
        //     $imageFile = $request->file('image');
        //     $imageName = $imageFile->getClientOriginalName();
        //     $imagePath = $imageFile->move(public_path('images_phim'), $imageName);
        if ($request->hasFile('image')) {
        
            $file = $request->file('image');
            $result = Cloudinary::upload($file->getRealPath(), [
                'folder' => 'PHP_Laravel/Phim'
            ]);
            $imageUrl = $result->getSecurePath();
    
            $phim = new Phim([
                'ten_phim' => $request->name,
                'image' => $imageUrl,
                'thoi_luong_phim' => $request->thoiluongphim,
                'ngay_phat_hanh' => $request->ngayphathanh,
                'ngay_ket_thuc' => $request->ngayketthuc,
                'quoc_giasx' => $request->quocgiasx,
                'id_gioi_han_do_tuoi' => $request->gioihandotuoi,
                'trailer' => $request->trailer
            ]);
            $phim->save();
    
            // // Gắn các diễn viên và đạo diễn cho phim
            $dienviens = Dienvien::find($request->dienviens);
            $phim->dienviens()->attach($dienviens);

            $daodiens = Daodien::find($request->daodiens);
            $phim->daodiens()->attach($daodiens);

            $loaiphims = Loaiphim::find($request->loaiphims);
            $phim->loaiphims()->attach($loaiphims);
    
            return redirect('admin/phim');
        } else {
            return redirect('admin/movie')->with('warning', 'Vui lòng nhập hình ảnh');
        }
    }
    public function getEdit($id_phim)
    {
        $dienviens = Dienvien::all();
        $daodiens = Daodien::all();
        $loaiphims = Loaiphim::all();
        $gioihandotuois = Gioihandotuoi::all();
        $phim = Phim::find($id_phim);
        return view('admin.phim.edit', ['phim' => $phim,
            'loaiphims' => $loaiphims,
            'daodiens' => $daodiens,
            'dienviens' => $dienviens,
            'gioihandotuois' => $gioihandotuois]);
    }
    public function postEdit(Request $request, $id_phim)
    {

        $phim = Phim::find($id_phim);
        if ($request->hasFile('image')) {
        
            $file = $request->file('image');
            $result = Cloudinary::upload($file->getRealPath(), [
                'folder' => 'PHP_Laravel/Phim'
            ]);
            $imageUrl = $result->getSecurePath();
            $phim['image'] =  $imageUrl;}

        $phim['ten_phim'] = $request['tenphim'];
        $phim['thoi_luong_phim'] = $request['thoiluongphim'];
        $phim['ngay_phat_hanh'] = $request['ngayphathanh'];
        $phim['ngay_ket_thuc'] = $request['ngayketthuc'];
        $phim['quoc_giasx'] = $request['quocgiasx'];
        $phim['mieu_ta'] = $request['mieuta'];
        $phim['trailer'] = $request['trailer'];
        $phim['id_gioi_han_do_tuoi'] = $request['gioihandotuoi'];

        $phim->update();

        $dienviens = Dienvien::find($request->dienviens);
        $phim->dienviens()->detach();
        $phim->dienviens()->attach($dienviens);

        $daodiens = Daodien::find($request->daodiens);
        $phim->daodiens()->detach();
        $phim->daodiens()->attach($daodiens);

        $loaiphims = Loaiphim::find($request->loaiphims);
        $phim->loaiphims()->detach();
        $phim->loaiphims()->attach($loaiphims);


        return redirect('admin/phim')->with('success', "Cập nhật thành công!");
    }
    public function saveStatus(Request $request)
    {
        $new_status = $request['new_status'];
        $phim = Phim::find($request['id_phim']);
        $phim->trang_thai = $new_status;
        $phim->save();
        // session()->put('status_' . $id_loai_phim, $new_status);
        return back()->withInput();
    }

}
