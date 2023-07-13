<?php

namespace App\Http\Controllers;

use App\Mail\newsletter;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('checkrole');
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
        $contacts = Contact::all();
        return view('home', compact('users', 'total_users', 'contacts'));
    }
    public function sendnewsletter()
    {
        foreach (User::all()->pluck('email') as $email) {
            Mail::to($email)->send(new Newsletter());
        }
        return back();
    }
    public function contactuploaddownload($contact_id)
    {
        return Storage::download(Contact::findOrFail($contact_id)->contact_attachement);
    }
}
