@extends('layouts.master')
{{-- $errors->has('email') ? ' has-error' : '' --}}
@section('content')

<section>
<div class="panel">
    <div class="panel-heading">
        <h3>Login</h3>
    </div>
    
    <div class="panel-body">
        <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
    
            <div class="form-input{{ $errors->has('email') ? ' has-error' : ''}}">
                <label for="email" class="">E-Mail Address</label>
                
                <input id="email" type="email" class="" name="email"  value="{{ old('email') }} " required autofocus>
    
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
    
            </div>
    
            <div class="form-input{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="">Password</label>
    
    
                <input id="password" type="password" class="" name="password" required>
    
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
    
            </div>
    
            <div class="">
    
                <div class="">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                </div>
    
            </div>
    
            <div class="form-input">
                <button type="submit" class="btn btn-main">
                    Login
                </button>
    
                <a class="btn-link" href="{{ route('password.request') }}">
                    Forgot Your Password?
                </a>
            </div>
        </form>
    </div>
</div>
</section>
@endsection
