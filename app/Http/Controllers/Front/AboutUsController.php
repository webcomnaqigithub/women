<?php

namespace App\Http\Controllers\Front;

use Aimeos\Shop\Facades\Shop;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AboutUsController extends Controller
{
    public function index()
	{
		$params = ['page' => 'page-index'];

		foreach( ['cms/page'] as $name )
		{
			$params['aiheader'][$name] = Shop::get( $name )->header();
			$params['aibody'][$name] = Shop::get( $name )->body();
		}

		return Response::view( Shop::template( 'page.aboutUs' ), $params )
			->header( 'Cache-Control', 'private, max-age=10' );
	}
}
