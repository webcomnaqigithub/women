<?php

namespace App\Http\Controllers\Front;

use Aimeos\Shop\Facades\Shop;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\ContactUsRequest;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

class ContactUsController extends Controller
{
	public function index()
	{
		$params = ['page' => 'contactus'];

		foreach( ['contactus'] as $name )
		{
			$params['aiheader'][$name] = Shop::get( $name )->header();
			$params['aibody'][$name] = Shop::get( $name )->body();
		}

		return Response::view( Shop::template( 'page.contactus' ), $params )
			->header( 'Cache-Control', 'no-store, max-age=0' );
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactUsRequest $request)
    {
        ContactUs::create($request->validated());
        return back()->with([
            'msg_status' => 'success',
            'msg_title' => 'تم إرسال رسالتك بنجاح',
            'msg_content' => 'سيتم الرد عليك بأقرب وقت ممكن شكراً لك.',
        ]);
    }
    
    protected function createAdmin() : \Aimeos\Admin\JQAdm\Iface
	{
		$site = Route::input( 'site', FacadesRequest::get( 'site', config( 'shop.mshop.locale.site', 'default' ) ) );
		$lang =  FacadesRequest::get( 'locale', config( 'app.locale', 'en' ) );
		$resource = 'product';

		$aimeos = app( 'aimeos' )->get();
		$paths = $aimeos->getTemplatePaths( 'admin/jqadm/templates' );

		$context = app( 'aimeos.context' )->get( false, 'backend' );
		$context->setI18n( app( 'aimeos.i18n' )->get( array( $lang, 'en' ) ) );
		$context->setLocale( app( 'aimeos.locale' )->getBackend( $context, $site ) );

		$view = app( 'aimeos.view' )->create( $context, $paths, $lang );

		$view->aimeosType = 'Laravel';
		$view->aimeosVersion = app( 'aimeos' )->getVersion();
		$view->aimeosExtensions = implode( ',', $aimeos->getExtensions() );

		$context->setView( $view );

		return \Aimeos\Admin\JQAdm::create( $context, $aimeos, $resource );
	}
}
