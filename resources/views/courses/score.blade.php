@extends('layouts.master')
@section('content')
<section>
    <div class="panel panel-wide">
        <div class="panel-heading">
            Your Score
        </div>
        <div class="panel-body">
            <p>You got a {{session('percent')}}%!</p>
            @if ($pass)
                <p>You passed!</p>
                @if (!in_array($course->id, json_decode(Auth::user()->completed, true))) 
                    <form method="post" action="/apply">
                        {{ csrf_field() }}
                        <input type="hidden" name="course" value="{{$course->id}}">
                        <div class="panel-heading">
                            Apply For An Intership
                        </div>
                        <div class="form-input">
                            <textarea name="apply" placeholder="Write A Short Description About Why You Are The Best For The Job!"></textarea>
                        </div>
                        <div class="form-input">
                            <button type="submit" class="btn btn-main btn-top-sm">Apply</button>
                        </div>
                    </form>
                @endif
            @else
                <p>Better luck next time!</p>
            @endif
            <div class="panel-heading">
                Incorrect Questions
            </div>

                <ul class="panel-list">
                    @foreach ($wrong as $q)
                        <li>{{ $questions[$q][0] }}</li>
                    @endforeach
                </ul>

            @if (!$pass)
                <a href="/courses/take/{{$course->id}}" class="btn-link">Try Again</a>
            @endif
        </div>
    </div>
</section>
@endsection