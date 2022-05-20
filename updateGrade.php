<?php
	include 'DbConnection.php';
	include 'Grade.php';

	if ($_SERVER['REQUEST_METHOD'] === "POST") {
		$gradeData['student_id'] = $_POST['student_id'];
		$gradeData['chemistry'] = $_POST['chemistry'];
		$gradeData['maths'] = $_POST['maths'];
		$gradeData['physics'] = $_POST['physics'];

		$grade = new Grade();
		$response = $grade->updateGrade($gradeData);
		if ($response) {
			echo json_encode($response);
		} else {
			echo json_encode($response);
		}
	}
?>