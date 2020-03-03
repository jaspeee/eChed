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

                    <p style="font-size:13px;">Add Institution : Please click this button to prompt the adding of institutions 
                  
                      <button type="button" data-toggle="modal" data-target="#addInstitution" style="width:20px;height:20px;" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret">
                        <i class="now-ui-icons ui-2_settings-90" data-toggle="tooltip" data-placement="top" title="Add Institution"></i>
                      </button>
                    </p>

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

                <div class="modal fade" id="addInstitution" tabindex="-1" role="dialog"  aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Institution</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="/officer/institution" method="POST">
                          @csrf
      
                          
                          <div class="form-group">
                            <label class="col-form-label">Code:</label>
                            <input type="text" class="form-control" id="code" name="code">
                          </div>
                          <div class="form-group">
                            <label class="col-form-label">Institution Name:</label>
                            <input type="text" class="form-control" id="institution" name="institution">
                          </div>
                          <div class="form-group">
                              <label class="col-form-label">Abbreviation:</label>
                              <input type="text" class="form-control" id="abbrv" name="abbrv">
                            </div>
                          <div class="form-group">
                            <label class="col-form-label">Institution Type: (1)SUC (2)NON-SUC</label>
                  
                            <input type="text" class="form-control" id="type" name="type">
                          </div>
                       
                          <div class="form-group">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add institution</button>
                          </div>
                      
                        </form>
                      </div>
                      
                    </div>
                  </div> 
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


$('#addInstitution').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  var modal = $(this)
})



</script>
@endsection