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

                <p style="font-size:18px;"><b>Track Submissions from Validators</b></p>
                <p style="font-size:13px;">
                  Notice : To download a specific form, click the download icon on the right-most part of the row
                </p>
                <hr>  

                <p style="font-size: initial">{{$institution}}</p>
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
               
                <table class="table" id="institutionstbl">
                    <thead style="background-color: #003471; font-size: 10px;color:white;">
                      <tr>
                        <th><b>Verified by</b></th>
                        <th><b>Form</b></th>
                        <th><b>Date Verified</b></th>
                        <th><b></b></th>
                        
                      </tr> 
                    </thead>
                    <tbody> 
                          @foreach($files as $file)
                          <tr>
                             <td>{{$file->first_name}} &nbsp {{$file->last_Name}}</td>
                              <td>{{$file->verifier_submission}}</td>
                              <td>{{$file->created_at}}</td>
                             
                              <td style="padding:0;">
                              <a href="/storage/complete/{{$file->verifier_submission}}" download>
                                <button type="submit" style="background-color: transparent;border: none;cursor:pointer;">
                                  <i class="now-ui-icons arrows-1_cloud-download-93" style="font-size: 15px;color: gray" data-toggle="tooltip" data-placement="top" title="download"></i>
                                  {{-- <i class="fa fa-download" aria-hidden="true" style="color:#696969;font-size: 15px;" data-toggle="tooltip" data-placement="top" title="download"></i> --}}
                                </button></a>
                              </td>
                            
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
    oTable = $('#institutionstbl').DataTable({
  sDom: 'lrtip',lengthChange: false
  

}); 
} );

$('#tracksearchbar').keyup(function(){
      oTable.search($(this).val()).draw() ;
})

  </script> 
    
    
@endsection