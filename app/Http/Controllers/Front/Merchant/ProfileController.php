<?php

namespace App\Http\Controllers\Front\Merchant;

use Aimeos\MShop;
use App\Http\Controllers\BaseController;
use App\Http\Requests\AddressRequest;
use App\Models\User;
use App\Traits\SaveImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ProfileController extends BaseController
{
    use SaveImageTrait;

    public function favorite($id)
    {
		$domains = ['text', 'price', 'media', 'catalog'] ;
		$domains['product'] = ['favorite'];

		$cntl = \Aimeos\Controller\Frontend::create( $this->context(), 'customer' );
		$favoriteItems = $cntl->uses( $domains )->get()->getListItems( 'product', 'favorite' );
        // dd($favoriteItems->first()->getRefItem());
		// $total = count( $listItems );
		// $size = $this->getProductListSize( 10 );
		// $current = $this->getProductListPage( 1 );
		// $last = ( $total != 0 ? ceil( $total / $size ) : 1 );
		// $favoritePageFirst = 1;
		// $favoritePagePrev = ( $current > 1 ? $current - 1 : 1 );
		// $favoritePageNext = ( $current < $last ? $current + 1 : $last );
		// $favoritePageLast = $last;
		// $favoritePageCurr = $current;

		$favoriteStores = DB::table('users_list')->where('parentid' ,auth()->user()->id)->where('domain', 'store')->pluck('siteid')->map(function($item){
			return current( array_reverse( explode( '.', trim( $item, '.' ) ) ) );
		});
        $manager = \Aimeos\MShop::create( app( 'aimeos.context' )->get(), 'locale/site');
        $filter= $manager->filter( true );
		$search = $filter->setSortations( [$filter->sort( '-', 'locale.site.id' )] );
		$filter->setConditions( $search->compare( '==', 'locale.site.id', $favoriteStores) );
		$stores = $manager->search( $search  ) ;

        return view('front.profile.favorite', compact('favoriteItems', 'stores' ));
    }

	public function UpdateProfileBackground(Request $request){
		$request->validate([
			'profile_pic' => ['required', 'mimes:jpeg,png,jpg', 'max:4000']
		]);

		$profile_pic = $this->uploadImage($request->profile_pic, 'background_profiles');
		$user = User::find(auth()->user()->id);
		$user->update([
			'profile_pic' => $profile_pic
		]);
		return redirect()->back();
	}

	public function StoreFavorite(Request $request)
	{
		$request->validate([
            'siteid' => 'required|exists:users,siteid',
        ]);

		$user = User::where('siteid', $request->siteid)->first();
		$check_site_fav = DB::table('users_list')->where('parentid', auth()->user()->id)->where('refid', $user->id)->first();
        if($check_site_fav){
            return response()->json(['status'=>'fail']);
        }
        DB::table('users_list')->insert([
            'siteid' => $request->siteid,
			'parentid' => auth()->user()->id,
			'key' => 'store|favorite' . $user->id,
			'type' => 'favorite',
			'domain' => 'store',
			'refid' => $user->id,
			'config' => '[]',
			'pos' => 0,
			'status' => 1,
            'mtime' => Carbon::now(),
            'ctime' => Carbon::now(),
            'editor' => auth()->user()->email,
        ]);

        return response()->json(['status'=>'success']);
	}
}
