@extends('layouts.layout_officer', [
    'namePage' => 'Reports',
    'fname' => $fname,
    'lname' => $lname,
    'pass' => '/officer/password',
    'class' => 'sidebar-mini',
    'activePage' => 'audits',
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

              <p style="font-size:18px;"><b>Audit Logs</b></p>
              <p style="font-size:13px;">Export : Please click this button to export the audit logs
                  
                  <button type="button" data-toggle="modal" data-target="#addaudit" style="width:20px;height:20px;" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret">
                    <i class="now-ui-icons files_box" data-toggle="tooltip" data-placement="top" title="Collate"></i>
                  </button>
                  
                </p> 
                <hr>
              <br>
             
              <!-- <form class="form-inline " >
                    <div class="form-group">
                      <label >
                        <i class="now-ui-icons ui-1_zoom-bold" style="font-size: 18px;"></i> &nbsp;
                      </label>
                        <input type="text" id="myInput" onkeyup="myFunction()" class="form-control"  placeholder= "Search" > 
                    </div> 
                  </form> -->
                  <br>
<!-- 
                  <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">

                  <ul id="myUL">
                    <li><a href="#">Adele</a></li>
                    <li><a href="#">Agnes</a></li>

                    <li><a href="#">Billy</a></li>
                    <li><a href="#">Bob</a></li>

                    <li><a href="#">Calvin</a></li>
                    <li><a href="#">Christina</a></li>
                    <li><a href="#">Cindy</a></li>
                  </ul> -->


              <div class="list-group">
                  
                  @foreach($audits as $audit)
                  
                  <ul class="list-group list-group-flush" >
                 
                  <li class="list-group-item list-group-item-action">
                     <i class="now-ui-icons location_bookmark"></i> &nbsp&nbsp 
                 
                  On {{$audit->created_at}}, {{$audit->first_name}} {{$audit->last_Name}} [{{$audit->ip_address}}] 
                  
                  @if($audit->event == 'uploaded'  || $audit->event == 'approved' || $audit->event == 'disapproved')
                    {{$audit->event}} a form

                  @elseif($audit->event == 'created' || $audit->event == 'updated')
                    {{$audit->event}} an account

                  @elseif($audit->event == 'reset password' || $audit->event == 'change status')
                    {{$audit->event}} of an account
                    
                  @endif
                  
                
                  a form via {{$audit->url}} <br>
                  
                  </li>
                  
                
                  </ul>

                  @endforeach
    
                </div>

                <br>
                <div> {{ $audits->Links() }}   </div>


            <div class="modal fade" id="addaudit" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Date Range</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                <form action="/officer/audit/export" method="POST"> 
                   @csrf

                    <div class="form-group">
                      <label class="col-form-label">Start date:</label>
                      <input class="form-control" type="date" id="sdate" name="sdate">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">End date:</label>
                        <input class="form-control" type="date" id="edate" name="edate">
                      </div>

                    <div class="form-group">
                      <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success btn-round">Add</button>
                    </div>
                
                  </form>
                </div>
                
              </div>
            </div>
          </div>


              </body> 

          </div>
          </div>
        </div>
      </div>
             
  </div>
  </div>
@endsection

@section('scripts')
<script>
function myFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>
@endsection