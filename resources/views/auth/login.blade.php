@extends('layouts.app')

@section('content')
<form role="form" method="POST" action="{{ url('/login') }}">
    {!! csrf_field() !!}
    <div class="panel panel-body login-form">
        <div class="text-center">
            <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
            <h5 class="content-group">
                Login to your account
                <small class="display-block">Enter your credentials below</small>
            </h5>
        </div>

        <div class="form-group has-feedback has-feedback-left {{ $errors->has('email') ? 'has-error' : '' }}">
            <input name="email" type="text" class="form-control" placeholder="E-Mail" value="{{ old('email') }}">
            <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
            </div>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group has-feedback has-feedback-left {{ $errors->has('email') ? 'has-error' : '' }}">
            <input name="password" type="text" class="form-control" placeholder="Password">
            <div class="form-control-feedback">
                <i class="icon-lock2 text-muted"></i>
            </div>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> Remember Me
                </label>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 position-right"></i></button>
        </div>

        <div class="text-center">
            <a href="{{url('/password/reset')}}">Forgot password?</a>
        </div>
    </div>
</form>

@endsection
