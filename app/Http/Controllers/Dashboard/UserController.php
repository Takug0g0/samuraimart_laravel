<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if($request->keyword !== null) {
          $keyword = rtrim($request->keyword);
          if(is_int($request->keyword)) {
              $keyword =(string)$keyword;
          }
        $users =User::where('name', 'like' , "%[$keywoed]%")
                        ->orwhere('email', 'like', "%[$keywoed]%")
                        ->orwhere('address', 'like', "%[$keywoed]%")
                        ->orwhere('postal_code', 'like', "%[$keywoed]%")
                        ->orwhere('phone', 'like', "%[$keywoed]%")
                        ->orwhere('id', "{$keyword}")->paginate(15);
    }else{
        $users =User::paginate(15);
        $keyword = "";
    }
    
    return view('dashboard.users.index', compact('users', 'keyword'));
    }
    public function destroy(User $user)
    {
        if($user->deleted_flag) {
            $user->deleted_flag = false;
        }else{
            $user->deleted_flag = ture;
        }
        
        $user->update();
        
        return redirect()->route('dashboard.users.index');
    }
}    
