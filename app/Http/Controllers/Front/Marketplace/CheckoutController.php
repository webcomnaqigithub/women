<?php

namespace App\Http\Controllers\Front\Marketplace;

use Aimeos\Shop\Facades\Shop;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\UserAddress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class CheckoutController extends Controller
{
    public function StoreAddress(AddressRequest $request)
    {
        $data = $request->except('_token', 'usid');

        $addresses = UserAddress::where('parentid', auth()->user()->id)->get();
        if($request->has('default') && $request->default == 1){
            foreach($addresses as $item){
                $item->update(['default' => 0]);
            }
            $data['default'] = 1;
        }else{
            $data['default'] = 0;
        }

        if($request->has('addrid')){
            $user_addr =  UserAddress::find($request->addrid);
            $user_addr->update($data);
        }else{
            UserAddress::create($data);
        }
        return redirect(airoute( 'aimeos_shop_account', ['site'=>'default'] ))->withInput(['tab' => 'Products']);
    }

    public function DestroyAddress(Request $request)
    {
        $user_address = DB::table('users_address')->where('id', $request->id)->first();
        DB::table('users_address')->delete($user_address->id);
        return back();
    }

    public function AddAddress($id)
    {
        $params = ['page' => 'addaddress'];

        foreach(['account/addaddress'] as $name )
        {
            $params['aiheader'][$name] = Shop::get( $name )->header();
            $params['aibody'][$name] = Shop::get( $name )->body();
        }

        return Response::view( Shop::template( 'account.addaddress' ), $params )
            ->header( 'Cache-Control', 'no-store, max-age=0' );
    }

    public function EditAddress($id)
    {
        $params = ['page' => 'editaddress'];

        foreach(['account/editaddress'] as $name )
        {
            $params['aiheader'][$name] = Shop::get( $name )->header();
            $params['aibody'][$name] = Shop::get( $name )->body();
        }

        return Response::view( Shop::template( 'account.editaddress' ), $params )
            ->header( 'Cache-Control', 'no-store, max-age=0' );
    }
}
