<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loaiphim;
class LoaiPhimController extends Controller
{
    public function loaiPhim()
    {
       $loaiphims = Loaiphim::orderBy("id_loai_phim","desc")->Paginate(10);
       return view('admin.loaiphim.listloaiphim',['loaiphims'=> $loaiphims]);

    }
    public function saveStatus(Request $request)
    {
        $new_status = $request['new_status'];
        $loaiphim = LoaiPhim::find($request['id_loai_phim']);
        $loaiphim->trang_thai = $new_status;
        $loaiphim->save();
        // session()->put('status_' . $id_loai_phim, $new_status);
        return back()->withInput();
    }
    public function postCreate(Request $request)
    {
        $request->validate([
            'ten_loai_phim' => 'required|unique:loai_phim',
        ], [
            'ten_loai_phim.required' => "Vui lòng điền tên danh mục",
            'ten_loai_phim.unique' => 'Danh mục phim đã tồn tại',
        ]);
        
        // Thêm trạng thái mặc định vào dữ liệu trước khi tạo mới
        $requestData = $request->all();
        $requestData['trang_thai'] = 1;
    
        Loaiphim::create($requestData);
    
        return redirect('admin/loaiphim')->with('success', 'Added Successfully!');
    }
    public function postEdit(Request $request, $id)
    {
        $Loaiphim = Loaiphim::find($id);
        $request->validate([
            'ten_loai_phim' => 'required|unique:loai_phim'
        ], [
            'ten_loai_phim.required' => "Vui lòng điền tên danh mục",
            'ten_loai_phim.unique' => 'Danh mục phim đã tồn tại'
        ]);
        $requestData = $request->all();
        $requestData['trang_thai'] = 1;
        $Loaiphim->update($request->all());
        return redirect('admin/loaiphim')->with('success', 'Cập nhật thành công!');
    }
    public function delete($id)
    {
        $Loaiphim = Loaiphim::find($id);
        $Loaiphim->delete();
        return redirect()->back()->with('success', 'Thể loại phim đã được xóa thành công!');
    }

}
