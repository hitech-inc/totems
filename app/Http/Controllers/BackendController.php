<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class BackendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }


    public function myLogin(Request $request)
    {
        $user = Auth::user();

        if ($user->hasRole('admin'))
        {
            return redirect('/');
        }
        
        return redirect('/');
    }

    public function myLogout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function roles(Request $request)
    {
        // $user = User::find(1);
        // $user->assignRole('admin');

        // return 'DONE';
    }
}