<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	include 'Student.php';
	$grade = new Grade();
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
	<section class="d-flex flex-column m-5">
		<div class="d-flex justify-content-between">
			<button class="btn btn-primary" style="width: max-content;" data-toggle="modal" data-target="#studentFilter">Select Student</button>
			<button class="btn btn-primary" style="width: max-content;" data-toggle="modal" data-target="#addStudentModel">Add Student</button>
		</div>
		<div class="my-4">
			<form action="updateGrade.php" method="POST">
				<table class="table table-bordered ">
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Grade</th>
					</tr>
					<?php foreach($studentData as $key => $s) { ?>
					<tr id="subject-div-<?=$s['id'] ?>">
						<td><?=$s['id'] ?></td>
						<td class="d-flex flex-column">
							<?=$s['name'] ?>
							<span class="btn btn-primary" style="width:max-content" data-toggle="modal" data-target="#subjectFilter-<?=$s['id'] ?>">Select subject</span>
						</td>
						<td>
							<span class="y-1">
								<input type="radio" name="student_grade[<?=$s['id']?>]" value="G"> G
								<input type="radio" name="student_grade[<?=$s['id']?>]" value="V"> V
								<input type="radio" name="student_grade[<?=$s['id']?>]" value="E"> E
								<input type="radio" name="student_grade[<?=$s['id']?>]" value="A"> A
								<input type="radio" name="student_grade[<?=$s['id']?>]" value="F"> F
							</span>
						</td>
					</tr>
					<?php } ?>
				</table>
				<input type="submit" name="subjectFilterSubmit" id="subjectFilterSubmit" class="btn btn-success" value="Save Data">
				<input type="hidden" name="saveGrade" value="true">
			</form>
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

		<!-- subject filter -->
	<?php foreach($studentData as $key => $s) { ?>
		<div class="modal fade" id="subjectFilter-<?=$s['id'] ?>" tabindex="-1" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Filter Subject-<?=$s['name'] ?> </h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <form id="subject-form-<?=$s['id']?>">
					<table class="table">
						<tr>
							<th>Select</th>
							<th>ID</th>
							<th>Name</th>
						</tr>
						<tr>
							<td><input type="checkbox" name="chemistry"></td>
							<td>1</td>
							<td>Chemistry</td>
						</tr>
						<tr>
							<td><input type="checkbox" name="maths"></td>
							<td>2</td>
							<td>Maths</td>
						</tr>
						<tr>
							<td><input type="checkbox" name="physics"></td>
							<td>3</td>
							<td>physics</td>
						</tr>
					</table>
					<input type="hidden" name="studentId" value="<?=$s['id']?>">
					<input type="hidden" name="subjectFilter" value="true">

					<div class="d-flex justify-content-center flex-column align-items-center">
				  		<button type="submit" class="btn btn-primary my-2 w-50">Filter</button>
				  		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				  </div>
				</form>
		      </div>
		    </div>
		  </div>
		</div>
		<script type="text/javascript">
			$("#subject-form-<?=$s['id']?>").submit(function (e) {	
				e.preventDefault();
				$.ajax({
				    url: 'updateGrade.php',
				    method: "POST",
				    data: $(this).serialize(),
				    success: function (response) {
						$("#subject-div-<?=$s['id']?>").after(response)
				    }
				});
			});
		</script>
	<?php } ?>
	</section>

</body>
</html>