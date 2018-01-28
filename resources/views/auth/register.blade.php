@extends('layouts.master')

@section('content')
<section>
<div class="panel">
    <div class="panel-heading">
        <h3>Register</h3>
    </div>

    <div class="panel-body">
        <form method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="form-input{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-input{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">E-Mail Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-input{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-input">
                <label for="password-confirm">Confirm Password</label>
                <input id="password-confirm" type="password" name="password_confirmation" required>
            </div>

            <div class="form-input">
                <button type="submit" class="btn btn-main">
                    Register
                </button>
            </div>
        </form>
    </div>
</div>
</section>
@endsection
