@extends('layouts.layout_encoder', [
    'namePage' => 'Dashboard',
    'fname' => $fname,
    'lname' => $lname,
    'pass' => '/encoder/password',
    'class' => 'sidebar-mini',
    'activePage' => 'dashboard',
  ])

@section('content') 
  <div class="panel-header panel-header-sm">
  </div>

 

  <div class="content"> 
    

      <div class="row">
        <div class="col-md-6">
          <div class="card">
              <div class="card-header">
                <h5 class="card-title">
                  <i class="now-ui-icons business_bank" ></i>
                  Welcome to E - CHED<br>
                </h5>
                <p style="font-size:13px;text-align: justify;color:gray;">
                  This page is design to give you some updates. 
                  Navigate below and see diffirent areas of data for your needs.
                  If you have any trouble contact the administration for support.
                </p>
              </div>
              <div class="card-body">
                <div class="container" style="padding:10px;">
                  <center>
                    <h5>Encoder Account</h5>
                    <hr>
                    <h6 style="font-weight: inherit">{{$school}}</h6>
                  </center>
                </div>
              </div>
              
          </div>
        </div>

        <div class="col-md-6">
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
              <p style="font-size: small;color: gray;text-align: right;">
              <i class="now-ui-icons ui-2_setting-90"></i> 
              Posted By: {{$dd->first_name}} {{$dd->last_Name}}</p>
             @endforeach
       

            </div>
          
          </div>
         
        </div> 
         
    </div>
    
      <div class="row">
      <div class="col-md-6"> 
        <div class="card  card-tasks">
          <div class="card-header ">
            <h5 class="card-category">Encoder List</h5>
            <h4 class="card-title">Submission Updates

              <a href="/encoder/track">
              <button type="button" style="width:20px;height:20px;" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret">
                <i class="now-ui-icons loader_gear" ></i>
              </button>
              </a>

            </h4>
            
          </div>
          <div class="card-body "> 

            <ul class="list-group list-group-flush">
              @foreach($submissions as $sub)
              <li class="list-group-item" > 
                
                  <i class="now-ui-icons ui-1_bell-53" style="font-size: 15px;color: #ffd400"></i> &nbsp;
                  {{$sub->first_name}} {{$sub->last_Name}} submitted " {{$sub->encoder_submission}} "
                
               <p style="text-align:right;font-size: 10px;padding-top: 2%;color:gray;"> {{$sub->created_at}} </p>
              @endforeach
               </ul>

            {{-- <div class="table-full-width table-responsive">
              <table class="table" style="padding:10px;">
                <tbody>

                  @foreach($submissions as $sub)
                  <tr style="padding:100px;">
                    <td>
                      <i class="now-ui-icons ui-1_bell-53" style="font-size: 20px;"></i>
                    </td>
                  <td>{{$sub->first_name}} {{$sub->last_Name}} submitted "{{$sub->encoder_submission}}"</td>
                    
                  </tr>
                  @endforeach

                </tbody>
              </table>
            </div> --}}

          </div>
          <div class="card-footer ">
            <hr> 
            <div class="stats">
              <i class="now-ui-icons loader_refresh spin"></i> Updated 
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5 class="card-category"> <i class="now-ui-icons business_chart-bar-32"></i>  Encoder </h5>
            <h4 class="card-title"> Submission Status</h4>
          </div>
          <div class="card-body" >
            <div class="chart-area" style="height:190px;">
            {!! $chart->container() !!} 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
                 
  </div>
@endsection

@section('scripts')

{!! $chart->script() !!}

@endsection