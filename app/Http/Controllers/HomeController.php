<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
        // $users = User::all();
        // $users = User::orderBy('id', 'desc')->get();
        $users = User::latest()->paginate(3);
        $total_users = User::count();
        return view('home', compact('users', 'total_users'));
    }
}
