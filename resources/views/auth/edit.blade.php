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
                @if (!Auth::user()->business)
                    <div class="form-input">
                        <label for="business">Register as a Business</label>
                        <input type="text" name="business[]" class="form-space-top" placeholder="Company Name">
                    </div>
                    <div class="form-input">
                        <textarea  name="business[]" placeholder="Your company description"></textarea>
                    </div>
                    <div class="form-input">
                        <button type="submit" class="btn btn-main btn-top-sm">Apply</button>
                    </div>
                @endif
            </form>
        </div>
    </div>
</section>
@endsection