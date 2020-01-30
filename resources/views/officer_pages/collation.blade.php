@extends('layouts.layout_officer', [
    'namePage' => 'Reports',
    'fname' => $fname,
    'lname' => $lname,
    'pass' => '/officer/password',
    'class' => 'sidebar-mini',
    'activePage' => 'collation',
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

              <p style="font-size:18px;"><b> SUC Collated Files</b></p>

               <!-- Nav tabs -->
               <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#SUCenrollment" role="tab" aria-controls="home" aria-selected="true">Enrollment</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#SUCgraduates" role="tab" aria-controls="profile" aria-selected="false">Graduates</a>
                </li>
              </ul>

              <div class="tab-content">

                <div class="tab-pane active" id="SUCenrollment" role="tabpanel" aria-labelledby="home-tab">
                
                  <br><br>
                  <table class="table" id="collationtbl">
                      <thead style="background-color: #003471; font-size: 10px;color:white;">
                          <tr>
                          <th><b>Program Name</b></th>
                          <th><b>Major Name</b></th>
                          <th><b>Total Male</b></th>
                          <th><b>Total Female</b></th>
                          <th><b>Total Enrollment</b></th>
                          
                          </tr>
                      </thead>
                      <tbody> 
                              @foreach($SUCenrollments as $enroll)
                              
                              <tr>
                                  <td>{{$enroll->program_name}}</td>
                                  <td>{{$enroll->major_name}}</td>
                                  <td>{{$enroll->total_male}}</td>
                                  <td>{{$enroll->total_female}}</td>
                                  <td>{{$enroll->total_enrollment}}</td>
                                  
                              </tr>
                              
                              @endforeach
                      

                      </tbody>
                  </table>
                
                </div>

                <div class="tab-pane" id="SUCgraduates" role="tabpanel" aria-labelledby="profile-tab">
                
                  <br><br>
                  <table class="table" id="gradtbl">
                      <thead style="background-color: #003471; font-size: 10px;color:white;">
                          <tr>
                          <th><b>Program Name</b></th>
                          <th><b>Major Name</b></th>
                          <th><b>Total Male</b></th>
                          <th><b>Total Female</b></th>
                          <th><b>Total Graduates</b></th>
                          
                          </tr>
                      </thead>
                      <tbody> 
                              @foreach($SUCgraduates as $grad)
                              
                              <tr>
                                  <td>{{$grad->program_name}}</td>
                                  <td>{{$grad->major_name}}</td>
                                  <td>{{$grad->total_male}}</td>
                                  <td>{{$grad->total_female}}</td>
                                  <td>{{$grad->total_graduate}}</td>
                                  
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
    </div>
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

              <p style="font-size:18px;"><b> NON-SUC Collated Files</b></p>

               <!-- Nav tabs -->
               <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#SUCenrollment" role="tab" aria-controls="home" aria-selected="true">Enrollment</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#SUCgraduates" role="tab" aria-controls="profile" aria-selected="false">Graduates</a>
                </li>
              </ul>

              <div class="tab-content">

                <div class="tab-pane active" id="SUCenrollment" role="tabpanel" aria-labelledby="home-tab">
                
                  <br><br>
                  <table class="table" id="NONSUCenrolltbl">
                      <thead style="background-color: #003471; font-size: 10px;color:white;">
                          <tr>
                          <th><b>Program Name</b></th>
                          <th><b>Major Name</b></th>
                          <th><b>Total Male</b></th>
                          <th><b>Total Female</b></th>
                          <th><b>Total Enrollment</b></th>
                          
                          </tr>
                      </thead>
                      <tbody> 
                              @foreach($NONSUCenrollments as $NONSUCenroll)
                              
                              <tr>
                                  <td>{{$NONSUCenroll->program_name}}</td>
                                  <td>{{$NONSUCenroll->major_name}}</td>
                                  <td>{{$NONSUCenroll->total_male}}</td>
                                  <td>{{$NONSUCenroll->total_female}}</td>
                                  <td>{{$NONSUCenroll->total_enrollment}}</td>
                                  
                              </tr>
                              
                              @endforeach
                      

                      </tbody>
                  </table>
                
                </div>

                <div class="tab-pane" id="SUCgraduates" role="tabpanel" aria-labelledby="profile-tab">
                
                  <br><br>
                  <table class="table" id="NONSUCgradtbl">
                      <thead style="background-color: #003471; font-size: 10px;color:white;">
                          <tr>
                          <th><b>Program Name</b></th>
                          <th><b>Major Name</b></th>
                          <th><b>Total Male</b></th>
                          <th><b>Total Female</b></th>
                          <th><b>Total Graduates</b></th>
                          
                          </tr>
                      </thead>
                      <tbody> 
                              @foreach($NONSUCgraduates as $NONSUCgrad)
                              
                              <tr>
                                  <td>{{$NONSUCgrad->program_name}}</td>
                                  <td>{{$NONSUCgrad->major_name}}</td>
                                  <td>{{$NONSUCgrad->total_male}}</td>
                                  <td>{{$NONSUCgrad->total_female}}</td>
                                  <td>{{$NONSUCgrad->total_graduate}}</td>
                                  
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
    </div>
  </div>


@endsection

@section('scripts')
<script  type="text/javascript">
  $(document).ready(function() 
  {
      $('#collationtbl').DataTable({
        lengthChange: false
       
      });
      
  } );

  $(document).ready(function() 
  {
      $('#gradtbl').DataTable({
        lengthChange: false
       
      });
      
  } );

  $(document).ready(function() 
  {
      $('#NONSUCenrolltbl').DataTable({
        lengthChange: false
       
      });
      
  } );

  $(document).ready(function() 
  {
      $('#NONSUCgradtbl').DataTable({
        lengthChange: false
       
      });
      
  } );
  </script>
    
@endsection