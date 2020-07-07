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
          </div>
          <div class="card-body">
            <div class="container" style="padding:40px;">

            <p style="font-size:18px;">
                  
                  <a href="/officer/collatefiles">
                    <button type="button" style="width:20px;height:20px;" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret">
                      <i class="now-ui-icons arrows-1_minimal-left" data-toggle="tooltip" data-placement="right" title="Back" ></i>
                    </button>
                    </a>
   
   
                <b>Collated Data</b></p>
              <p style="font-size:13px;">Export : Please click this button to export the collated files
                  
                <a href="/officer/exports/{{$id1}}">
                <button  onclick="return confirmation();" type="button" style="width:20px;height:20px;" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret">
                  <i class="now-ui-icons arrows-1_share-66" data-toggle="tooltip" data-placement="top" title="Collate"></i>
                </button>
                </a>
                </p>
                <hr>
                
                <!-- {{$id1}} -->




              <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" style="color: gray;">SUC</a>
                  <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" style="color: gray;">NON-SUC</a>
                  
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                
                <br><br>

                  <form class="form-inline " >
                    <div class="form-group">
                      <label >
                        <i class="now-ui-icons ui-1_zoom-bold" style="font-size: 18px;"></i> &nbsp;
                      </label>
                        <input type="text" class="form-control" id="tracksearchbar1" placeholder= "Search" > 
                    </div>
                  </form>
  
                  <br> 

                <table class="table" id="SUCtbl">
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
                              @foreach($SUC as $s)
                              
                              <tr>
                                <td>{{$s->program_name}}</td>
                                <td>{{$s->major_name}}</td>
                                <td>{{$s->TME}}</td>
                                <td>{{$s->TFE}}</td>
                                <td>{{$s->TE}}</td>
                                <td>{{$s->TMG}}</td>
                                <td>{{$s->TFG}}</td>
                                <td>{{$s->TG}}</td>
                                  
                              </tr>
                              @endforeach

                      </tbody>
                  </table>
                
                </div>
                
          
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                

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

                <table class="table" id="NONSUCtbl">
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
                        @foreach($NONSUC as $NS)
                        <tr>
                          <td>{{$NS->program_name}}</td>
                          <td>{{$NS->major_name}}</td>
                          <td>{{$NS->TME}}</td>
                          <td>{{$NS->TFE}}</td>
                          <td>{{$NS->TE}}</td>
                          <td>{{$NS->TMG}}</td>
                          <td>{{$NS->TFG}}</td>
                          <td>{{$NS->TG}}</td>
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
@endsection

@section('scripts')
<script  type="text/javascript">

$(document).ready(function() {

  oTable1 = $('#SUCtbl').DataTable({
  sDom: 'lrtip',lengthChange: false }); 

});

$('#tracksearchbar1').keyup(function(){
      oTable1.search($(this).val()).draw() ;
})

 
$(document).ready(function() {

  oTable = $('#NONSUCtbl').DataTable({
  sDom: 'lrtip',lengthChange: false}); 

});

$('#tracksearchbar').keyup(function(){
      oTable.search($(this).val()).draw() ;
})

function confirmation(){
    if(confirm('Are you sure that you want to export the collated data?')){
        submit();
    }else{
        return false;
    }   
}


</script>
@endsection
