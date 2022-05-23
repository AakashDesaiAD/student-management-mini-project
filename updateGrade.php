<?php
	include 'DbConnection.php';
	include 'Grade.php';
	$grade = new Grade();

	if ($_SERVER['REQUEST_METHOD'] === "POST") {
		if ( array_key_exists('subjectFilter', $_POST) ) {
			$response = '';
			if ($_POST['chemistry']) {
				$response .= '<tr>
					<td>A</td>
					<td>Chemistry</td>
					<td>
						<span class="y-1">
							<input type="radio" name="chemistry['.$_POST["studentId"].']" value="G"> G
							<input type="radio" name="chemistry['.$_POST["studentId"].']" value="V"> V
							<input type="radio" name="chemistry['.$_POST["studentId"].']" value="E"> E
							<input type="radio" name="chemistry['.$_POST["studentId"].']" value="A"> A
							<input type="radio" name="chemistry['.$_POST["studentId"].']" value="F"> F
						</span>
					</td>
				</tr>';
			}

			if($_POST['maths']) {
				$response .= '<tr>
					<td>B</td>
					<td>Maths</td>
					<td>
						<span class="y-1">
							<input type="radio" name="maths['.$_POST["studentId"].']" value="G"> G
							<input type="radio" name="maths['.$_POST["studentId"].']" value="V"> V
							<input type="radio" name="maths['.$_POST["studentId"].']" value="E"> E
							<input type="radio" name="maths['.$_POST["studentId"].']" value="A"> A
							<input type="radio" name="maths['.$_POST["studentId"].']" value="F"> F
						</span>
					</td>
				</tr>';
			}

			
			if($_POST['physics']) {
				$response .= '<tr>
					<td>C</td>
					<td>Physics</td>
					<td>
						<span class="y-1">
							<input type="radio" name="physics['.$_POST["studentId"].']" value="G"> G
							<input type="radio" name="physics['.$_POST["studentId"].']" value="V"> V
							<input type="radio" name="physics['.$_POST["studentId"].']" value="E"> E
							<input type="radio" name="physics['.$_POST["studentId"].']" value="A"> A
							<input type="radio" name="physics['.$_POST["studentId"].']" value="F"> F
						</span>
					</td>
				</tr>';
			}

			echo $response;
		} else if ( array_key_exists('saveGrade', $_POST) ) {
			$response = [];
			$response['subjectGrade'] = $grade->updateGrade($_POST);
			if (array_key_exists('student_grade', $_POST)) {
				$response['studentGrade'] = $grade->saveStudentGrade($_POST['student_grade']);
			}
			header("Location: http://task.site");
		}
	}
?>