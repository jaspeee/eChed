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
    
    <!-- @if (count($errors) > 0)
    <div class="alert alert-danger" style="line-height: 2px; padding-top:3%; padding-bottom:1%;">
      <p>There were some problems with your File input.</p>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>  
    </div>
    @endif

      @if(session('success'))
      <div class="alert alert-success" id="suc">
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
      @endif -->
      
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            {{-- <h4 class="card-title"> Simple Table</h4> --}}
          </div>
          <div class="card-body">
             
            

            <div class="container" style="padding:40px;"> 
                <p style="font-size:18px;"><b>Upload Forms to Validate</b></p>
                <p style="font-size:13px;">Upload Form : Click on "Browse" button to upload files. Click "Upload" button when file selection is completed.
                <div class="notice" style="color:red;margin-top:-15px;font-size: 13px;">Notice : Make sure to upload Excel files (.xlsx) only. Do not modify the file name, it will cause an inaccurate reading of the data.</div>

              </p>
              
              <hr>
              <br>
                <form method="post" action="" id="form" class="form-horizontal" enctype="multipart/form-data">
              @csrf 
                <input type="file" name="file[]" id="file" multiple>
                
                
                <div id="selectedFiles" style="padding-top:2%;padding-bottom:%"></div>

                <input type="submit" onclick="return confirmation();" class="btn btn-success btn-round" value="Upload">
               <br><br>
               <!-- <div class="progress" style="position:relative; width:100%; height:30px;">
                  <div class="bar" style="background-color: #2da62d; width:0%; border-radius: 3px;"></div >
                  <div class="percent" style="position:absolute; display:inline-block; top:3px; left:48%;">0%</div >

                </div>  -->
                
            </form>  

        
                 
  </div>
@endsection

@section('scripts')
<script type="text/javascript">


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


function confirmation(){
    if(confirm('Are you sure you want to upload this forms?')){
        submit();
    }else{
        return false;
    }   
}

// function validate(formData, jqForm, options) {
//         var form = jqForm[0];
//         if (!form.file.value) {
//             alert('File not found');
//             return false;
//         }
//     }
 
//     (function() {
 
//     var bar = $('.bar');
//     var percent = $('.percent');
//     var status = $('#status');
    
  
      
//     $('form').ajaxForm({
//         beforeSubmit: validate,
//         beforeSend: function() {
//             status.empty();
//             var percentVal = '0%';
//             var posterValue = $('input[name=file]').fieldValue();
//             bar.width(percentVal)
//             percent.html(percentVal);
//         },
//         uploadProgress: function(event, position, total, percentComplete) {
//             var percentVal = percentComplete + '%';
//             bar.width(percentVal)
//             percent.html(percentVal);
//         },
//         success: function() {
//             var percentVal = 'Saving';
//             bar.width(percentVal)
//             percent.html(percentVal);
//         },
//         complete: function(xhr) {
//             status.html(xhr.responseText);
//             alert('Uploaded Successfully');
//             window.location.href = "/encoder/upload";
//         }
//     });
     
//     })();





</script>
@endsection