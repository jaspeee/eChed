@extends('layouts.layout_officer', [
    'namePage' => 'Reports',
    'fname' => $fname,
    'lname' => $lname,
    'pass' => '/officer/password',
    'class' => 'sidebar-mini',
    'activePage' => 'analytics',
  ])

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content"> 
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-category"> <i class="now-ui-icons business_chart-pie-36"></i> SUC</h5>
          </div>
          <div class="card-body">
            
            <div class="chart-area" style="height:150px;">
                {!! $chart->container() !!}
              </div>

          </div>
        </div>
      </div>          
  </div>

    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5 class="card-category"> <i class="now-ui-icons business_chart-bar-32"></i> SUC Enrollment</h5>
          
          </div>
          <div class="card-body">
            
            <div class="chart-area" style="height:150px;">
                {!! $TotalMF->container() !!}
             </div>

             <br>
             <table class="table">
                <thead style="background-color: #003471; font-size: 10px;color:white;">
                  <tr>
                    <th></th>
                    <th><b>Male</b></th>
                    <th><b>Female</b></th>
                  </tr>
                </thead>
                <tbody> 
            
                      {{-- <tr> 
                        <td>Average</td>
                        <td>{{$AVGEnrollmentMale}}</td>
                        <td>{{$AVGEnrollmentFemale}}</td>
                      </tr> --}}
                      <tr> 
                        <td>Percentage</td>
                        <td>{{ $percentageMaleEnroll}} %</td>
                        <td>{{$percentageFemaleEnroll}}%</td>
                        
                      </tr>

                      <tr> 
                        <td>Total</td>
                        <td>{{ $totalEnrollmentMale}}</td>
                        <td>{{$totalEnrollmentFemale}}</td>
                      </tr>
                      
                </tbody>
            </table>

          </div>
        </div>
      </div>       

      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5 class="card-category"> <i class="now-ui-icons business_chart-bar-32"></i> SUC Graduates</h5>
          
          </div>
          <div class="card-body">
            
            <div class="chart-area" style="height:150px;">
                {!! $TotalGradMF->container() !!}
             </div>

             <br>
             <table class="table">
                <thead style="background-color: #003471; font-size: 10px;color:white;">
                  <tr>
                    <th></th>
                    <th><b>Male</b></th>
                    <th><b>Female</b></th>
                  </tr>
                </thead>
                <tbody> 
            
                      {{-- <tr> 
                        <td>Average</td>
                        <td>{{$AVGGraduateMale}}</td>
                        <td>{{$AVGGraduateFemale}}</td>
                      </tr> --}}
                      <tr> 
                        <td>Percentage</td>
                        <td>{{ $percentageMaleGrad}} %</td>
                        <td>{{$percentageFemaleGrad}}%</td>
                        
                      </tr>

                      <tr> 
                        <td>Total</td>
                        <td>{{ $totalGraduateMale}}</td>
                        <td>{{$totalGraduateFemale}}</td>
                      </tr>
                      
                </tbody>
            </table>

            
          </div>
        </div>
      </div>          
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h5 class="card-category"> <i class="now-ui-icons business_chart-pie-36"></i> NON-SUC</h5>
        </div>
        <div class="card-body">
          
          <div class="chart-area" style="height:150px;">
              {!! $TotalNonSucEG->container() !!}
            </div>

        </div>
      </div>
    </div>          
</div>

<div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h5 class="card-category"> <i class="now-ui-icons business_chart-bar-32"></i> NON-SUC Enrollment</h5>
        
        </div>
        <div class="card-body">
          
          <div class="chart-area" style="height:150px;">
              {!! $TotalNonSucMF->container() !!}
           </div>

           <br>
           <table class="table">
              <thead style="background-color: #003471; font-size: 10px;color:white;">
                <tr>
                  <th></th>
                  <th><b>Male</b></th>
                  <th><b>Female</b></th>
                </tr>
              </thead>
              <tbody> 
          
                    {{-- <tr> 
                      <td>Average</td>
                      <td>{{$NONSUCAVGEnrollmentMale}}</td>
                      <td>{{$NONSUCAVGEnrollmentFemale}}</td>
                    </tr> --}}
                    <tr> 
                      <td>Percentage</td>
                      <td>{{ $percentageNonSucMaleEnroll}} %</td>
                      <td>{{$percentageNonSucFemaleEnroll}}%</td>
                      
                    </tr>

                    <tr> 
                      <td>Total</td>
                      <td>{{$NONSUCtotalEnrollmentMale}}</td>
                      <td>{{$NONSUCtotalEnrollmentFemale}}</td>
                    </tr>
                    
              </tbody>
          </table>

        </div>
      </div>
    </div>       

    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h5 class="card-category"> <i class="now-ui-icons business_chart-bar-32"></i> NON-SUC Graduates</h5>
        
        </div>
        <div class="card-body">
          
          <div class="chart-area" style="height:150px;">
              {!! $TotalNonSucGradMF->container() !!}
           </div>

           <br>
           <table class="table">
              <thead style="background-color: #003471; font-size: 10px;color:white;">
                <tr>
                  <th></th>
                  <th><b>Male</b></th>
                  <th><b>Female</b></th>
                </tr>
              </thead>
              <tbody> 
          
                    {{-- <tr> 
                      <td>Average</td>
                      <td>{{$NONSUCAVGGraduateMale}}</td>
                      <td>{{$NONSUCAVGGraduateFemale}}</td>
                    </tr> --}}
                    <tr> 
                      <td>Percentage</td>
                      <td>{{$percentageNonSucMaleGrad}} %</td>
                      <td>{{$percentageNonSucFemaleGrad}}%</td>
                      
                    </tr>

                    <tr> 
                      <td>Total</td>
                      <td>{{ $NONSUCtotalGraduateMale}}</td>
                      <td>{{$NONSUCtotalGraduateFemale}}</td>
                    </tr>
                    
              </tbody>
          </table>

          
        </div>
      </div>
    </div>          
</div>


</div>
@endsection

@section('scripts')

{!! $chart->script() !!}
{!! $TotalMF->script() !!}
{!! $TotalGradMF->script() !!}
{!! $TotalNonSucEG->script() !!}
{!! $TotalNonSucMF->script() !!}
{!! $TotalNonSucGradMF->script() !!}

@endsection