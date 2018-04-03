<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
     // Always edit middleware for new methods!
     
    public function __construct() {
        $this->middleware('business')->except(['index', 'show', 'search', 'buy', 'take', 'answer']);
        $this->middleware('auth')->except(['index', 'show', 'search']);
    }
    
    public function index()
    {
        $courses = Course::latest()->take(15)->inRandomOrder()->get();
        $courses = Course::displaySearch($courses);
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'questions' => 'required',
            'cost' => 'required|numeric',
        ]);
        
        $path = ($request->file('text-file') ? [$request->file('text-file')->storeAs(Auth::user()->business_id, $request->file('text-file')->getClientOriginalName(), 'public')] : null);
        
        $questions = json_encode($request->questions);
        
        Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'questions' => $questions,
            'business_id' => Auth::user()->business_id,
            'cost' => $request->cost * 100,
            'paths' => ($path ? json_encode($path) : ''),
        ]);
        
        $request->session()->flash('success', 'Course Created'); // Where to put on dashboard? - decide after redesign
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $id)
    {
        $isBiz = (Auth::check() ? Auth::user()->business : 0);
        if (!$isBiz) {
            $course = $id;
            $course->paths = (json_decode($course->paths, true) ? json_decode($course->paths, true) : []);
            $owned = (Auth::check() ? count(Auth::user()->courses()->where('course_id', $course->id)->get()) : 0);
            return view('courses.show', compact('course', 'owned'));
        } else {
            return back();
        }
    }
    
    public function search(Request $request) {
        $term = $request['course-search'];
        if ($term) {
            $courses = Course::where('name', 'like', "%$term%")->inRandomOrder()->get();
            $courses = Course::displaySearch($courses);
            return view('courses.index', compact('courses'));
        } else {
            return $this->index();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $id)
    {
        // Check if user owns course, if true format data for display
        if (Auth::user()->business_id == $id->business_id) {
            $course = $id;
            $course->questions = json_decode($course->questions, true);
            $course->paths = (json_decode($course->paths, true) ? json_decode($course->paths, true) : []);
            return view('courses.edit', compact('course'));
        } else {
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'questions' => 'required',
            'cost' => 'required|numeric',
        ]);
        $course = Course::findOrFail($request->id);
        if (Auth::user()->business_id == $course->business_id) {
            $course->paths = json_decode($course->paths, true);
            
            // Upload file
            $path = ($request->file('text-file') ? [$request->file('text-file')->storeAs(Auth::user()->business_id, $request->file('text-file')->getClientOriginalName(), 'public')] : []);
            
            // Turn questions array into json for storage
            $questions = json_encode($request->questions);

            $course->paths = ($course->paths ? array_merge($course->paths, $path) : $path);
            $course->paths = array_filter($course->paths);
            $course->paths = json_encode($course->paths);
            
            // Update DB
            $course->name = $request->name;
            $course->description = $request->description;
            $course->questions = $questions;
            $course->cost = $request->cost * 100;
            $course->save();
            
            $request->session()->flash('success', 'Course Updated');
            return back();
        } else {
            return back();
        }
    }
    
    public function buy(Request $request) {

        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        
        $course = Course::findOrFail($request->id);
        $course->buy($request->stripeToken);
        
        return back();
    }
    
    // Remove uploaded files
    public function remove(Request $request) {
        $course = Course::findOrFail($request->id);
        
        if (Auth::user()->business_id == $course->business_id) {
            $item = substr($request->item, 0, -2);
            $course->paths = json_decode($course->paths, true);
            $course->paths = array_values($course->paths);
            
            $course->paths = array_filter($course->paths, function ($v) use (&$item) {
                if (strpos($v, $item) !== false) {
                    $item = $v;
                    return false;
                }
                return true;
            });
            
            // Delete file from storage
            Storage::disk('public')->delete($item);
            
            // Save new paths - without deleted path
            $course->paths = json_encode($course->paths);
            $course->save();
            // Unset reference to $item
            unset($item);
            return 'File Removed';
        }
        return 'Failed';
    }
    
    public function take(Course $id) {
        $course = $id;
        
        if (count(Auth::user()->courses()->where('course_id', $course->id)->get())) {
            $course->questions = json_decode($course->questions, true);
            $keys = array_keys($course->questions);
            request()->session()->flash('correct', $keys); // set all answers to correct so no warnings show
            return view('courses.take', compact('course', 'keys', 'correct'));
        }
        return redirect('/courses/show/'.$course->id);
    }
    
    public function answer(Request $request) {
        
        $course = Course::findOrFail($request->course);
        
        $answers = (count($request->answer) ? array_values($request->answer) : []);
        $questions = json_decode($course->questions, true);
        $completed = json_decode(Auth::user()->completed, true);
        $correct = [];
        $wrong = [];
        
        while (count($answers) != count($questions)) {
            $answers[] = '';
        }
        
        // Add correct answers to array
        
        for ($i = 0; $i < count($questions); $i++) {
            if ($questions[$i][2] != $answers[$i]) {
                $wrong[] = $i;
            } else {
                $correct[] = $i;
            }
        }
        
        $request->session()->forget('key');
        $request->session()->flash('correct', $correct);
        
        $percent = floor(count($correct) / count($questions) * 100);
        if ($percent > 75) {
            $pass = 1;
            $completed[] = $course->id;
            Auth::user()->completed = json_encode($completed);
            Auth::user()->save();
        } else {
            $pass = 0;
            
        }
        $request->session()->flash('percent', $percent);
        return view('courses.score', compact('percent', 'pass', 'questions', 'wrong', 'course'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $course = Course::findOrFail($request->id);
        
        // Test if user owns course - delete if true
        if (Auth::user()->business_id == $course->business_id) {
            $course->paths = json_decode($course->paths, true);
            Storage::disk('public')->delete($course->paths);
            $course->delete();
            DB::table('courseOwners')->where('course_id', $course->id)->delete();
            $request->session()->flash('success', 'Course Deleted');
            return redirect('/');
        } else {
            return back();
        }
    }
}