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

              <p style="font-size:18px;"><b> Collated Files</b></p>

               <!-- Nav tabs -->
               <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#SUCenrollment" role="tab" aria-controls="home" aria-selected="true"
                style="color: gray;">SUC</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#SUCgraduates" role="tab" aria-controls="profile" aria-selected="false"
                style="color: gray;">NON - SUC</a>
                </li>
              </ul>
 
              <div class="tab-content">

                <div class="tab-pane active" id="SUCenrollment" role="tabpanel" aria-labelledby="home-tab">
                
                  <br><br>

                  <form class="form-inline " >
                    <div class="form-group">
                      <label >
                        <i class="now-ui-icons ui-1_zoom-bold" style="font-size: 18px;"></i> &nbsp;
                      </label>
                        <input type="text" class="form-control" id="tracksearchbar" placeholder= "Search" > 
                    </div>
                  </form>
  
                  <br> 

                  <table class="table" id="collationtbl">
                      <thead style="background-color: #003471; font-size: 10px;color:white;">
                          <tr>
                          <th><b>Program Name</b></th>
                          <th><b>Major Name</b></th>
                          <th><b>TME</b></th>
                          <th><b>TFE</b></th>
                          <th><b>TE</b></th>
                          <th><b>TMG</b></th>
                          <th><b>TFG</b></th>
                          <th><b>TG</b></th>
                          
                          </tr>
                      </thead>
                      <tbody> 
                              @foreach($SUC as $suc)
                              
                              <tr>
                                  <td>{{$suc->program_name}}</td>
                                  <td>{{$suc->major_name}}</td>
                                  <td>{{$suc->TME}}</td>
                                  <td>{{$suc->TFE}}</td>
                                  <td>{{$suc->TE}}</td>
                                  <td>{{$suc->TMG}}</td>
                                  <td>{{$suc->TFG}}</td>
                                  <td>{{$suc->TG}}</td>
                              </tr>
                              
                              @endforeach
                      

                      </tbody>
                  </table>
                
                </div>

                <div class="tab-pane" id="SUCgraduates" role="tabpanel" aria-labelledby="profile-tab">
                
                  <br><br>

                  <form class="form-inline " >
                    <div class="form-group">
                      <label >
                        <i class="now-ui-icons ui-1_zoom-bold" style="font-size: 18px;"></i> &nbsp;
                      </label>
                        <input type="text" class="form-control" id="tracksearchbar" placeholder= "Search" > 
                    </div>
                  </form>
  
                  <br> 

                  <table class="table" id="gradtbl">
                      <thead style="background-color: #003471; font-size: 10px;color:white;">
                          <tr>
                            <th><b>Program Name</b></th>
                            <th><b>Major Name</b></th>
                            <th><b>TME</b></th>
                            <th><b>TFE</b></th>
                            <th><b>TE</b></th>
                            <th><b>TMG</b></th>
                            <th><b>TFG</b></th>
                            <th><b>TG</b></th>
                          
                          </tr>
                      </thead>
                      <tbody> 
                              @foreach($NONSUC as $nonsuc)
                              
                              <tr>
                                <td>{{$nonsuc->program_name}}</td>
                                <td>{{$nonsuc->major_name}}</td>
                                <td>{{$nonsuc->TME}}</td>
                                <td>{{$nonsuc->TFE}}</td>
                                <td>{{$nonsuc->TE}}</td>
                                <td>{{$nonsuc->TMG}}</td>
                                <td>{{$nonsuc->TFG}}</td>
                                <td>{{$nonsuc->TG}}</td>
                                  
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
 
  $(document).ready(function() {
    // $('#subtbl').DataTable({
    //   lengthChange: false
     
    // });
    oTable1 = $('#gradtbl').DataTable({
  sDom: 'lrtip',lengthChange: false
  

}); 
} );

$('#tracksearchbar1').keyup(function(){
      oTable1.search($(this).val()).draw() ;
})

 
  $(document).ready(function() {
    // $('#subtbl').DataTable({
    //   lengthChange: false
     
    // });
    oTable = $('#collationtbl').DataTable({
  sDom: 'lrtip',lengthChange: false
  

}); 
} );

$('#tracksearchbar').keyup(function(){
      oTable.search($(this).val()).draw() ;
})

  </script>
    
@endsection