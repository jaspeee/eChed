@extends('layouts.layout_encoder', [
    'namePage' => 'Upload Documents',
    'fname' => $fname,
    'lname' => $lname,
    'pass' => '/encoder/password',
    'class' => 'sidebar-mini',
    'activePage' => 'upload',
  ])

@section('content')

  <div class="panel-header panel-header-sm">
  </div>
  <div class="content"> 
    
    @if (count($errors) > 0)
    <div class="alert alert-danger" style="line-height: 2px; padding-top:3%; padding-bottom:1%;">
      <p>There were some problems with your File input.</p>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif

      @if(session('success'))
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        {{ session('success') }}
      </div> 

      @elseif(session('danger'))
      <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        {{ session('danger') }}
      </div> 
      @endif
      
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            {{-- <h4 class="card-title"> Simple Table</h4> --}}
          </div>
          <div class="card-body">
             
            

            <div class="container" style="padding:40px;"> 
                <p style="font-size:18px;"><b>Upload Forms to Validate</b></p>
                <p style="font-size:13px;">Upload Form : Click on " Choose Files " to choose file to upload and click the button Upload</p>
            
                <form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
              @csrf 
                <input type="file" name="file[]" id="file" multiple>
                
                
                <div id="selectedFiles" style="padding-top:2%;padding-bottom:%"></div>

                <input type="submit" class="btn btn-info" value="Upload">

                
            </form> 



          </div>
        </div>
      </div>
      
                 
  </div>
@endsection

@section('scripts')
<script  type="text/javascript">
// // Add the following code if you want the name of the file appear on select
// $(".custom-file-input").on("change", function() {
//   var fileName = $(this).val().split("\\").pop();
//   $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
// });




var selDiv = "";
		
	document.addEventListener("DOMContentLoaded", init, false);
	
	function init() {
		document.querySelector('#file').addEventListener('change', handleFileSelect, false);
		selDiv = document.querySelector("#selectedFiles");
	}
		
	function handleFileSelect(e) {
		
		if(!e.target.files) return;
		
		selDiv.innerHTML = "";
		
		var files = e.target.files;
		for(var i=0; i<files.length; i++) {
			var f = files[i];
			
			selDiv.innerHTML += f.name + "<br/>";

		}
		
	}
  

$(document).ready(function() {


$(".btn-success").click(function(){ 
    var html = $(".clone").html();
    $(".increment").after(html);
});

$("body").on("click",".btn-danger",function(){ 
    $(this).parents(".control-group").remove();
});

});




</script>
@endsection