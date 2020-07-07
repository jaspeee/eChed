@extends('layouts.layout_verifier', [
    'namePage' => 'Dashboard',
    'fname' => $fname,
    'lname' => $lname,
    'pass' => '/verifier/password',
    'class' => 'sidebar-mini',
    'activePage' => 'dashboard',
  ])

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content"> 
    
    <div class="container">
      <div class="row"> 
        <div class="col-md-6">
          .col-md-8
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  {{-- <h5 class="card-category">Verifier Account</h5> --}}
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
                      <h5>Verifier Account</h5>
                      <hr>
                      <h6 style="font-weight: inherit">{{$HEI}}</h6>
                    </center>
                    {{-- <i style="font-size: 30px;text-align: center;"><i> " {{$school}} " </i></i> --}}
                   
                  </div>
                </div>
            
            </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
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
               
                </div>
              
              </div> 
            </div>
          </div>
        </div>

        <div class="col-md-6" style="padding-top:2%;">
          <div class="card">
            <div class="card-header ">
              <h5 class="card-category"> <i class="now-ui-icons files_single-copy-04"></i> Verifier List</h5>
              <h4 class="card-title">Submission Updates
      
                <a href="/verifier/verification"> 
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
                    {{$sub->institution_name}} submitted " {{$sub->validator_submission}} "
                  
                 <p style="text-align:right;font-size: 10px;padding-top: 2%;color:gray;"> {{$sub->created_at}} </p>
                @endforeach
                 </ul>
      
            </div>
            <div class="card-footer ">
              <hr>
              <div class="stats">
                <i class="now-ui-icons loader_refresh spin"></i> Updated 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


  

  <div class="container">
    <div class="row">
      <div class="col-md-7"> 
        <div class="card">
          <div class="card-header">
            <h5 class="card-category"> <i class="now-ui-icons business_chart-bar-32"></i> Institutions</h5>
            <h4 class="card-title">Number of Institutions</h4>
          </div>
          <div class="card-body">
            
            <div class="chart-area" style="height:150px;">
              {!! $chart->container() !!}
            </div>
            <h6 style="font-weight: normal;color: gray;"> <br>Total : {{$total}}</h6>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="now-ui-icons loader_refresh spin"></i> Updated 
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-5"> 
        <div class="card">
          <div class="card-header">
            <h5 class="card-category"> <i class="now-ui-icons business_chart-pie-36"></i> Institutions</h5>
            <h4 class="card-title">Forms Status</h4>
          </div>
          <div class="card-body">
            
            <div class="chart-area" style="height:150px;">
              {!! $stat_chart->container() !!}
            </div>
            <p style="padding-bottom:6%;"></p>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="now-ui-icons loader_refresh spin"></i> Updated 
            </div>
          </div>
        </div>
      </div>


    </div>
  </div> 


  {{-- <div class="row">
    <div class="col-lg-6 "> 
      <div class="card">
        <div class="card-header">
          <h5 class="card-category"> <i class="now-ui-icons business_chart-bar-32"></i> SUC Monthly Verified </h5>
        </div>
        <div class="card-body">
          <div class="chart-area" style="height:150px;">
            {!! $SUC_chart->container() !!}
          </div>
          
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="now-ui-icons loader_refresh spin"></i> Updated 
          </div>
        </div>
      </div>
    </div>       

    <div class="col-lg-6 col-md-6"> 
      <div class="card">
        <div class="card-header">
          <h5 class="card-category"> <i class="now-ui-icons business_chart-pie-36"></i> SUC Submission Status</h5>
          
        </div>
        <div class="card-body">
          <div class="chart-area" style="height:150px;">
            {!! $StatSUC_charts->container() !!}
          </div>
          
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="now-ui-icons loader_refresh spin"></i> Updated 
          </div>
        </div>
      </div>
    </div>  

  </div>

  <div class="row">
    <div class="col-lg-6 "> 
      <div class="card">
        <div class="card-header">
          <h5 class="card-category"> <i class="now-ui-icons business_chart-bar-32"></i> Non-SUC Monthly Verified </h5>
          
        </div>
        <div class="card-body">
          <div class="chart-area" style="height:150px;">
            {!! $charts->container() !!}
          </div>
          
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="now-ui-icons loader_refresh spin"></i> Updated 
          </div>
        </div>
      </div>
    </div>       

    <div class="col-lg-6 col-md-6"> 
      <div class="card">
        <div class="card-header">
          <h5 class="card-category"> <i class="now-ui-icons business_chart-pie-36"></i> Non-SUC Submission Status</h5>
          
        </div>
        <div class="card-body">
          <div class="chart-area" style="height:150px;">
            {!! $StatNonSUC_charts->container() !!}
          </div>
          
        </div>
        <div class="card-footer">
          <div class="stats">
            <i class="now-ui-icons loader_refresh spin"></i> Updated 
          </div>
        </div>
      </div>
    </div>    --}}

</div>

  
@endsection

@section('scripts')

{!! $chart->script() !!}
{!! $charts->script() !!}
{!! $SUC_chart->script() !!}
{!! $StatNonSUC_charts->script() !!}
{!! $StatSUC_charts->script() !!}
{!! $stat_chart->script() !!}


@endsection