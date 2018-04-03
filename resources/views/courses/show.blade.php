@extends('layouts.master')

@section('content')
<section>
    <div class="panel panel-btn">
        <div class="panel-heading">
            <h3>{{ $course->name }}</h3>
        </div>
        <div class="panel-body">
            @if ($owned)
                <div>
                <p>Course Files</p>
                    @foreach ($course->paths as $path)
                        <p><a href="/storage/{{ $path }}" class="btn-link" target="_blank">{{ explode('.', substr($path, 2))[0] }}</a></p>
                    @endforeach
                    <hr>
                </div>
                <div>
                    <a href="/courses/take/{{ $course->id }}" class="btn-link">Take the exam</a>
                </div>
            @else
                <p>{{ $course->description }}</p>
                @if (Auth::check())
                    <div class="stripe-form" id="checkout">
                        <form action="/courses/buy" method="post" id="payment-form">
                            {{ csrf_field() }}
                            <div class="form-input">
                               <label for="card-element">Pay ${{ $course->cost / 100 }} for {{ $course->name }}</label>
                                    <div id="card-element">
                                        <!-- A Stripe Element will be inserted here. -->
                                    </div>
                                <!-- Used to display form errors. -->
                                    <div id="card-errors" role="alert" class=""></div>
                                </div>
                            
                                <button class="btn btn-main" type="submit">Buy Course</button>
                                <input type="hidden" value="{{ $course->id }}" name="id">
                        </form>
                    </div>
                    <button id="show-checkout" class="btn btn-main">Buy Course</button>
                @endif
            @endif
        </div>
    </div>
</section>
@endsection