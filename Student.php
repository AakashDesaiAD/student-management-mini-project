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
	        $query = "SELECT * FROM student"; 
	        $data = $this->connection->query($query);
	        return $data;
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