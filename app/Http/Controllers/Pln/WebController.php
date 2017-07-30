<?php

namespace App\Http\Controllers\Pln;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Theme;

class WebController extends Controller
{
   private $theme;

   public function __construct()
   {
      setlocale(LC_MONETARY, 'id_ID');
      setlocale(LC_TIME, 'id_ID');
//      $this->middleware('auth', ['only' => ['home']]);
   }
   
   

   public function home()
   {
      $data = [];
      
      
       $roleArray = json_decode(json_encode(Auth::user()->roles), true);
      dd(Auth::user()->isReviewer);
      $this->theme = Theme::uses('default')->layout('home');

      return $this->theme->scopeWithLayout('homepage', $data)->render();
   }

   public function login()
   {
      if (Auth::check())
      {
         return Redirect::to(route('home-page'));
      }

      $data = [];

      $this->theme = Theme::uses('default')->layout('login');

      return $this->theme->scope('home.login', $data)->render();
   }

}
