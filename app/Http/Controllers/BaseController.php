<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BaseController extends Controller
{

	// public function getUser()
	// {
	// 	$context = $this->context();
    //     $user = User::where('siteid', '1.3.')->first();
	// 	return $user;
	// }

	// public function getSite()
	// {
	// 	$context = $this->context();
    //     $site = \Aimeos\MShop::create( $context, 'locale/site' )->get($this->getUser()->id);
	// 	return $site;
	// }

	// public function setCustomContext($lang , $currency )
	// {
	// 	$site = $this->getSite()['locale.site.code'];
    //     // $lang = 'en';
    //     // $currency = 'usd';
    //     $localeManager = \Aimeos\MShop::create( $this->context(), 'locale' );
    //     $locale = $localeManager->bootstrap( $site, $lang, $currency, true );
	// 	return $this->context()->setLocale($locale);
	// }

	// public function setStoreLang( )
	// {
	// 	$site = $this->getSite()['locale.site.code'];
    //     $localeManager = \Aimeos\MShop::create( $this->context(), 'locale' );
	// 	$locale = $localeManager->bootstrap( $site, $lang, $currency, '' )->setLanguageId('de');
	// 	return $locale;
	// }

    public function context()
    {
        return app( 'aimeos.context' )->get();
    }

	public function paginate($listItems, $view)
    {
		$arr = [];
		$total = count( $listItems );

		$size = $this->getProductListSize( 15);
		$current = $this->getProductListPage( $view );
		$last = ( $total != 0 ? ceil( $total / $size ) : 1 );

		$view->favoriteItems = $listItems;
		$view->favoritePageFirst = 1;
		$view->favoritePagePrev = ( $current > 1 ? $current - 1 : 1 );
		$view->favoritePageNext = ( $current < $last ? $current + 1 : $last );
		$view->favoritePageLast = $last;
		$view->favoritePageCurr = $current;
        return  ;
    }

}
