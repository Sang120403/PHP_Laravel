<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Vonage\Client\Credentials\Basic;
use Vonage\Client;
use Exception;
use Vonage\SMS\Message\SMS;








class AuthController extends Controller
{
    public function dangnhap(Request $request)
    {
        $user_dl=User::where('xacminh_email',0)->delete();
        // Validate input
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required'
            ],
            [
                'username.required' => 'Vui lòng nhập email hoặc số điện thoại!',
                'password.required' => 'Vui lòng nhập mật khẩu!'
            ]
        );

        // Attempt to log the user in using email or phone
        $credentials = ['password' => $request->password];
        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $request->username;
        } else {
            $credentials['phone'] = $request->username;
        }

        $user = User::where('email', $request->username)
        ->orWhere('phone', $request->username)
        ->first();

        if ($user && $user->status == 0) {
            return redirect('/')->with('warning', 'Tài khoản đã bị chặn');
        }

       
        if (Auth::attempt($credentials)) {
           
            if ($request->has('rememberme')) {
                Session::put('username_web', $request->username);
                Session::put('password_web', $request->password);
            } else {
                Session::forget('username_web');
                Session::forget('password_web');
            }

            // Redirect to the intended URL or a default URL
            $url = $request->input('url', '/default-url');
            return redirect($url)->with('success', 'Chào mừng bạn ' . Auth::user()->fullName . ' !');
        } else {
            return redirect('/')->with('warning', 'Sai tài khoản hoặc mật khẩu');
        }
    }

    public function dangky(Request $request)
    {
        
        $request->validate([
            'fullName' => 'required|min:1',
            'email' => 'nullable|required|max:255|unique:users',
            'phone' => 'nullable|required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:12|unique:users',
            'password' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/',
            'repassword' => 'required|same:password',
        ], [
            'fullName.required' => 'Vui lòng nhập họ tên',
            'email.required' => 'Vui lòng nhập mail',
            'email.unique' => 'Email đã tồn tại ',
            'phone.min'=>'Vui lòng nhập tối thiểu 10 số',
            'phone.max'=>'Chỉ được nhập tối đa 12 số',
            'password.regex'=>'Mật khẩu phải có ít nhất 1 chữ hoa,1 chữ thường,1 số và độ dài tối thiểu 6 kí tự',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'repassword.required' => 'Vui lòng nhập lại mật khẩu',
            'repassword.same' => "Mật khẩu nhập lại không trùng khớp",
        ]);

        
        

        // $response = Http::get('https://api.zerobounce.net/v2/validate', [
        //     'api_key' => '7e53334ffa4f4b5aa3e0c9c6d42946ba',
        //     'email' => $request->email,
        // ]);

        // if ($response->successful()) {
        //     $data = $response->json();
        //     if ($data['status'] == 'valid') {

                // Email hợp lệ, tiếp tục lưu user vào database và gửi email xác thực
                $token = Str::random(20);
                $arr_us = [
                    'fullName' => $request['fullName'],
                    'password' => bcrypt($request['password']),
                    'role' => 1,
                    'status' => 1,
                    'email'=>$request->email,
                    'phone'=>$request->phone,
                    'xacminh_email'=>0,
                    'remember_token'=>$token
                ];
                $user = new User($arr_us);
                $user->save();

                // Gửi email xác thực
                if ($user->email) {
                    $to_email = $user->email;
                    
                    $link_verify = url('/xacthucemail?email=' . $to_email . '&token=' . $token);

                    Mail::send('web.pages.xacthuc_mail',['user' => $user,'link_verify' =>$link_verify, 'token' => $token], function ($email) use ($user) {
                        $email->to($user->email)->subject('Bạn Đã ĐK Thành Công');
                    });
                    
                }

                return redirect('/')->with('success', 'Đăng Ký Thành Công! Vui lòng kiểm tra email để xác thực tài khoản.');
        //     } else {
        //         // Email không hợp lệ, trả về thông báo lỗi
        //         return back()->withErrors(['email' => 'Địa chỉ email không hợp lệ.'])->withInput();
        //     }
        // } else {
        //     // Lỗi khi gửi yêu cầu đến ZeroBounce
        //     return back()->withErrors(['email' => 'Đã có lỗi xảy ra khi kiểm tra địa chỉ email. Vui lòng thử lại sau.'])->withInput();
        // }
    }


    

    public function xacthucemail(Request $request)
    {
        $user = User::where('email', $request->email)
                    ->where('remember_token', $request->token)
                    ->first();

        if ($user) {
            
            $user->xacminh_email = 1;
            
            $user->save();

        

            return redirect('/')->with('success', 'Tài khoản của bạn đã được kích hoạt thành công!');
        } else {
            return redirect('/')->with('error', 'Liên kết xác thực không hợp lệ hoặc tài khoản đã được kích hoạt.');
        }
    }


    

    public function dangxuat()
    {
        Auth::logout();
        return redirect('/')->with('success','Đăng xuất thành công');
    }

    public function quenmatkhau(Request $request)
    {
        // Kiểm tra xem trường email có giá trị không và loại bỏ các khoảng trắng không cần thiết
        $email = trim($request->input('email'));
        if (!$email) {
            return back()->withErrors(['warning' => 'Vui lòng nhập địa chỉ email'])->withInput();
        }

        // $response = Http::get('https://api.zerobounce.net/v2/validate', [
        //     'api_key' => '797d21a7853344da8936342de2169478',
        //     'email' => $email,
        // ]);

        // if ($response->successful()) {
        //     $data = $response->json();
        //     if (isset($data['status']) && $data['status'] == 'valid') {
                // Email hợp lệ, tiếp tục lưu user vào database và gửi email xác thực
                $newPassword = Str::random(6);
                $pass_hash = bcrypt($newPassword);

                $user = User::where('email', $email)->first();
                if ($user) {
                    $user->password = $pass_hash;
                    $user->save();

                    // Gửi email xác thực
                    $subject = 'Quên Mật Khẩu - Mật Khẩu Mới';
                    $content = "Mật Khẩu Mới Của Bạn Là: <strong>$newPassword</strong>. Vui Lòng Sử Dụng Mật Khẩu Này Để Đăng Nhập Và Thay Đổi Nó Sớm Nhất";
                    Mail::raw($content, function ($message) use ($user, $subject, $content) {
                        $message->to($user->email)
                                ->subject($subject)
                                ->setBody($content, 'text/html'); // Đảm bảo email được hiểu là HTML
                    });
                } else {
                    return back()->withErrors(['warning' => 'Email không tồn tại'])->withInput(); 
                }

                return redirect('/')->with('success', 'Mật Khẩu Bạn Đã Thay Đổi Vui Lòng Kiểm Tra Mail');
            // } else {
            //     // Email không hợp lệ, trả về thông báo lỗi
            //     return back()->withErrors(['warning' => 'Địa chỉ email không hợp lệ.'])->withInput();
            // }
    }
}


    


