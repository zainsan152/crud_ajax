<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Cormorant+Unicase" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Cormorant+Unicase|Eater" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Anton|Cormorant+Unicase" rel="stylesheet">
</head>
<body>

<h1 class="text-center text-uppercase display-4 font-weight-bold" style="background-color: #74B3CE; color: white; font-family: 'Cormorant Unicase', serif;"> Ajax crud Operation 2018 </h1>
<div class="container">
	
  <h2 style="background-color: #1e3928 ; color: white; font-size: 38px; font-family: 'Anton', sans-serif;" class="text-uppercase text-center"> create INSERT SELECT UPDATE DELETE ALL IN ONE VIDEO :) </h2>
	<div class="d-flex flex-row justify-content-end ">
		<button type="button" class="btn btn-warning text-white" data-toggle="modal" data-target="#myModal">
		 Click To Insert
		</button>
	</div>

	<div >
		<h2 style="color: #062f4f; font-family: 'Cormorant Unicase', serif;" class="font-weight-bold mb-4"> All Records </h2>
		<div id="records_content">	</div>
	</div>
  

</div>

<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       
      	<div class="form-group">
      		<label>  User Name: </label>
      		<input type="text" name="firstname" id="firstname" placeholder="First Name" class="form-control">
      	</div>

      	<!-- <div class="form-group">
      		<label> Last Name </label>
      		<input type="text" name="lastname" id="lastname" placeholder="Last Name" class="form-control">
      	</div> -->

      	<div class="form-group">
      		<label> Email Id </label>
      		<input type="text" name="email" id="email" placeholder="Email Id" class="form-control">
      	</div>

      	<div class="form-group">
      		<label> Mobile No. </label>
      		<input type="text" name="mobile" id="mobile" placeholder="Mobile No." class="form-control">
      	</div>



      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="addRecord()">Save</button>

         <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>



    </div>
  </div>
</div>


<!-- //////////////// after update ////////////////// -->
<div class="modal fade" id="update_user_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       
      		<div class="form-group">
      		<label> User Name </label>
      		<input type="text" name="firstname" id="update_firstname" placeholder="First Name" class="form-control">
      	</div>

      <!-- 	<div class="form-group">
      		<label> Last Name </label>
      		<input type="text" name="lastname" id="update_lastname" placeholder="Last Name" class="form-control">
      	</div> -->

      	<div class="form-group">
      		<label> Email Id </label>
      		<input type="text" name="email" id="update_email" placeholder="Email Id" class="form-control">
      	</div>

      	<div class="form-group">
      		<label> Mobile No. </label>
      		<input type="text" name="mobile" id="update_mobile" placeholder="Mobile No." class="form-control">
      	</div>



      </div>

      <!-- Modal footer -->
     <div class="modal-footer">
	                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	                <button type="button" class="btn btn-primary" onclick="UpdateUserDetails()" >Update</button>
	                <input type="hidden" id="hidden_user_id">
	 </div>



    </div>
  </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

<script>
	
$(document).ready(function () {
    readRecords(); 
	});

	function addRecord(){

		var firstname =  $("#firstname").val();
		var lastname =  $("#lastname").val();
		var email =  $("#email").val();
		var mobile =  $("#mobile").val();

		$.ajax({

			url:"backend.php",
			type:'POST',
			data: {
				firstname:firstname,
				lastname:lastname,
				email:email,
				mobile:mobile,
			},
			success:function(data, status){
				readRecords();
			},

		});

	}

//////////////////Display Records
	function readRecords(){
		
		var readrecords = "readrecords";
		$.ajax({
			url:"backend.php",
			type:"POST",
			data:{readrecords:readrecords},
			success:function(data,status){
				$('#records_content').html(data);
			},

		});
	}


/////////////delete userdetails ////////////
function DeleteUser(deleteid){

	var conf = confirm("are u sure");
	if(conf == true) {
	$.ajax({
		url:"backend.php",
		type:'POST',
		data: {  deleteid : deleteid},

		success:function(data, status){
			readRecords();
		}
	});
	}
}



function GetUserDetails(id){
	  $("#hidden_user_id").val(id);
	  $.post("backend.php", {
            id: id
        },
        function (data, status) {
            alert(data);
            //JSON.parse() parses a string, written in JSON format, and returns a JavaScript object.
            var user = JSON.parse(data);
            alert(user);

            $("#update_firstname").val(user.firstname);
            $("#update_lastname").val(user.lastname);
            $("#update_email").val(user.email);
            $("#update_mobile").val(user.mobile);
        }
    );
    $("#update_user_modal").modal("show");
}




function UpdateUserDetails() {
    var firstname = $("#update_firstname").val();
    var lastname = $("#update_lastname").val();
    var email = $("#update_email").val();
    var mobile = $("#update_mobile").val();
    var hidden_user_id = $("#hidden_user_id").val();
    $.post("backend.php", {
            hidden_user_id: hidden_user_id,
            firstname: firstname,
            lastname: lastname,
            email: email,
            mobile: mobile
        },
        function (data, status) {
            $("#update_user_modal").modal("hide");
            readRecords();
        }
    );
}

</script>

</body>
</html>