<?php

namespace App\Http\Controllers\Front\Merchant;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\Notification_cust;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    use Notification_cust;
    public function show(Request $request)
    {
        $orderid = DB::table('mshop_order')->where('baseid', $request->id)->first()->id;

        $domains = ['order', 'order/base', 'order/base/address', 'order/base/coupon', 'order/base/product', 'order/base/service'];
        $historyItems = \Aimeos\MShop::create( $this->context(), 'order/base' )->get($request->id, $domains);
        $order = \Aimeos\MShop::create( $this->context(), 'order' )->get($orderid, $domains);
        // dd($order);
        return view('front.profile.order.show', compact('historyItems', 'order'));
    }

    public function update_status(Request $request)
    {
        $order_base_product = DB::table('mshop_order_base_product')->where('id', $request->id);
        $order = DB::table('mshop_order')->where('baseid', $order_base_product->first()->baseid);
        $order_base = DB::table('mshop_order_base')->where('id', $order_base_product->first()->baseid)->first();
        $receiver_name = DB::table('users')->where('id',$order_base->customerid)->first();

        
        switch ($request->status) {
            case "reject":
                $order_base_product->update(['statuspayment' => 2, 'statusdelivery' => 6]);  
                
                $this->sendNotification(
                    $order_base_product->first()->siteid,
                    $order_base->customerid,
                    $receiver_name->name,
                    $receiver_name->icon,
                    'تم إلغاء طلب شراء',
                    $order_base_product->first()->name,
                    '/' . $receiver_name->langid . '/order/' . $order_base->id
                );
                break;
            case "accept":
                $order_base_product->update(['statuspayment' => 5, 'statusdelivery' => 2]);  
                $order->update(['statusdelivery' => 2]); 
                
                $this->sendNotification(
                    $order_base_product->first()->siteid,
                    $order_base->customerid,
                    $receiver_name->name,
                    $receiver_name->icon,
                    'تم قبول طلب شراء',
                    $order_base_product->first()->name,
                    '/' . $receiver_name->langid . '/order/' . $order_base->id
                );
                break;
            case "lost":
                $order_base_product->update(['statusdelivery' => 5]);  

                $this->sendNotification(
                    $order_base_product->first()->siteid,
                    $order_base->customerid,
                    $receiver_name->name,
                    $receiver_name->icon,
                    'تم الغاء طلب شراء',
                    $order_base_product->first()->name,
                    '/' . $receiver_name->langid . '/order/' . $order_base->id
                );
                break;
            case "delivered":
                $order_base_product->update(['statusdelivery' => 4]);  
                $order->update(['statusdelivery' => 4]);  

                $this->sendNotification(
                    $order_base_product->first()->siteid,
                    $order_base->customerid,
                    $receiver_name->name,
                    $receiver_name->icon,
                    'تم استلام طلب شراء',
                    $order_base_product->first()->name,
                    '/' . $receiver_name->langid . '/order/' . $order_base->id
                );

                break;
            case "prepared":
                $order_base_product->update(['statusdelivery' => 8]);  

                $this->sendNotification(
                    $order_base_product->first()->siteid,
                    $order_base->customerid,
                    $receiver_name->name,
                    $receiver_name->icon,
                    'تم تجهيز طلب شراء',
                    $order_base_product->first()->name,
                    '/' . $receiver_name->langid . '/order/' . $order_base->id
                );
                break;
        }
        return response()->json(['data'=>'success']);
    }

    public function ProductRating(Request $request)
    {
        $request->validate([
            'productid' => 'required',
            'review_comment' => 'required',
            'review_rating' => 'required',
            'siteid' => 'required',
        ]);
        $check_customerproduct = DB::table('mshop_review')->where('customerid', auth()->user()->id)->where('refid', $request->productid)->first();
        if($check_customerproduct){
            return response()->json(['status'=>'fail']);
        }

        DB::table('mshop_review')->insert([
            'siteid' => $request->siteid,
            'domain' => 'product',
            'refid' => $request->productid,
            'customerid' => auth()->user()->id,
            'ordprodid' => '',
            'name' => auth()->user()->name,
            'status' => 1,
            'rating' => $request->review_rating,
            'comment' => $request->review_comment,
            'response' => auth()->user()->icon,
            'mtime' => Carbon::now(),
            'ctime' => Carbon::now(),
            'editor' => auth()->user()->email,
        ]);

        $averageRating = DB::table('mshop_review')->where('refid', $request->productid)->avg('rating');
        DB::table('mshop_product')->where('id', $request->productid)->update(['rating'=>$averageRating]);
        
        // ---------------Update store rating according to the product rate---------------
        $store_rating = DB::table('mshop_product')->where('id', $request->productid)->avg('rating');
        User::where('siteid', $request->siteid)->first()->update(['rating' => $store_rating]);
        // ---------------Update store rating according to the product rate---------------


        return response()->json(['status'=>'success']);
    }

    public function VendorRating(Request $request)
    {
        $request->validate([
            'orderid' => 'required',
            'review_comment' => 'required',
            'review_rating' => 'required',
            'siteid' => 'required',
        ]);

        DB::table('mshop_review')->insert([
            'siteid' => $request->siteid,
            'domain' => 'store',
            'refid' => $request->siteid,
            'customerid' => auth()->user()->id,
            'ordprodid' => '',
            'name' => '',
            'status' => 1,
            'rating' => $request->review_rating,
            'comment' => $request->review_comment,
            'response' => '',
            'mtime' => Carbon::now(),
            'ctime' => Carbon::now(),
            'editor' => auth()->user()->email,
        ]);

        return response()->json(['status'=>'success']);
    }
}
