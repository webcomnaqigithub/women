<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Traits\SaveImageTrait;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class RegisteredMerchantController extends Controller
{
    use SaveImageTrait;

    private $code;
    private $icon;
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.mrchnt_register');
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
    protected function siteid(Request $request) : string
    {
        $context = app( 'aimeos.context' )->get();
        $manager = \Aimeos\MShop::create( $context, 'locale/site' );

        $root = $manager->find( config( 'shop.mshop.locale.site', 'default' ) );
        $siteId = $root->getSiteId();

        $this->code = rand(100000,999999);
        $label = $request->label;
        $item = $manager->create()->setCode( $this->code )->setLabel( $label )->setStatus( 1 )->setIcon($this->icon = $this->uploadImage($request->icon, 'icons'))->setTheme('theme2');
        $siteId = $manager->insert( $item, $root->getId() )->getSiteId();
        \Aimeos\Setup::use( new \Aimeos\Bootstrap() )->context( $context )->verbose( '' )->up( $this->code );

        return $siteId;
    }


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
            'siteid' => $this->siteid($request),
            'phone' => $request->phone,
            'address1' => $request->address1,
            'city' => $request->city,
            'summary' => $request->summary,
            'store_label' => $request->label,
            'icon' => $this->icon,
            'merchant' => true,
            'langid' => app()->getLocale(),
        ]);

        $context = app( 'aimeos.context' )->get();
        $group = config( 'app.shop_permission', 'admin' );

        $context->setLocale( \Aimeos\MShop::create( $context, 'locale' )->bootstrap( $this->code ) );
        $groupId = \Aimeos\MShop::create( $context, 'customer/group' )->find( $group )->getId();

        $manager = \Aimeos\MShop::create( $context, 'customer/lists' );
        $item = $manager->create()
            ->setDomain( 'customer/group' )
            ->setParentId( $user->id )
            ->setType( 'default' )
            ->setRefId( $groupId );

        $manager->save( $item );

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
            'password' => ['required', Rules\Password::defaults()], //'confirmed'
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'digits:10'],
            'address1' => ['required'],
            'city' => ['required'],
            'summary' => ['required'],
            'icon' => ['required'],
            'privacy' => ['accepted'],
            'label' => ['required', 'string', 'max:255', 'unique:mshop_locale_site'],
            // 'code' => ['required', 'string', 'max:255', 'unique:mshop_locale_site', 'regex:/^[a-z0-9\-]+(\.[a-z0-9\-]+)?$/i']
        ];
        // $rules['label'] = ['required', 'string', 'max:255', 'unique:mshop_locale_site']; //'regex:/^[a-z0-9\-]+(\.[a-z0-9\-]+)?$/i'
        // $rules['name'] = ['required', 'string', 'max:255'];

        $request->validate($rules);
    }

    public function updateProfile(Request $request)
    {  
        $validator = Validator::make($request->all(),[
            'name' => ['string', 'required'],
            'phone' => ['digits:10', 'required'],
            'address1' => ['string', 'required'],
            'store_label' => ['string', 'required'],
            'summary' => ['string', 'required'],
            'icon' => [ 'image', 'mimes:jpg,png', 'max:2000'],
            'summary_pics.*' => [ 'required', 'image', 'mimes:jpg,png', 'max:5000' ],
        ]);
        
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput(['tab' => 'users']);
        }
        $data = $request->except('_token');
        
        $user = User::find(auth()->user()->id);

        if($request->hasFile('icon')){
            $data['icon'] = $this->uploadImage($request->icon, 'icons');
            DB::table('mshop_locale_site')->where('siteid', $user->siteid)->update(['icon'=>$data['icon']]);
        }
        
        if($request->hasFile('summary_pics'))
        {
            $names = [];
            foreach($request->file('summary_pics') as $image)
            {
                $image_path = $this->uploadImage($image, 'summary_pics');
                array_push($names, $image_path);          
            }
            $data['summary_pics'] = json_encode($names);
        }
        $user->update($data);
        
        return redirect()->back()->withInput(['tab' => 'users']);
    }
}
