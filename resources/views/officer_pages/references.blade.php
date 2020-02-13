@extends('layouts.layout_officer', [
    'namePage' => 'Change Password',
    'fname' => $fname,
    'lname' => $lname,
    'pass' => '/officer/password',
    'class' => 'sidebar-mini',
    'activePage' => 'references',
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
               
              <p style="font-size:18px;"><b>References</b></p>
              <br>
                <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                <a class="nav-link active" style="color:gray;" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Institutions</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" style="color:gray;" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Disciplines</a>
                </li>
                
            </ul>
            
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    
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

                      
                    <table class="table" id="reftbl">
                        <thead style="background-color: #003471; font-size: 10px;color:white;">
                          <tr>
                            <th><b>Institutional Code</b></th>
                            <th><b>Institution</b></th>
                    
                          </tr>
                        </thead>
                        <tbody>
                              @foreach($institutions as $ins)
                              <tr>
                                  <td>{{$ins->code}}</td>
                                  <td>{{$ins->institution_name}} </td>
                                  
                              </tr>
                              @endforeach
                         
                        </tbody>
                      </table>

                </div>
                
                    <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        
                        
                        <br><br>

                        <br>     
                        <form class="form-inline " >
                            <div class="form-group">
                              <label >
                                <i class="now-ui-icons ui-1_zoom-bold" style="font-size: 18px;"></i> &nbsp;
                              </label>
                                <input type="text" class="form-control" id="tracksearchbar1" placeholder= "Search" > 
                            </div>
                          </form>
          
                          <br> 

                          
                    <table class="table" id="distbl">
                        <thead style="background-color: #003471; font-size: 10px;color:white;">
                          <tr>
                            <th><b>Disciplinary Code</b></th>
                            <th><b>Discpline Groups</b></th>
                    
                          </tr>
                        </thead>
                        <tbody>
                              @foreach($discipline as $dis)
                              <tr>
                                  <td>{{$dis->code}}</td>
                                  <td>{{$dis->major_discipline}} </td>
                                  
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
    oTable1 = $('#reftbl').DataTable({
  sDom: 'lrtip',lengthChange: false
  

}); 
} );

$(document).ready(function() {
    // $('#subtbl').DataTable({
    //   lengthChange: false
     
    // });
    oTable = $('#distbl').DataTable({
  sDom: 'lrtip',lengthChange: false
  

}); 
} );

$('#tracksearchbar').keyup(function(){
      oTable1.search($(this).val()).draw() ;
})

$('#tracksearchbar1').keyup(function(){
      oTable.search($(this).val()).draw() ;
})



</script>
@endsection