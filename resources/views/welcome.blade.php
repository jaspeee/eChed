@extends('layouts.app', [
    'namePage' => 'Login page',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'login',
    'backgroundImage' => asset('assets') . "/img/login_bg.png",
])
 
@section('content')
    <div class="container"> 
        <div class="container">
        <div class="col-md-4 ml-auto mr-auto">
            <form role="form" method="POST" action="{{ route('login') }}">
                @csrf
            <div class="card card-login card-plain">
                <div class="card-header ">
                <div class="logo-container">
                    <img src="{{url('/images/ched_logo.png')}}" alt="" >
                    <br><br>
                    <center><p style="font-size: 25px;font-weight:initial;color:white;font-family: Arial, Helvetica, sans-serif">E - CHED  XI </p></center>
                </div>
                </div>
                <div class="card-body ">
                <div class="input-group no-border form-control-lg {{ $errors->has('username') ? ' has-danger' : '' }}">
                    <span class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="now-ui-icons users_circle-08"></i>
                    </div>
                    </span>
                    <input class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="{{ __('Username') }}" type="text" name="username" required autofocus>
                </div>
                @if ($errors->has('username'))
                    <span class="invalid-feedback" style="display: block;" role="alert">
                    <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
                <div class="input-group no-border form-control-lg {{ $errors->has('Password') ? ' has-danger' : '' }}">
                    <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="now-ui-icons objects_key-25"></i></i>
                    </div>
                    </div>
                    <input placeholder="Password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" type="password" required>
                </div>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" style="display: block;" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                
                    
                
                <button  type = "submit" class="btn btn-primary btn-round btn-lg btn-block mb-3" style="background-color: #003471;">L O G I N</button>
                <a href="/forgotpassword" style="text-decoration: none;">
                <p style="color:white;text-align: center;padding-top:2%;font-size: 11px;">
                    Forgot Password?</p>
                </a>
 
            </div>      
            </div>
            </form>

           
           <p style="font-size: 10px;color:white; opacity:0.4;text-align: center;">© 2020. e-Ched XI. All Rights Reserved. IHEMIS</p>
          
       

        </div>
        </div> 
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
        demo.checkFullPageBackgroundImage();
        });
    </script>
@endpush
