<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
  public function index()
    {
      return view('admin.dashboard');
    }


    public function login()
   {
   if (auth()->user() && auth()->user()->is_admin == 1) {

      //return redirect()->route('admin.dashboard');
    }
    else{
      return view('login');
    }
  }

  public function login_check(Request $request)
  {

      $input = $request->all();
      //dd($input);
      $this->validate($request, [
          'email' => 'required|email',
          'password' => 'required',
      ]);

      if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
      {
        //dd(auth()->user());

          if (auth()->user()->is_admin == 1) {
              return redirect()->route('bills.index')->withSuccess('Welcome'. auth()->user()->is_admin);
          }else{
            return redirect()->route('admin.login')->withErrors(['error' => 'Sorry !! You Dont have admin Privilage']);
          }
      }else{
          return redirect()->route('admin.login')
              ->withErrors(['error' =>'Email-Address And Password Are Wrong.']);
      }

  }
}
