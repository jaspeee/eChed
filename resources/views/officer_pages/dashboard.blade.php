@extends('layouts.layout_officer', [
    'namePage' => 'Dashboard',
    'fname' => $fname,
    'lname' => $lname,
    'pass' => '/officer/password',
    'class' => 'sidebar-mini',
    'activePage' => 'dashboard',
  ])

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content"> 
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">
              <i class="now-ui-icons ui-1_calendar-60" ></i>
               Deadline for the Submission
            </h5>
          </div>
          <div class="card-body" style="padding: 5%;">
            @foreach($deadline as $dd)
           <h6 style="font-weight: normal;">Date : {{$dd->deadline_date}}</h6>
           <p>Note &nbsp;: {{$dd->message}} </p>
           <hr>
              <p style="font-size: small;color: gray;text-align: right;"><i class="now-ui-icons ui-2_setting-90"></i> Posted By: {{$dd->first_name}} {{$dd->last_Name}}</p>
           @endforeach
           {{ $deadline->links("pagination::bootstrap-4")}}
          </div>
          
        

        </div>
      </div> 
      
                 
  </div>
@endsection