<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use App\Model\CategoryGroup;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
        // protected $redirectTo = '/home';
        protected function authenticated(Request $request, $user)
        {
            if($request->query('cart')){
                return redirect()->route('carts');
            }
            if($user->level==1){
                return redirect('/admin/wellcome');
            }
        
            // return redirect('/admin/wellcome');
            return redirect('/');
        }
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        // $categoryGroup = CategoryGroup::with(['category' => function($cg) {
        //     $cg->where('active', '=', 1)->with(['categoryType' => function($c){
        //         $c->where('active', '=', 1);
        //     }]);
        // }])->where('active',1)->get();
        // $data['listMenu'] = $categoryGroup;
        $data['listMenu'] = '';
        return view('auth.login',  $data);
    }
}
