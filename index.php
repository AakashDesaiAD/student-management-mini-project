<?php
	include 'Student.php';
	if ($_SERVER['REQUEST_METHOD'] === "POST") {
		$student = new Student();
		$response = $student->insertStudent($_POST);

		if ($response['status'] === true) {
			echo "<pre>"; print_r('true'); exit;
		} else {
			echo "<pre>"; print_r('false'); exit;
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Student Management</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
	<section class="d-flex flex-column m-5">
		<button class="btn btn-primary" style="width: max-content;" data-toggle="modal" data-target="#addStudentModel">Add Student</button>
		<div class="my-4">
			<table class="table">
				<tr>
					<th>ID</th>
					<th>Name</th>
				</tr>
			</table>
		</div>
	</section>


	<section>
		<div class="modal fade" id="addStudentModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Add new student</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <form method="POST" action="<?=$_SERVER['PHP_SELF'];?>">
				  <div class="form-group">
				    <label for="studentName">Student name</label>
				    <input type="text" class="form-control" id="studentName" name="studentName" required>
				  </div>
				  <div class="form-group">
				    <label for="studentClass">Class</label>
				    <select class="form-control" name="studentClass" required>
				    	<option value="a">A</option>
				    	<option value="b">B</option>
				    	<option value="c">C</option>
				    	<option value="d">D</option>
				    </select>
				  </div>
				  <div class="form-group">
				    <label for="phone">Phone number</label>
				    <input type="text" class="form-control" id="phone" name="phone" required>
				  </div>
				  <div class="form-group">
				    <label for="gender">Gender</label>
				    <select class="form-control" name="gender" required>
				    	<option value="m">Male</option>
				    	<option value="f">Female</option>
				    </select>
				  </div>
				  <div class="form-group">
				    <label for="email">Email</label>
				    <input type="text" class="form-control" id="email" name="email" required>
				  </div>
				  <div class="d-flex justify-content-center flex-column align-items-center">
				  	<button type="submit" class="btn btn-primary my-2 w-50">Save Student</button>
		        	<button type="button" class="btn btn-secondary w-50" data-dismiss="modal">Close</button>
				  </div>
				</form>
		      </div>
		    </div>
		  </div>
		</div>
	</section>
</body>
</html>