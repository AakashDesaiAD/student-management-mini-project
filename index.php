<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	include 'Student.php';
	$student = new Student();
	$studentData = [];
	$studentFilter = false;

	if ($_SERVER['REQUEST_METHOD'] === "POST") {
		if (array_key_exists('studentAdd', $_POST)) {
			$response = $student->insertStudent($_POST);
			$studentData = $student->getAllStudent();
		} else if ($_POST['studentFilter'] == true && array_key_exists('students', $_POST)) {
			$ids = implode(",",$_POST['students']);
			$studentData = $student->getStudentById($ids);
			$studentFilter = true;
		}
	} else {
		$studentData = $student->getAllStudent();
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
		<div class="d-flex justify-content-between">
			<button class="btn btn-primary" style="width: max-content;" data-toggle="modal" data-target="#studentFilter">Select Student</button>
			<button class="btn btn-primary" style="width: max-content;" data-toggle="modal" data-target="#addStudentModel">Add Student</button>
		</div>
		<div class="my-4">
			<table class="table">
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>Grades</th>
				</tr>
				<?php foreach($studentData as $key => $s) { ?>
				<tr>
					<td><?=$s['id'] ?></td>
					<td><?=$s['name'] ?></td>
					<td><?=$s['email'] ?></td>
					<td>
						<button class="btn btn-md btn-warning" data-toggle="modal" data-target="#modal-<?=$s['id'] ?>">View</button>
					</td>
				</tr>
					<?php } ?>
			</table>
		</div>
	</section>

	<section>
		<!-- new student add -->
		<div class="modal fade" id="addStudentModel" tabindex="-1" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Add new student</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <form method="POST" action="<?=$_SERVER['PHP_SELF'];?>">
		        	<input type="hidden" name="studentAdd" value="true">
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

		<!-- student filter -->
		<div class="modal fade" id="studentFilter" tabindex="-1" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Filter student</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <form method="POST" action="<?=$_SERVER['PHP_SELF'];?>">
		        	<input type="hidden" name="studentFilter" value="true">
					<table class="table">
						<tr>
							<th>Select</th>
							<th>ID</th>
							<th>Name</th>
						</tr>
						<?php foreach($studentData as $key => $s) { ?>
						<tr>
							<td><input type="checkbox" name="students[]" value="<?=$s['id']?>"></td>
							<td><?=$s['id']?></td>
							<td><?=$s['name']?></td>
						</tr>
						<?php } ?>
					</table>

					<div class="d-flex justify-content-center flex-column align-items-center">
				  		<button type="submit" class="btn btn-primary my-2 w-50">Filter</button>
		        		<a href="/" class="btn btn-secondary w-50">Show All</a>
				  </div>
				</form>
		      </div>
		    </div>
		  </div>
		</div>
	</section>

	<!-- subject modal -->
	<section>
	<?php foreach($studentData as $key => $s) { ?>
		<div class="modal fade" id="modal-<?=$s['id']?>" tabindex="-1" role="dialog" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Grades - <?=$s['name']?></h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<h1>All grades to be shown here</h1>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-primary">Save changes</button>
		      </div>
		    </div>
		  </div>
		</div>
	<?php } ?>
	</section>
</body>
</html>