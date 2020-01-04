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

                <table class="table">
                    <thead style="background-color: #003471; font-size: 10px;color:white;">
                      <tr>
                        <th><b>Form</b></th>
                        <th><b>Date Verified</b></th>
                        <th><b>Verified by</b></th>
                        <th><b>Actions</b></th>
                      </tr>
                    </thead>
                    <tbody>
                          @foreach($files as $file)
                          <tr>
                              <td>{{$file->validator_submission}}</td>
                              <td>{{$file->created_at}}</td>
                              <td>{{$file->first_name}} &nbsp {{$file->last_Name}}</td>
                    

                              <td style="padding:0;">
                              <a href="/storage/verify/{{$file->validator_submission}}" download><button type="submit" style="background-color: transparent;border: none;cursor:pointer;"><i class="fa fa-download" aria-hidden="true" style="color:#696969;font-size: 15px;" data-toggle="tooltip" data-placement="top" title="download"></i></button></a>
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