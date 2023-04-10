<?php

namespace Aimeos\Client\Html\Common\Decorator;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ViewErrorBag;

class ConfirmCheckout 
        extends \Aimeos\Client\Html\Common\Decorator\Base
        implements \Aimeos\Client\Html\Common\Decorator\Iface
{
    public function data( \Aimeos\Base\View\Iface $view, array &$tags = [], string &$expire = null ) : \Aimeos\Base\View\Iface
	{
  
		$view->errors = session()->get('errors', app(ViewErrorBag::class));
        $user = User::find(app( 'aimeos.context' )->get()->user());
        $view->store = DB::table('mshop_locale_site')->where('siteid', $user->siteid)->first();
		return parent::data( $view, $tags, $expire );	
    }
}