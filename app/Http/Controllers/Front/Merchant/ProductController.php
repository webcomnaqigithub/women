<?php

namespace App\Http\Controllers\Front\Merchant;

use Aimeos\Shop\Controller\JqadmController;
use Aimeos\Shop\Facades\Shop;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Mrchnt\StoreProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

class ProductController extends BaseController
{
    public function store(StoreProductRequest $request)
    { 
        if( config( 'shop.authorize', true ) ) {
			$this->authorize( 'admin', [JqadmController::class, config( 'shop.roles', ['admin', 'editor'] )] );
		}
		$cntl = $this->createAdmin();
		$cntl->save();
        return redirect()->to(airoute('aimeos_shop_account', ['locale'=>'ar']));
    }

    public function edit($id)
    {
        $params = ['page' => 'editproduct'];

        foreach( app( 'config' )->get( 'shop.page.edit-product' ) as $name )
        {
            $params['aiheader'][$name] = Shop::get( $name )->header();
            $params['aibody'][$name] = Shop::get( $name )->body();
        }

        return Response::view( Shop::template( 'account.edit' ), $params )
            ->header( 'Cache-Control', 'no-store, max-age=0' );
    }

    public function destroy($id)
    {
        if( config( 'shop.authorize', true ) ) {
			$this->authorize( 'admin', [JqadmController::class, config( 'shop.roles', ['admin', 'editor'] )] );
		}
		$cntl = $this->createAdmin();
        $cntl->delete();
        return response()->json('success');
    }

    protected function createAdmin() : \Aimeos\Admin\JQAdm\Iface
	{
		$site = Route::input( 'site', FacadesRequest::get( 'site', config( 'shop.mshop.locale.site', 'default' ) ) );
		$lang = FacadesRequest::get( 'locale', config( 'app.locale', 'en' ) );
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

    public function getSubCategory(Request $request, $id)
    { 
		// $sub_categories = \Aimeos\MShop::create( app( 'aimeos.context' )->get(), 'catalog' )->getTree()->getChildren() ;
        $sub_categories = DB::table('mshop_catalog')->where('parentid', $request->id)->get();
        if(count($sub_categories) > 0){
            if(app()->getLocale() == 'ar'){
                foreach($sub_categories as $key => $value){
                    $sub[$key] = ['id' => $value->id, 'label' => $value->label, 'code' => $value->code];
                }
            }else{
                foreach($sub_categories as $key => $value){
                    $sub[$key] = ['id' => $value->id, 'label' => $value->code, 'code' => $value->code];
                }
            }
            
            return response()->json(['sub_categories' => $sub]);
        }else{
            return response()->json(['sub_categories' => null]);
        }
    }
}
