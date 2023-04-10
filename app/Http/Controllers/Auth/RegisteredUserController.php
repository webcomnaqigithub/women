<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Traits\SaveImageTrait;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    use SaveImageTrait;

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.user_register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $this->check($request);

        $user = $this->user($request);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::home());
    }


    /**
     * Returns the site ID the user should be associated to
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string Site ID
     */
    // protected function siteid(Request $request) : string
    // {
    //     $context = app( 'aimeos.context' )->get();
    //     $manager = \Aimeos\MShop::create( $context, 'locale/site' );

    //     $root = $manager->find( config( 'shop.mshop.locale.site', 'default' ) );
    //     $siteId = $root->getSiteId();

    //     if( config( 'app.shop_registration' ) )
    //     {
    //         $code = $request->code;
    //         $item = $manager->create()->setCode( $code )->setLabel( $code )->setStatus( 1 );
    //         $siteId = $manager->insert( $item, $root->getId() )->getSiteId();

    //         \Aimeos\Setup::use( new \Aimeos\Bootstrap() )->context( $context )->verbose( '' )->up( $code );
    //     }

    //     return $siteId;
    // }


    /**
     * Returns the newly created user
     *
     * @param  \Illuminate\Http\Request $request
     * @return \App\Models\User $user
     */
    protected function user(Request $request) : \App\Models\User
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'siteid' => '1.',  //$this->siteid($request),
            'phone' => $request->phone,
            'city' => $request->city,
            'address1' => $request->address1,
            'merchant' => false,
            'icon' => '/front/images/User-avatar.png',
        ]);

        // if( config( 'app.shop_registration' ) )
        // {
        //     $context = app( 'aimeos.context' )->get();
        //     $group = config( 'app.shop_permission', 'admin' );

        //     $context->setLocale( \Aimeos\MShop::create( $context, 'locale' )->bootstrap( $request->code ) );
        //     $groupId = \Aimeos\MShop::create( $context, 'customer/group' )->find( $group )->getId();

        //     $manager = \Aimeos\MShop::create( $context, 'customer/lists' );
        //     $item = $manager->create()
        //         ->setDomain( 'customer/group' )
        //         ->setParentId( $user->id )
        //         ->setType( 'default' )
        //         ->setRefId( $groupId );

        //     $manager->save( $item );
        // }

        return $user;
    }


    /**
     * Validates the values entered for the user
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function check(Request $request)
    {
        $rules = [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],  //'confirmed'
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'max:255', 'unique:users,phone'],
            'city' => ['required'],
            'address1' => ['required'],
        ];

        // if( config( 'app.shop_registration' ) ) {
        //     $rules['code'] = ['required', 'string', 'max:255', 'unique:mshop_locale_site', 'regex:/^[a-z0-9\-]+(\.[a-z0-9\-]+)?$/i'];
        // } else {
        //     $rules['name'] = ['required', 'string', 'max:255'];
        // }

        $request->validate($rules);
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['string', 'nullable'],
            'phone' => ['digits:10', 'nullable'],
            'address1' => ['string', 'nullable'],
            'icon' => [ 'image', 'mimes:jpg,png', 'max:2000'],
        ]);
        
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput(['tab' => 'users']);
        }

        $data = $request->except('_token');
        if($request->icon != null){
            $data['icon'] = $this->uploadImage($request->icon, 'icons');
        }
        $user = User::find($request->usid);
        $user->update($data);
        return redirect()->back()->withInput(['tab' => 'users']);
    }
}
