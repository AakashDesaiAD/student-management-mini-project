<?php
	include 'DbConnection.php';

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
	}
?>