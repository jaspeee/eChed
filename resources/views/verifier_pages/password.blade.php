@extends('layouts.layout_verifier', [
    'namePage' => 'Change Password',
    'fname' => $fname,
    'lname' => $lname,
    'pass' => '/verifier/password',
    'class' => 'sidebar-mini',
    'activePage' => '',
  ])


@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">

    @if (count($errors) > 0)
    <div class="alert alert-danger" style="line-height: 2px; padding-top:3%; padding-bottom:1%;">
      <p>There were some problems with your File input.</p>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif

      @if(session('success'))
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        {{ session('success') }}
      </div> 

      @elseif(session('danger'))
      <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        {{ session('danger') }}
      </div> 
      @endif

    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__("Password")}}</h5>
          </div>
          <div class="card-body">
            <form method="post" action="/verifier/changepass" autocomplete="off">
            {{method_field('patch')}}
             @csrf
            
              @include('alerts.success', ['key' => 'password_status'])
              <div class="row">
                <div class="col-md-7 pr-1">
                  <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                    <label>{{__(" Current Password")}}</label>
                    <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="old_password" placeholder="{{ __('Current Password') }}" type="password"  required>
                    @include('alerts.feedback', ['field' => 'old_password'])
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-7 pr-1">
                  <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                    <label>{{__(" New password")}}</label>
                    <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" type="password" name="password" required>
                    @include('alerts.feedback', ['field' => 'password'])
                  </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-7 pr-1">
                <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                  <label>{{__(" Confirm New Password")}}</label>
                  <input class="form-control" placeholder="{{ __('Confirm New Password') }}" type="password" name="password_confirmation" required>
                </div>
              </div>
            </div>
            <div class="card-footer ">
              <button type="submit" onclick="return confirmation();" class="btn btn-primary btn-round ">{{__('Change Password')}}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
      <div class="col-md-4">
        <div class="card card-user">
          <div class="image">
            <img src="{{asset('assets')}}/img/bg5.jpg" alt="...">
          </div>
          <div class="card-body">
            <div class="author">
                <img class="avatar border-gray" src="{{asset('assets')}}/img/default-avatar.png" alt="...">
                <h5 class="title">{{ auth()->user()->name }}</h5>
 
              <p class="description" style="font-size: 18px;">
                  <b>{{$fname}} &nbsp; {{$lname}}</b> <br>
                  Verifier
              </p>
              <hr>
              <br>
              <p class="description" style="text-align:left;"><i class="fa fa-info-circle" style="text-align:left;font-size:13px;"></i>
                &nbsp; {{$pos}}
              </p>
              <p class="description" style="text-align:left;"><i class="fa fa-info-circle" style="text-align:left;font-size:13px;"></i>
                &nbsp; {{$div}}
              </p>
            </div>
          </div>
        
      
         
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script  type="text/javascript">

function confirmation(){
    if(confirm('Are you sure you want to change password ?')){
        submit();
    }else{
        return false;
    }   
}

</script>
@endsection