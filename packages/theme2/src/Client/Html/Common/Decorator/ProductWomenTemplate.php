<?php

namespace Aimeos\Client\Html\Common\Decorator;

class ProductWomenTemplate 
extends \Aimeos\Client\Html\Common\Decorator\Base
implements \Aimeos\Client\Html\Common\Decorator\Iface
{
    public function data( \Aimeos\Base\View\Iface $view, array &$tags = [], string &$expire = null ) : \Aimeos\Base\View\Iface
	{
        $view->descripto= 'some description';
        return  $view;	
    }



}