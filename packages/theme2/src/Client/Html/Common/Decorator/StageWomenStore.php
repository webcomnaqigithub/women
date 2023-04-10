<?php

namespace Aimeos\Client\Html\Common\Decorator;

use App\Models\User;

class StageWomenStore 
        extends \Aimeos\Client\Html\Common\Decorator\Base
        implements \Aimeos\Client\Html\Common\Decorator\Iface
{
    public function data( \Aimeos\Base\View\Iface $view, array &$tags = [], string &$expire = null ) : \Aimeos\Base\View\Iface
	{
        $siteid = app('aimeos.context')->get()->locale()->getSiteItem()->getSiteId();
        $user = User::where('siteid', $siteid)->first();
        $view->user = $user;

        return parent::data( $view, $tags, $expire );	
    }
}