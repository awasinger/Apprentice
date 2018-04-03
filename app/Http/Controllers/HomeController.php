<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Notify;
use App\Mail\BusinessApplication;
use App\Mail\JobApplication;
use App\Mail\NotifyRelease;
use App\Course;
use App\User;
use Auth;

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
        $user = Auth::user();
        if ($user->business) {
            $courses = $user->coursesMade()->latest()->get();
        } else {
            $courses = $user->courses()->latest()->get();
        }
        return view('home', compact('courses'));
    }
    
    public function edit() {
        $user = Auth::user();
        return view('auth.edit', compact('user'));
    }
    
    public function update(Request $request) {
        $this->validate($request, [
            'email' => 'email|nullable|unique:users,email',
            'password' => 'confirmed|min:6|nullable',
        ]);
        $user = Auth::user();
        if ($request->email) {
            $user->email = $request->email;
        }
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        if (count($request->business) == 2) {
            DB::table('businessApplication')->insert([
                'name' => $request->business[0],
                'description' => $request->business[1],
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            Mail::to(Auth::user())->send(new BusinessApplication($request->business));
        }
        $user->save();
        $success = 'Account Updated';
        return back()->with('success');
    }
    
    public function apply(Request $request) {
        $user = Auth::user();
        $course = Course::findOrFail($request->course);
        
        Mail::to($course->business)->send(new JobApplication($request->apply, Auth::user()->name, $course->name, session('percent'), Auth::user()->email));
        $request->session()->flash('success', 'Your Application Was Sent! Good Luck!');
        return redirect('/');
    }
    
    public function destroy(Request $request) {
        DB::table('courseOwners')->where('user_id', Auth::id())->delete();
        DB::table('customers')->where('user_id', Auth::id())->delete();
        
        $user = User::findOrFail(Auth::id());
        if ($user->business) {
            DB::table('courses')->where('business_id', $user->business_id)->delete();
        }
        $user->delete();
        
        return redirect('/');
    }

    
    public function notify(Request $request) {
        
        $this->validate(request(), [
            'email' => 'required|unique:notifies'
        ]);
        
        Notify::create([
            'email' => $request['email']
        ]);
        
        Mail::to($request->email)->send(new NotifyRelease);
        
        return back()->with('success', 'Your email was submitted! You will receive a confirmation email with some more information.');
    }
}
