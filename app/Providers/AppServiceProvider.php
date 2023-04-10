<?php

namespace App\Providers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Password::defaults(function () {
            $rule = Password::min( 8 );
            return $this->app->isProduction() ? $rule->mixedCase()->uncompromised() : $rule;
        });

 

        // for multi-locale setups
        \Illuminate\Auth\Notifications\VerifyEmail::$createUrlCallback = function($notifiable) {
            $time = Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60));
            $params = [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ];

            // if( env( 'SHOP_MULTILOCALE' ) ) {
                $params['locale'] = Request::route( 'locale', Request::input( 'locale', app()->getLocale() ) );
            // }

            return URL::temporarySignedRoute('verification.verify', $time, $params);
        };

        View::composer('*', function ( $view ) {
            $view->with( 'aimeossite', app( 'aimeos.context' )->get()->locale()->getSiteItem() );
            $view->with( 'userSite',  User::find(app( 'aimeos.context' )->get()->user()));
            // $view->with( 'site',  null);

            if(auth()->check() && auth()->user()->superuser != 1){
                $user = auth()->user();
                $site = \Aimeos\MShop::create( app( 'aimeos.context' )->get(), 'locale/site' )->get(current( array_reverse( explode( '.', trim( $user->siteid, '.' ) ) ) ));
                $view->with( 'site',  $site);
            }

            $sub_categories = \Aimeos\MShop::create(app( 'aimeos.context' )->get(), 'catalog' )
                                ->getTree(1, ['media', 'text'])->getChildren()
                                ->filter(function( $item ) {
                                    return $item->getStatus() == 1  ;
                                }); 
            $view->with( 'sub_categories', $sub_categories);

        });
        
        View::composer('*', function ( $view ) {
            $map = [];
            $context = app( 'aimeos.context' )->get();
            $config = $context->config();
            $locale = $context->locale();
            $selectLanguageId = $locale->getLanguageId();
            $selectCurrencyId = $locale->getCurrencyId();
            $view->with( 'selectLanguageId', $selectLanguageId);
            $view->with( 'selectCurrencyId', $selectCurrencyId);

		    $basket = \Aimeos\Controller\Frontend::create( $context, 'basket' )->get();
            $view->with( 'basket', $basket);
        });

        View::composer('*', function ( $view ) { 
            $Notifications = 0;
            if (Auth::check()){ 
                if(Request::segment( 1 ) == 'ar' || Request::segment( 1 ) == 'en'){
                    Auth::user()->update(['langid' => Request::segment( 1 )]);
                }
                if(auth()->user()->merchant == 0){
                    $Notifications = Notification::where('receiver_id', auth()->user()->id)->get()->count();
                }else{
                    $Notifications = Notification::where('sender_id', auth()->user()->siteid)->get()->count();
                }
                $view->with( 'notifications', $Notifications);
            }
        });

        //get favorite item number
        View::composer('*', function ( $view ) { 
            // $domains = app( 'aimeos.context' )->get()->config()->get( 'client/html/account/favorite/domains', ['text', 'price', 'media'] );
            // $domains['product'] = ['favorite'];
            // $cntl = \Aimeos\Controller\Frontend::create( app( 'aimeos.context' )->get(), 'customer' );
            // $listItems = $cntl->uses( $domains )->get()->getListItems( 'product', 'favorite' );
            // $view->with( 'fav_number', $listItems);
            $fav_number = 0;
            if (Auth::check()){ 
                $fav_number = DB::table('users_list')->where('parentid', auth()->user()->id)->where('type', 'favorite')->where('domain', 'product')->get();
            }
            $view->with( 'fav_number', $fav_number);


        });
    }
}
