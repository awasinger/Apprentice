@extends('layouts.master')

@section('content')
<section>
    <div class="panel panel">
        <div class="panel-heading">
            {{ $course->name }} Exam
        </div>
        <div class="panel-body">
            <form action="/courses/take" method="post">
                    @foreach ($keys as $key)
                        {{ csrf_field() }}
                        <input type="hidden" name="course" value="{{ $course->id }}">
                            {{ $course->questions[$key][0]}}
                            <hr>
                            <input type="hidden" name="key" value="{{ $key }}">
                            <div class="multiple-choice">
                                <div>
                                    <input type="radio" name="answer[{{$key}}]" value="0">
                                    <label>{{ $course->questions[$key][1][0] }}</label>
                                </div>
                                <div>
                                    <input type="radio" name="answer[{{$key}}]" value="1">
                                    <label>{{ $course->questions[$key][1][1] }}</label>
                                </div>
                                <div>
                                    <input type="radio" name="answer[{{$key}}]" value="2">
                                    <label>{{ $course->questions[$key][1][2] }}</label>
                                </div>
                                <div>
                                    <input type="radio" name="answer[{{$key}}]" value="3">
                                    <label>{{ $course->questions[$key][1][3] }}</label>
                                </div>
                            </div>
                    @endforeach
                    <div class="form-input">
                        <button class="btn btn-main" id="answer-question" type="submit">Submit Answers</button>
                    </div>
                </form>
        </div>
    </div>
</section>
@endsection