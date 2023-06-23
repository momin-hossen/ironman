<?php

namespace App\Http\Controllers;

use App\Mail\newsletter;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

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
    public function sendnewsletter()
    {
        foreach (User::all()->pluck('email') as $email) {
            Mail::to($email)->send(new Newsletter());
        }
        return back();
    }
}
