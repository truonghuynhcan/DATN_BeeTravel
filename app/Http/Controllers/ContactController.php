<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $data = session('data', []);
      
        return view('client.lien_he',compact('data'));
    }

    public function send(ContactRequest $request)
    {
        // Lấy dữ liệu từ form
        $data = $request->only(['name', 'email', 'title', 'message']);
        
        // Gửi mail
        Mail::to('nhittyps32142@fpt.edu.vn')->send(new ContactMail($data));

        // Thông báo gửi thành công
        return back()->with('success', 'Cảm ơn bạn đã liên hệ, chúng tôi sẽ phản hồi sớm nhất.');

    }
}
