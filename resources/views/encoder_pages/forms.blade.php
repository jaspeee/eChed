@extends('layouts.layout_encoder', [
    'namePage' => 'Forms',
    'fname' => $fname,
    'lname' => $lname,
    'pass' => '/encoder/password',
    'class' => 'sidebar-mini',
    'activePage' => 'forms',
  
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
            {{-- <p>Data Collection Forms For {{$institution_name}}</p> --}}
            
              
              @if($institution_type == '1')
              <p style="font-size:18px;"><b>Data Collection Forms For State Universities and Colleges</b></p>
              @else
              <p style="font-size:18px;"><b>Data Collection Forms For Non-State Universities and Colleges</b></p>
              @endif
 
              <p style="font-size:13px;">Download Form : Please download the forms below and fill them out.</p>
              <div class="notice" style="color:red;margin-top:-15px;font-size: 13px;">Notice : Make sure to only use the download forms below. Do not modify the file name, it will cause an inaccurate reading of the data.</div>
                <br>
                <div class="list-group">
                  
                    @foreach($forms as $form)
                    
                   <ul class="list-group list-group-flush">
                 
                    <a href="/encoder/audit/{{$form->form}}" style="text-decoration-line: none;">
                     <li class="list-group-item list-group-item-action">
                        <i class="now-ui-icons arrows-1_cloud-download-93"></i> &nbsp&nbsp {{$form->description}} <b>({{$form->form}})</b>
                      </li>
                    </a>
                    
                  
                    </ul>
                   
                   @endforeach
      
                  </div>
            </div>
           

          </div>
        </div>
      </div>
      
    </div>
                 
  </div>
@endsection