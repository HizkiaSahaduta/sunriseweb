@extends('layouts.app')

@section('content')
<!--  main content -->
<div id="login-page" class="row">
  <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
    <form class="login-form" method="POST" action="{{ route('login') }}">
    @csrf
      <div class="row">
        <div class="input-field col s12">
          <h5 class="ml-4">Sign in</h5>
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">person_outline</i>
          <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">
          <label for="username" class="center-align">{{ __('Username') }}</label>
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">lock_outline</i>
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
          <label for="password">{{ __('Password') }}</label>
        </div>
      </div>
      <!-- <div class="row">
        <div class="col s12 m12 l12 ml-2 mt-1">
          <p>
            <label>
              <input type="checkbox" />
              <span>Remember Me</span>
            </label>
          </p>
        </div>
      </div> -->
      <div class="row">
        <div class="input-field col s12">
            <button class="mb-6 btn waves-effect waves-light green darken-1 col s12 animated fadeIn">{{ __('Login') }}</button>
        </div>
      </div>
    </form>
  </div>
</div>

@if(\Session::has('alert'))
    <script>
        var error = "{{ Session::get('alert') }}"
        swal("Sign In Error", error, "error")
            .then((value) => {
                document.getElementById("username").focus();
        });

    </script>
@endif

@endsection
