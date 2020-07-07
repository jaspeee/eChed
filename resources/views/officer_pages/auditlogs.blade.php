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
             
              <div class="list-group">
                  
                  @foreach($audits as $audit)
                  
                  <ul class="list-group list-group-flush">
                 
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

              </body>

          </div>
          </div>
        </div>
      </div>
             
  </div>
  </div>
@endsection

@section('scripts')
@endsection