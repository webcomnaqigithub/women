<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function ActivateCustomerReview(Request $request)
    {
        $review = Review::find($request->review_id);
        $review->delete();
        return back();
    }
}
