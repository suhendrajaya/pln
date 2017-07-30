<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Theme;
use Request;

class AuthController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Registration & Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. By default, this controller uses
      | a simple trait to add these behaviors. Why don't you explore it?
      |
     */

use AuthenticatesAndRegistersUsers,
    ThrottlesLogins;
    protected $redirectPath = '/tasks';
    protected $loginPath = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
        $this->theme = Theme::uses('default')->layout('login');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
        ]);
    }

    public function getRegister()
    {
        return $this->theme->scope('home.register')->render();
    }

    public function doLogin(Request $req)
    {
        $rules = array(
            'username' => 'required',
            'password' => 'required'
        );
        $userdata = [
            'username' => $req->input('username'),
            'password' => $req->input('password'),
            'using' => 'username',
            'remember' => 1
        ];

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {
            $url = route('homepage');
            return Redirect::to($url)
                    ->withErrors($validator)
                    ->withInput(Input::except('password'));
        }
        else
        {
            if (Auth::attempt($userdata))
            {
                return Redirect::to(route('home-page'));
            }
            else
            {
                $validator->getMessageBag()->add('username', trans('web.invalidLogin'));
                $url = route('homepage');
                return Redirect::to($url)
                        ->withErrors($validator)
                        ->withInput(Input::except('password'));
            }
        }
    }

}
