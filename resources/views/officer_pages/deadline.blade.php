@extends('layouts.layout_officer', [
    'namePage' => 'Set Deadline',
    'fname' => $fname,
    'lname' => $lname,
    'pass' => '/officer/password',
    'class' => 'sidebar-mini',
    'activePage' => 'deadline',
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

              <p style="font-size:18px;"><b>Set the Deadline for Submission</b></p>
              <p style="font-size:13px;color:red;">
                  Notice : Once the deadline has been set, it will automatically establish the 
                  new school year submission and dismiss the past data
                  . Kindly review carefully before confirming.
                </p>
              <hr>
              <br>

              <form method="post" action="/officer/deadline/add" style="padding:4%;">
                {{method_field('patch')}}
                @csrf 
 
                <div class="form-group">
                  <label>Note</label>
                  <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                </div>
                <br>
                <div class="form-group" style="width: 40%;">
                  <label>Set Date</label>
                  <input class="form-control" type="date" id="date" name="date">
                </div>

                <div class="form-group">
                  <input type="submit" class="btn btn-info" value="Set Deadline">
                </div>

              </form>


           </div>

          </div>
        </div>
      </div>
      
                 
  </div>
@endsection