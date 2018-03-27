@extends('layouts.master')

@section('content')
<section>
    <div class="panel panel-default">
        <div class="panel-heading">
            Reset Password
        </div>

        <div class="panel-body">

            <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}

                <div class="form-input{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @elseif (session('status'))
                        <div class="form-success">
                            <strong>{{ session('status') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="form-input">
                    <button type="submit" class="btn btn-main">Send Password Reset Link</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
