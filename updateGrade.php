<?php
	include 'Errors.php';
	include 'Student.php';
	$student = new Student();

	if ($_SERVER['REQUEST_METHOD'] === "POST") {
		if ( array_key_exists('subjectFilter', $_POST) ) {
			$fieldName = "subjects[".$_POST['studentId']."][".$_POST['subjectName']."]";
			$response = '<tr>
				<td id="subjectName-'.$_POST["studentId"].'">A</td>
				<td>'.$_POST["subjectName"].'</td>
				<td>
					<span class="y-1">
						<input type="radio" name="'.$fieldName.'" value="G"> G
						<input type="radio" name="'.$fieldName.'" value="V"> V
						<input type="radio" name="'.$fieldName.'" value="E"> E
						<input type="radio" name="'.$fieldName.'" value="A"> A
						<input type="radio" name="'.$fieldName.'" value="F"> F
					</span>
				</td>
			</tr>';

			echo $response;
		} else if ( array_key_exists('saveGrade', $_POST) ) {

			$response = [];
			$gradeData = [];

			if (array_key_exists('subjects', $_POST)) {
				foreach ($_POST['subjects'] as $id => $subjectArray) {
					$gradeData[$id]['student_id'] = $id;
					foreach ($subjectArray as $subjectName => $grade) {
						$gradeData[$id]['subjects'][] = ['grade' => $grade, 'subjectName' => $subjectName];
					}
				}
			}

			foreach ($gradeData as $key => $value) {
				$response['subjects'] = $student->saveGrade($value);
			}

			if (array_key_exists('student_grade', $_POST)) {
				$response['studentGrade'] = $student->saveStudentGrade($_POST['student_grade']);
			}
			echo "<pre>"; print_r($response); exit;
			header("Location: http://task.site");
		}
	}
?>