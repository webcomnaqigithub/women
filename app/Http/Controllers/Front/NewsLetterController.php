<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\NewsLetter;
use Illuminate\Http\Request;

class NewsLetterController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:newsletters,email',
        ]);

        NewsLetter::create(['email' => $request->email]);
        return back()->with([
            'msg_status' => 'success',
            'msg_title' => 'تم الاشتراك بنجاح',
            'msg_content' => 'تم الاشتراك بالنشرة الشهرية بنجاح'
            ]);
    }
}
