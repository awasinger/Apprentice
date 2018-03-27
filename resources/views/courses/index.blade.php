@extends('layouts.master')
    
@section('content')

<section>
    <div class="course-search">
        <form method="get" action="{{ route('courseSearch') }}">
            {{ csrf_field() }}
            <div class="form-input">
                <label class="form-label-horizontal" for="course-search"></label>
                <div class="form-search-horizontal">
                    <input type="text" name="course-search" placeholder="Search a topic">
                    <button type="submit" class="btn btn-main btn-search-horizontal">Search</button>
                </div>
            </div>
        </form>
    </div>
    <div class="panel-container">
        @foreach ($courses as $course)
            <div class="panel panel-space-small">
                <div class="panel-heading">
                    <h3><a href="/courses/show/{{ $course->id }}" class="btn-link">{{ $course->name }}</a></h3>
                </div>
                <div class="panel-body">
                    <p>
                        {{ $course->description }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</section>

@endsection