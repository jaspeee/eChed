@extends('layouts.layout_officer', [
    'namePage' => 'Finalization',
    'fname' => $fname,
    'lname' => $lname,
    'pass' => '/officer/password',
    'class' => 'sidebar-mini',
    'activePage' => 'finalization',
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

              <p style="font-size:18px;"><b>List of Institutions</b></p>

              <p style="font-size:13px;">
                Notice : Once an action has been confirmed, action cannot be undone. Kindly review carefully before confirming
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

              <table class="table" id = "finaltbl" > 
                  <thead style="background-color: #003471; font-size: 10px;color:white;">
                    <tr>
                      <th><b>Code</b></th>
                      <th><b>Institution</b></th>
                      <th><b>Verified</b></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody> 
                        @foreach($institutions as $ins)
                        
                        <tr>
                            
                            <td>{{$ins->code}}</td>
                            <td>{{$ins->institution_name}}</td>
                            <td>
                              @if($ins->type == 'SUC')
                                <span class="badge badge-primary badge-pill" style="background-color: green;">{{$ins->fcount}} / 7</span>
                              @elseif($ins->type == 'NON-SUC')
                                <span class="badge badge-primary badge-pill" style="background-color: green;">{{$ins->fcount}} / 4</span>
                              @endif
                            </td>
                            <td>
                                <a href="/officer/final/{{$ins->institutions_id}}"> 
                                <button type="submit" style="background-color: transparent;border: none;cursor:pointer;"><i class="fa fa-chevron-right " aria-hidden="true" style="color:gray;font-size: 15px;" data-toggle="tooltip" data-placement="top" title="Approve"></i></button>
                                </a>
                              </td>
                            
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

@section('scripts')
<script  type="text/javascript">
 
  $(document).ready(function() {
      // $('#subtbl').DataTable({
      //   lengthChange: false
       
      // });
      oTable = $('#finaltbl').DataTable({
        "pagingType": "full_numbers",
     sDom: 'lrtip',lengthChange: false
    
  
  }); 
  } );

  

  
  $('#tracksearchbar').keyup(function(){
        oTable.search($(this).val()).draw() ;
  })
  </script>
    

 
@endsection