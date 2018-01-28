<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notify;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyRelease;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('notify');
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
    
    public function notify(Request $request) {
        
        $this->validate(request(), [
            'email' => 'required|unique:notifies'
        ]);
        
        Notify::create([
            'email' => $request['email']
        ]);
        
        Mail::to($request['email'])->send(new NotifyRelease);
        
        return back()->with('success', 'Your email was submitted! You will receive a confirmation email to make sure that there were no typos.');
    }
}
