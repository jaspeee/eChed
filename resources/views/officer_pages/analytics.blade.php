@extends('layouts.layout_officer', [
    'namePage' => 'Reports',
    'fname' => $fname,
    'lname' => $lname,
    'pass' => '/officer/password',
    'class' => 'sidebar-mini',
    'activePage' => 'collate',
  ])

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content"> 

  <div class="row"> 
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            {{-- <h4 class="card-title"> Simple Table</h4> --}}
          </div>
          <div class="card-body">
            <div class="container" style="padding:40px;">

            <p style="font-size:18px;">
                  
            <a href="/officer/collatefiles">
                <button type="button" style="width:20px;height:20px;" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret">
                <i class="now-ui-icons arrows-1_minimal-left" data-toggle="tooltip" data-placement="right" title="Back" ></i>
                </button>
            </a>
            <b>Data Analytics</b></p>
            <p style="font-size:14px;">
            This page is the result of analyzing the collated data.
            Navigate below and see different areas of data for your needs.
            If you have any trouble contact the administration for support.
            </p>

           </div>

          </div>
        </div>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                    <i class="now-ui-icons users_single-02"></i>  Total Population <br>
                    </h5>
                </div>
                <div class="card-body">
                    <center>
                    <h1> {{$TotalPop}} </h1>

                    <table class="table">
                <thead style="background-color: #003471; font-size: 11px;color:white;">
                <tr>
                    <th></th>
                    <th style="text-align: center;"><b>Enrollees</b></th>
                    <th style="text-align: center;"><b>Graduates</b></th>
                
                </tr>
                </thead>
                <tbody style="font-size: 12px"> 
                    <tr>  
                    <td><h5>Male</h5></td>
                    <td style="text-align: center;"><h5>{{$TotalPopMaleEnroll}}</h5></td>
                    <td style="text-align: center;"><h5>{{$TotalPopMaleGrad}}</h5></td>
                    </tr>
                    <tr>  
                    <td><h5>Female</h5></td>
                    <td style="text-align: center;"><h5>{{$TotalPopFemaleEnroll}}</h5></td>
                    <td style="text-align: center;"><h5>{{$TotalPopFemaleGrad}}</h5></td>
                    </tr>
                </tbody>
            </table>
                </center>
                </div>
            </div> 
        </div>
  
        <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-header">
            
            <h5 class="card-title">
                <i class="now-ui-icons users_single-02"></i> SUC Population <br>
            </h5>
            </div>
            <div class="card-body">
            <center>
            <h1> {{$TotalSUCPop}} </h1>
            
    
            <table class="table">
                <thead style="background-color: #003471; font-size: 11px;color:white;">
                <tr>
                    <th></th>
                    <th style="text-align: center;"><b>Enrollees</b></th>
                    <th style="text-align: center;"><b>Graduates</b></th>
                
                </tr>
                </thead>
                <tbody style="font-size: 12px"> 
                    <tr>  
                    <td><h5>Male</h5></td>
                    <td style="text-align: center;"><h5>{{$TotalSUCPopMaleEnroll}}</h5></td>
                    <td style="text-align: center;"><h5>{{$TotalSUCPopMaleGrad}}</h5></td>
                    </tr>
                    <tr>  
                    <td><h5>Female</h5></td>
                    <td style="text-align: center;"><h5>{{$TotalSUCPopFemaleEnroll}}</h5></td>
                    <td style="text-align: center;"><h5>{{$TotalSUCPopFemaleGrad}}</h5></td>
                    </tr>
                </tbody>
            </table>
            </center>
            </div>
        </div> 
    </div>
  
  
  <div class="col-lg-4 col-md-6">
    <div class="card">
      <div class="card-header">
        
        <h5 class="card-title">
          <i class="now-ui-icons users_single-02"></i> NON-SUC Population <br>
        </h5>
      </div>
      <div class="card-body">
        <center>
        <h1>{{$TotalNONSUCPop}} </h1>
      
  
        <table class="table">
          <thead style="background-color: #003471; font-size: 11px;color:white;">
            <tr>
              <th></th>
              <th><b>Enrollees</b></th>
              <th><b>Graduates</b></th>
            
            </tr>
          </thead>
          <tbody style="font-size: 12px"> 
                <tr>  
                   <td><h5>Male</h5></td>
                   <td style="text-align: center;"><h5>{{$TotalNONSUCPopMaleEnroll}}</h5></td>
                   <td style="text-align: center;"><h5>{{$TotalNONSUCPopMaleGrad}}</h5></td>
                </tr>
                <tr>  
                   <td><h5>Female</h5></td>
                   <td style="text-align: center;"><h5>{{$TotalNONSUCPopFemaleEnroll}}</h5></td>
                   <td style="text-align: center;"><h5>{{$TotalNONSUCPopFemaleGrad}}</h5></td>
                </tr>
          </tbody>
        </table>
      </center>
      </div>
    </div> 
  </div>
  
  </div>

  <div class="row"> 
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          
        
          <h5 class="card-title">
            <i class="now-ui-icons business_chart-bar-32"></i> Top 5 Disciplinary Group<br>
          </h5>
        </div>
        <div class="card-body">
       
          <div class="chart-area" style="width: 450px; height: 230px">
             
          </div>
          <p style="font-size:14px;">
           This result is base on the total enrollees and graduates of a certain 
           disciplinary group.
         </p>
        
          <table class="table">
            <thead style="background-color: #003471; font-size: 10px;color:white;">
              <tr>
                
                <th><b>Discipline Group</b></th>
                <th><b>Total</b></th>
               
              </tr>
            </thead>
            <tbody>  
                @foreach($DG as $dg)
                  <tr>
                     <td>{{$dg->major_discipline}}</td>
                     <td>{{$dg->total}}</td>
                  </tr>
                @endforeach
            </tbody>
          </table>


        </div>
      </div> 
    </div>       

    
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          
         
          <h5 class="card-title">
            <i class="now-ui-icons business_chart-bar-32"></i> Top 5 Programs<br>
          </h5>
        </div>
        <div class="card-body">
       
          <div class="chart-area" style="width: 450px; height: 230px">
              
          </div>

          <p style="font-size:14px;">
           This result is base on the total enrollees and graduates of a certain program.
          
         </p>

          <table class="table">
            <thead style="background-color: #003471; font-size: 10px;color:white;">
              <tr>
                
                <th><b>Programs</b></th>
                <th><b>Total</b></th>
              
              </tr>
            </thead>
            <tbody> 
                  @foreach($Programs as $p)
                  <tr>
                     <td>{{$p->program_name}}</td>
                     <td>{{$p->total}}</td>
                  </tr>
                  @endforeach
            </tbody>
          </table>


        </div>
      </div> 
    </div> 

</div>


                 
  </div>
@endsection