<?php
	class Grade extends DbConnection
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function getGradeById($id) 
	    { 
	    	$grades = [];
	        $query = "SELECT * FROM grades WHERE id = '{$id}'"; 
	        $data = $this->connection->query($query);
	        while ($g = $data->fetch_assoc()) {
	        	$grades[$g['id']]['id'] = $g['id'];
	        	$grades[$g['id']]['chemistry'] = $g['chemistry'];
	        	$grades[$g['id']]['maths'] = $g['maths'];
	        	$grades[$g['id']]['physics'] = $g['physics'];
	        }
	        return $grades;
	    }

	    public function insertGrade($data)
	    {
	    	$sid = $data['student_id'];
		    $ch = $data['chemistry'];
		    $mt = $data['maths'];
		    $ph = $data['physics']; 

	    	$response = false;
	    	$query = "INSERT INTO grades (id, chemistry, maths, physics, student_id) VALUES (NULL, '{$ch}', '{$mt}', '{$ph}', {$sid})";
	        if ($this->connection->query($query) == true) {
	        	$response['status'] = true;
	        } else {
	        	$response['status'] = false;
	    		$response['log'] = $this->connection->error;
	        }
	        return $response;
	    }

	   	public function updateGrade($data)
	    {
	    	$sid = $data['student_id'];
		    $ch = $data['chemistry'];
		    $mt = $data['maths'];
		    $ph = $data['physics']; 

	    	$response = false;
	    	$query = "UPDATE grades SET chemistry = '{$ch}', maths = '{$mt}', physics = '{$ph}' WHERE student_id = {$sid};";
	        if ($this->connection->query($query) == true) {
	        	$response['status'] = true;
	        } else {
	        	$response['status'] = false;
	    		$response['log'] = $this->connection->error;
	        }
	        return $response;
	    }
	}
?>