<?php
	include 'DbConnection.php';
	include 'Grade.php';

	class Student extends DbConnection
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function getAllStudent() 
	    { 
	    	$allStudents = [];
	        $query = "SELECT * FROM student"; 
	        $data = $this->connection->query($query);
	        while ($s = $data->fetch_assoc()) {
		        $allStudents[$s['id']]['id'] = $s['id'];
		        $allStudents[$s['id']]['name'] = $s['name'];
		        $allStudents[$s['id']]['class'] = $s['class'];
		        $allStudents[$s['id']]['phone'] = $s['phone'];
		        $allStudents[$s['id']]['gender'] = $s['gender'];
		        $allStudents[$s['id']]['email'] = $s['email'];
	        }
	        $data->free();
	        return $allStudents;
	    }

	    public function getStudentById($ids) 
	    { 
	    	$allStudents = [];
	        $query = "SELECT * FROM student WHERE id IN({$ids})";
	        $data = $this->connection->query($query);
	        while ($s = $data->fetch_assoc()) {
		        $allStudents[$s['id']]['id'] = $s['id'];
		        $allStudents[$s['id']]['name'] = $s['name'];
		        $allStudents[$s['id']]['class'] = $s['class'];
		        $allStudents[$s['id']]['phone'] = $s['phone'];
		        $allStudents[$s['id']]['gender'] = $s['gender'];
		        $allStudents[$s['id']]['email'] = $s['email'];
	        }
	        $data->free();
	        return $allStudents;
	    }

	    public function insertStudent($data)
	    {

	    	$response = [];
	    	$name = $data['studentName'];
	    	$stClass = $data['studentClass'];
	    	$phone = $data['phone'];
	    	$gender = $data['gender'];
	    	$email = $data['email'];

	    	$sql = "INSERT INTO student (id, name, class, phone, gender, email) VALUES (NULL, '{$name}', '{$stClass}', '{$phone}', '{$gender}', '{$email}')";

	    	if ($this->connection->query($sql) === TRUE) {
	    		$response['status'] = true;
	    	} else {
	    		$response['status'] = false;
	    		$response['log'] = $this->connection->error;
	    	}
	    	return $response;
	    }

	    public function saveStudentGrade($data)
	    {	
	    	$response = [];
	    	foreach ($data as $id => $grade) {
				$sql = "UPDATE student SET grade = '{$grade}' WHERE id = {$id}";
				if ($this->connection->query($sql) == TRUE) {
					$response[$id] = "Success";
				} else {
					$response[$id] = $this->connection->error;
				}
	    	}
	    	return $response;
	    }

	    public function saveGrade($data)
	    {
	    	$response = [];
	    	$id = $data['student_id'];
	    	foreach ($data['subjects'] as $key => $value) {
	    		$grade = $value['grade'];
	    		$subject = $value['subjectName'];
	    		$sql = "INSERT INTO grades (id, subject_name, grade, student_id) VALUES (NULL, '{$subject}', '{$grade}', {$id})";
	    		if ($this->connection->query($sql) == TRUE) {
					$response[$subject] = "Success";
				} else {
					$response[$subject] = $this->connection->error;
				}
	    	}
	    	return $response;
	    }
	}
?>