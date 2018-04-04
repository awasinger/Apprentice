@extends('layouts.master')

@section('content')
<section>
    <div class="panel-container">
<!--
        <div class="panel panel-default">
            <div class="panel-heading">
                Dashboard
            </div>
    
            <div class="panel-body">
                <p>Welcome, {{ Auth::user()->name }}!</p>
            </div>
        </div>
-->
        @if (Auth::user()->business)
            <div class="sub-header">
                <h4>Courses You Have Made</h4>
            </div>
            @foreach ($courses as $course)
                <div class="panel panel-space-small">
                    <div class="panel-heading">
                        <a href="/courses/edit/{{ $course->id }}" class="btn-link">{{ $course->name }}</a>
                    </div>
                    <div class="panel-body">
                        {{ $course->description }}
                    </div>
                </div>
            @endforeach
        @else
            <div class="sub-header">
                <h4>Courses You Own</h4>
                {{ session('success') }}
            </div>
            @foreach ($courses as $course)
                <div class="panel panel-space-small">
                    <div class="panel-heading">
                        <a href="/courses/show/{{ $course->id }}" class="btn-link">{{ $course->name }}</a>
                    </div>
                    <div class="panel-body">
                        {{ $course->description }}
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</section>
@endsection