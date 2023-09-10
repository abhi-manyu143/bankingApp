<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Accounts;


class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::user()->id;
        $account_balance = Accounts::select('balance')->where('user_id', $id)->first();
        if($account_balance)
        {
            $amount = $account_balance->balance;
        }else
        {
            $amount = null;
        }
        return view('home',compact('amount'));
    }
}
