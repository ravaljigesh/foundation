@extends('layouts.login-header')
@section('content')
<div class="section_header">
    <div class="section_header_bg">
        <div class="content">
            <div class="intro">
              <img src="{{ url('storage/media/image/logo_metronic_1.png') }}" alt="Metronic">
              <div class="intro__title">Login to Admin</div>

            </div>
        </div>
    </div>
    <div class="login__form">
      <div class="panel panel-default myPanel">
        <div class="panel-body">

          <form class="m-login__form m-form" action="{{ AdminURL('login') }}" method="post" role="form">
            {{ csrf_field() }}
              <div class="form-group m-form__group {{ $errors->has('email') ? ' has-error' : '' }}">
  							<input class="form-control m-input" type="email" placeholder="Email" name="email" autocomplete="off">
                <div id="email-error" class="form-control-feedback">
                  @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                  @endif
                </div>
  						</div>
  						<div class="form-group m-form__group {{ $errors->has('password') ? ' has-error' : '' }}">
  							<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" name="password">
                <div id="password-error" class="form-control-feedback">
                  @if ($errors->has('password'))
                  <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
                  @endif
                </div>
  						</div>
  						<div class="row m-login__form-sub">
  							<div class="col m--align-left">
  								<label class="m-checkbox m-checkbox--focus">
  									<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
  									Remember me
  									<span></span>
  								</label>
  							</div>
  							<div class="col m--align-right">
  								<a href="javascript:;" id="m_login_forget_password" class="m-link">
  									Forget Password ?
  								</a>
  							</div>
  						</div>
  						<div class="m-login__form-action">
  							<button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
  								Sign In
  							</button>
  						</div>
					</form>
        </div>
    </div>
    </div>
</div>
@endsection
