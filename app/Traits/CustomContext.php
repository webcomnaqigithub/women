<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait CustomContext
{
	//returns the authorized sign in user
	public function contextAuth()
    {
		if(auth()->check()){
			$user = auth()->user();
			$site = \Aimeos\MShop::create( app( 'aimeos.context' )->get(false), 'locale/site' )
						->get(current( array_reverse( explode( '.', trim( $user->siteid, '.' ) ) ) ));
			$code = $site->code;
			$context = app( 'aimeos.context' )->get();
			$localeManager = \Aimeos\MShop::create( $context, 'locale' );
			$locale = $localeManager->bootstrap( $code, '', '', '' );
			return $context->setLocale($locale);
		}
    }
}
