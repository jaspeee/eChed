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


  <div class="container">

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
            <h1>{{$TotalStudents}} </h1>
          
  
            <table class="table">
              <thead style="background-color: #003471; font-size: 10px;color:white;">
                <tr>
                  
                  <th style="text-align: center;"><b>Enrollment</b></th>
                  <th style="text-align: center;"><b>Graduates</b></th>
                
                </tr>
              </thead>
              <tbody> 
                    <tr>
                      
                       <td style="text-align: center;"><h5>{{$TotalEnrollment}}</h5></td>
                       <td style="text-align: center;"><h5>{{$TotalGraduates}}</h5></td>
                      
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
          <h1>{{$SUC_Population}} </h1>
        
  
          <table class="table">
            <thead style="background-color: #003471; font-size: 10px;color:white;">
              <tr>
                
                <th style="text-align: center;"><b>Enrollment</b></th>
                <th style="text-align: center;"><b>Graduates</b></th>
              
              </tr>
            </thead>
            <tbody> 
                  <tr>
                    
                     <td style="text-align: center;"><h5>{{$SUC_TE}}</h5></td>
                     <td style="text-align: center;"><h5>{{$SUC_TG}}</h5></td>
                    
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
        <h1>{{$NONSUC_Population}} </h1>
      
  
        <table class="table">
          <thead style="background-color: #003471; font-size: 10px;color:white;">
            <tr>
              
              <th style="text-align: center;"><b>Enrollment</b></th>
              <th style="text-align: center;"><b>Graduates</b></th>
            
            </tr>
          </thead>
          <tbody> 
                <tr>
                  
                   <td style="text-align: center;"><h5>{{$NONSUC_TE}}</h5></td>
                   <td style="text-align: center;"><h5>{{$NONSUC_TG}}</h5></td>
                  
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
        &nbsp;

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-category">  <i class="now-ui-icons business_chart-bar-32"></i> Total Male</h5>
              </div>
              <div class="card-body" style="height:150px;">
                {!! $male->container() !!}
              </div>
          </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-category">  <i class="now-ui-icons business_chart-bar-32"></i> Total Female</h5>
              </div>
              <div class="card-body" style="height:150px;">
                {!! $female->container() !!}
              </div>
            
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6" style="padding-top:2%;">
        <div class="card">
          <div class="card-header ">
            <center><h5>Total Male and Female</h5></center>
          </div>
          <div class="card-body" style="height:355px;">
            {!! $gender->container() !!}
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
              {!! $Discipline->container() !!}
          </div>

        
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
                     <td>{{$dg->Total}}</td>
                    
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
              {!! $program->container() !!}
          </div>

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
                     <td>{{$p->Total}}</td>
                    
                  </tr>
                  @endforeach
             

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
        
        <h5 class="card-category"> <i class="now-ui-icons business_chart-pie-36"></i> NON - SUC</h5>
        <h5 class="card-title">
        Top 10 Colleges with Highest Number of Enrollees<br>
        </h5>
      </div>
      <div class="card-body">
     
        <div class="chart-area" style="height:150px;">
            {!! $ce->container() !!}
        </div>

        <?php $i = 1; ?>
        <table class="table">
          <thead style="background-color: #003471; font-size: 10px;color:white;">
            <tr>
              <th></th>
              <th><b>Institution</b></th>
              <th><b>Total</b></th>
            
            </tr>
          </thead>
          <tbody> 
            
                @foreach($College_E as $e)
                <tr>
                   <td>Top 

                    {{$i}}
                    <?php $i++; ?>
                    </td>

                   <td>{{$e->institution_name}}</td>
                   <td>{{$e->Total}}</td>
                  
                </tr>
                @endforeach
           

          </tbody>
        </table>


      </div>
    </div> 
  </div>          
</div>

<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        
        <h5 class="card-category"> <i class="now-ui-icons business_chart-pie-36"></i> NON - SUC</h5>
        <h5 class="card-title">
        Top 5 Highest Courses Enrolled<br>
        </h5>
      </div>
      <div class="card-body">
     
        <div class="chart-area" style="height:150px;">
            {!! $courses->container() !!}
        </div>

        <?php $i = 1; ?>
        <table class="table">
          <thead style="background-color: #003471; font-size: 10px;color:white;">
            <tr>
              <th></th>
              <th><b>Institution</b></th>
              <th><b>Total</b></th>
            
            </tr>
          </thead>
          <tbody> 
            
                @foreach($Courses_E as $c)
                <tr>
                   <td> Top

                    {{$i}}
                    <?php $i++; ?>

                   </td>
                   <td>{{$c->program_name}}</td>
                   <td>{{$c->Total}}</td>
                  
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
        
        <h5 class="card-category"> <i class="now-ui-icons business_chart-pie-36"></i> NON - SUC</h5>
        <h5 class="card-title">
        Top 5 Colleges with Highest Number of Graduates<br>
        </h5>
      </div>
      <div class="card-body">
     
        <div class="chart-area" style="height:150px;">
            {!! $college->container() !!}
        </div>

        <?php $i = 1; ?>
        <table class="table">
          <thead style="background-color: #003471; font-size: 10px;color:white;">
            <tr>
              <th></th>
              <th><b>Institution</b></th>
              <th><b>Total</b></th>
            
            </tr>
          </thead>
          <tbody> 
            
                @foreach($College_G as $cc)
                <tr>
                   <td> Top

                    {{$i}}
                    <?php $i++; ?>

                   </td>
                   <td>{{$cc->institution_name}}</td>
                   <td>{{$cc->Total}}</td>
                  
                </tr>
                @endforeach
           

          </tbody>
        </table>


      </div>
    </div> 
  </div>          
</div>

 


</div>

</div>
@endsection

@section('scripts')

{{-- {!! $chart->script() !!}
{!! $TotalMF->script() !!}
{!! $TotalGradMF->script() !!}
{!! $TotalNonSucEG->script() !!}
{!! $TotalNonSucMF->script() !!}
{!! $TotalNonSucGradMF->script() !!} --}}
{!! $Discipline->script() !!}
{!! $ce->script() !!}
{!! $courses->script() !!}
{!! $college->script() !!}
{!! $program->script() !!}
{!! $gender->script() !!}
{!! $male->script() !!}
{!! $female->script() !!}


@endsection 