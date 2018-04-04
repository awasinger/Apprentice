@extends('layouts.master')

@section('content')
<section>
    <div class="panel panel-wide">
        <div class="panel-heading">
            Create a course
        </div>
        @if (Auth::user()->business_active)
        <div class="panel-body">
            <form method="post" action="/courses/create" id="course-create" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-input{{ $errors->has('name') ? ' has-error' : ''}}">
                    <label for="name">Title</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-input{{ $errors->has('description') ? ' has-error' : ''}}">
                    <label for="description">Description</label>
                    <textarea name="description" required>{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-input{{ $errors->has('cost') ? ' has-error' : ''}}">
                    <label for="cost">Cost (in dollars)</label>
                    <input type="text" name="cost" value="{{ old('cost') }}" required>
                    @if ($errors->has('cost'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cost') }}</strong>
                        </span>
                    @endif
                </div>
                <label class="btn btn-main form-label-sm file-select-label">
                    <input type="file" name="text-file" id="file-select">
                    Upload file
                </label><span id="text-file-name"></span>
                <div class="form-input" id="question-container">
                    <label>Questions</label>
                    <div class="form-input-half" id="question-single">
                        <input type="text" name="questions[0][0]" id="question" placeholder="Question 1">
                        <div class="answer-indent">
                            &mdash;<input type="text" id="a1" name="questions[0][1][0]" placeholder="Answer 1" value="{{ old("questions[0][]") }}" required>
                            <input type="radio" name="questions[0][2]" value="0" required><label>Mark as Correct Answer</label>
                        </div>
                        <div class="answer-indent">
                            &mdash;<input type="text" id="a2" name="questions[0][1][1]" placeholder="Answer 2" value="{{ old("questions[0][]") }}" required>
                            <input type="radio" name="questions[0][2]" value="1" required><label>Mark as Correct Answer</label>
                        </div>
                        <div class="answer-indent">
                            &mdash;<input type="text" id="a3" name="questions[0][1][2]" placeholder="Answer 3" value="{{ old("questions[0][]") }}" required>
                            <input type="radio" name="questions[0][2]" value="2" required><label>Mark as Correct Answer</label>
                        </div>
                        <div class="answer-indent">
                            &mdash;<input type="text" id="a4" name="questions[0][1][3]" placeholder="Answer 4" value="{{ old("questions[0][]") }}" required>
                            <input type="radio" name="questions[0][2]" value="3" required><label>Mark as Correct Answer</label>
                        </div>
                    </div>
                </div>
                <div class="form-input">
                    <button class="btn btn-main btn-right" id="add-question" type="button">Add Question</button>
                    <button type="submit" class="btn btn-main">Create Course</button>
                </div>
            </form>
        </div>
        @else
        <div class="panel-body">
            You will be able to create courses when we verify your business!
        </div>
        @endif
    </div>
</section>
<script>var qTotal = 1;</script>
@endsection