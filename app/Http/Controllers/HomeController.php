<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Notify;

use App\Mail\BusinessApplication;
use App\Mail\JobApplication;
use App\Mail\NotifyRelease;
use App\Mail\BusinessApproved;

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
        $this->middleware('auth')->except('notify', 'businessApply', 'registerBusiness');
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
            
            Mail::to(config('mail.from.address'))->send(new BusinessApplication(Auth::user(), $request->business[0], $request->business[1]));
        }
        $user->save();
        $success = 'Account Updated';
        return back()->with('success');
    }
    
    public function apply(Request $request) {
        $user = Auth::user();
        $course = Course::findOrFail($request->course);
        
        Mail::to($course->business)->send(new JobApplication(Auth::user(), $request->apply, $course->name, session('percent')));
        $request->session()->flash('success', 'Your Application Was Sent! Good Luck!');
        return redirect('/');
    }
    
    public function destroy(Request $request) {
        $user = Auth::user();

        DB::table('courseOwners')->where('user_id', $user->id)->delete();
        DB::table('customers')->where('user_id', $user->id)->delete();
        
        if ($user->business) {
            DB::table('courses')->where('business_id', $user->business_id)->delete();
            Storage::deleteDirectory('public/'.$user->business_id);
        }
        $user->delete();
        
        return redirect('/');
    }
    
    public function registerBusiness() {
        return view('auth.registerBusiness');
    }
    
    public function businessApply(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
        $max = (DB::table('users')->max('business_id') >= 0 ? DB::table('users')->max('business_id') : -1);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->business = 1;
        $user->business_id = ($max + 1);
        $user->save();
        
        $token = md5($user->email);
        
        DB::table('businessApplication')->insert([
            'business_id' => $user->business_id,
            'token' => $token,
        ]);
        
        Auth::login($user);
        Mail::to(config('mail.from.address'))->send(new BusinessApplication(Auth::user(), $request->desc, $token));
        return redirect()->home();
    }
    
    public function activateBusiness($token) {
        $record = DB::table('businessApplication')->where('token', $token)->first();
        $business = User::where('business_id', $record->business_id)->first();
        
        $business->business_active = 1;
        $business->save();
        
        Mail::to($business)->send(new BusinessApproved($business));
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
