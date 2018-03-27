@extends('layouts.master')
@section('content')
<section>
    <div class="panel panel-wide">
        <div class="panel-heading">
            Edit your course
        </div>
        <div class="panel-body">
            <div class="form-success">
                {{ session('success') }}
            </div>
            <form method="post" action="/courses/edit" id="course-create" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id" value="{{ $course->id }}">
                <div class="form-input{{ $errors->has('name') ? ' has-error' : ''}}">
                    <label for="name">Title</label>
                    <input type="text" name="name" value="{{ $course->name }}" required>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-input{{ $errors->has('description') ? ' has-error' : ''}}">
                    <label for="description">Description</label>
                    <textarea name="description" required>{{ $course->description }}</textarea>
                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-input">
                    <label for="cost">Cost (in dollars)</label>
                    <input type="text" name="cost" value="{{ $course->cost / 100 }}" required>
                    @if ($errors->has('cost'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cost') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-input">
                    <label>Uploaded files</label>
                    @foreach ($course->paths as $path)
                        <p><span>{{ ($path ? explode('.', substr($path, 2))[0]. ' - ' : '') }}</span>
                        @if ($path)
                            <a class="btn-link link-warning file-remove">Remove File</a>
                        @endif
                    </p>
                    @endforeach
                </div>
                <div>
                    <label class="btn btn-main form-label-sm file-select-label">
                        <input type="file" name="text-file" id="file-select">
                        Upload new file
                    </label><span id="text-file-name"></span>
                </div>
                <div class="form-input" id="question-container">
                    <label>Questions</label>
                    @foreach (array_keys($course->questions) as $key)
                        <div class="form-input-half" id="question-single">
                            <input type="text" name="questions[{{$key}}][0]" id="question" placeholder="Question 1" value="{{$course->questions[$key][0]}}">
                            <div class="answer-indent">
                                &mdash;<input type="text" id="a1" name="questions[{{$key}}][1][0]" placeholder="Answer 1" value="{{ $course->questions[$key][1][0] }}">
                                <input type="radio" name="questions[{{$key}}][2]" value="0" {{ ($course->questions[$key][2] == '0') ? 'checked' : ''}}>
                                <label>Mark as Correct Answer</label>
                            </div>
                            <div class="answer-indent">
                                &mdash;<input type="text" id="a2" name="questions[{{$key}}][1][1]" placeholder="Answer 2" value="{{ $course->questions[$key][1][1] }}">
                                <input type="radio" name="questions[{{$key}}][2]" value="1" {{ ($course->questions[$key][2] == '1') ? 'checked' : ''}}>
                                <label>Mark as Correct Answer</label>
                            </div>
                            <div class="answer-indent">
                                &mdash;<input type="text" id="a3" name="questions[{{$key}}][1][2]" placeholder="Answer 3" value="{{ $course->questions[$key][1][2] }}">
                                <input type="radio" name="questions[{{$key}}][2]" value="2" {{ ($course->questions[$key][2] == '2') ? 'checked' : ''}}>
                                <label>Mark as Correct Answer</label>
                            </div>
                            <div class="answer-indent">
                                &mdash;<input type="text" id="a4" name="questions[{{$key}}][1][3]" placeholder="Answer 4" value="{{ $course->questions[$key][1][3] }}">
                                <input type="radio" name="questions[{{$key}}][2]" value="3" {{ ($course->questions[$key][2] == '3') ? 'checked' : ''}}>
                                <label>Mark as Correct Answer</label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="form-input">
                    <button class="btn btn-main btn-right" id="add-question" type="button">Add Question</button>
                    <button type="submit" class="btn btn-main">Update Course</button>
                </div>
            </form>
            <form method="post" action="/courses/delete">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $course->id }}">
                <button class="btn btn-main btn-warning">Delete Course</button>
            </form>
        </div>
    </div>
</section>
<script>var qTotal = {{count($course->questions)}}; </script>
@endsection