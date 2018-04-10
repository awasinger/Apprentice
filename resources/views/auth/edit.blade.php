@extends('layouts.master')
@section('content')
<section>
    <div class="panel panel-wide">
        <div class="panel-heading">
            Settings
        </div>
        <div class="panel-body">
            <form method="post" action="/settings">
                {{ csrf_field() }}
                <div class="form-input{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Change Your Email</label>
                    <input type="email" name="email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-input">
                    <button type="submit" class="btn btn-main btn-top-sm">Change</button>
                </div>
                <div class="form-input{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Change Your Password</label>
                    <input type="password" name="password" autocomplete="new-password">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-input">
                    <label for="password_confimation">Confirm Your Password</label>
                    <input type="password" name="password_confirmation">
                </div>
                <div class="form-input">
                    <button type="submit" class="btn btn-main btn-top-sm">Change</button>
                </div>
            </form>
            <form action="/settings/delete" method="post" id="delete-account">
                {{ csrf_field() }}
                <button class="btn btn-main btn-warning" id="delete-button" type="button">Delete Your Account</button>
            </form>
        </div>
    </div>
</section>
@endsection