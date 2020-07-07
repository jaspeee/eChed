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

              <p style="font-size:18px;"><b>Collate Files</b></p>
              <p style="font-size:13px;">Collate : Please click this button to collate files
                  
                
                  <button type="button" data-toggle="modal" data-target="#addcollate" style="width:20px;height:20px;" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret">
                    <i class="now-ui-icons files_box" data-toggle="tooltip" data-placement="top" title="Collate"></i>
                  </button>
                 
                </p> 
                <hr>

              <br>     
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
                      <th><b>Reference ID</b></th>
                      <th><b>Collation name</b></th>
                      <th><b>Start date</b></th>
                      <th><b>End date</b></th>
                      <th></th>
                      <th></th>
                   
                    </tr>
                  </thead>
                  <tbody>
                        @foreach($list as $lists)
                        <tr>
                              <td>{{$lists->collation_lists_id}}</td>
                              <td>{{$lists->collate_name}}</td>
                              <td>{{$lists->date_start}}</td>
                              <td>{{$lists->date_end}}</td>
                              <td>
                                <a href="/officer/collatefiles/result/{{$lists->collation_lists_id}}">
                                <button type="button" class="btn btn-success">See Results</button>
                                </a>
                              </td>   
                              <td>
                              <a href="/officer/analytics/{{$lists->collation_lists_id}}">
                              <button type="button" 
                              style="background-color: transparent;border: none;cursor:pointer;">
                              <i class="now-ui-icons  business_chart-bar-32" style="font-size: 20px;color: gray" data-toggle="tooltip" data-placement="top" title="Analytics"></i>
                              </button>
                              </a>
                              </td>              
                        </tr>
                        @endforeach
                 </tbody>    
            </table>

           </div>


           <div class="modal fade" id="addcollate" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Collation File</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <form action="/officer/collatefiles/add" method="POST"> 
                   @csrf

                    
                    <div class="form-group">
                      <label class="col-form-label">Collation name:</label>
                      <input type="text" class="form-control" id="cname" name="cname">
                    </div>
                    <div class="form-group">
                      <label class="col-form-label">Start date:</label>
                      <input class="form-control" type="date" id="sdate" name="sdate">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">End date:</label>
                        <input class="form-control" type="date" id="edate" name="edate">
                      </div>

                    <div class="form-group">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Collate</button>
                    </div>
                
                  </form>
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
    oTable = $('#collationtbl').DataTable({
  sDom: 'lrtip',lengthChange: false
  }); 
  


$('#tracksearchbar').keyup(function(){
      oTable.search($(this).val()).draw() ;
})


  $('[data-toggle="tooltip"]').tooltip();   
});


$('#addcollate').on('show.bs.modal', function(event) {
  var button = $(event.relatedTarget);
  var modal = $(this);

 

});

</script>
@endsection
