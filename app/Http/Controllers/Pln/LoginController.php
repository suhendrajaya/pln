<?php

namespace App\Http\Controllers\Pln;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Input;
use Theme;
use Auth;
use Session;

class LoginController extends Controller
{
   public function __construct()
   {
      $this->theme = Theme::uses('default')->layout('login');
   }

   public function login()
   {
      $data = [];
      
      return $this->theme->scope('home.login', $data)->render();
   }

   public function doLogin()
   {
      $rules = array(
        'username' => 'required',
        'password' => 'required'
      );

      $userdata = [
        'username' => Input::get('username'),
        'password' => Input::get('password')
      ];

      $validator = Validator::make(Input::all(), $rules);
      if ($validator->fails())
      {
         $url = route('home-page');
         return Redirect::to($url)
             ->withErrors($validator)
             ->withInput(Input::except('password'));
      }
      else
      {
         if (Auth::attempt($userdata,true))
         {
            return Redirect::to(route('rkau_page'));
         }
         else
         {
            $validator->getMessageBag()->add('username', trans('web.invalidLogin'));
            $url = route('home-page');
            return Redirect::to($url)
                ->withErrors($validator)
                ->withInput(Input::except('password'));
         }
      }
   }

   public function logout()
   {
      if(Session::has('user')){

			Session::forget('user');
			Auth::logout();
		}
      return redirect(route('login-page'));
   }

}
