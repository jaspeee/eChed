@extends('layouts.layout_validator', [
    'namePage' => 'Records',
    'fname' => $fname,
    'lname' => $lname,
    'pass' => '/validator/password',
    'class' => 'sidebar-mini',
    'activePage' => 'record',
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

              <p style="font-size:18px;"><b>Yearly Records</b></p>
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
              <table class="table" id="recordtbl">
                <thead style="background-color: #003471; font-size: 10px;color:white;">
                  <tr>
                    <th><b>Reference ID</b></th>
                    <th><b>Forms</b></th>
                    <th><b>Year</b></th>
                    <th><b></b></th>
            
                  </tr>
                </thead>
                <tbody>
                      @foreach($forms as $form) 
                      <tr>  
                          <td>{{$form->archives_id}}</td>
                          <td>{{$form->file}}</td>
                          {{-- <td>{{$form->created_at}} </td> --}}
                          <td>{{ Carbon\Carbon::parse($form->created_at)->format('Y') }}</td>
                          <td>
                          <a href="/validator/record/{{$form->archives_id}}" style="text-decoration-line: none;" download>
                          <button type="submit" style="background-color: transparent;border: none;cursor:pointer;">
                          <i class="now-ui-icons arrows-1_cloud-download-93" style="font-size: 15px;color: gray" data-toggle="tooltip" data-placement="top" title="download"></i>
                          </button></a>
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
    oTable = $('#recordtbl').DataTable({
  sDom: 'lrtip',lengthChange: false
  

}); 
} );

$('#tracksearchbar').keyup(function(){
      oTable.search($(this).val()).draw() ;
})

</script>
@endsection