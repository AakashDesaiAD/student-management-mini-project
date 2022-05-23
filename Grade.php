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
	        $data->free();
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
	    	$log = [];
	    	if (array_key_exists('chemistry', $data)) {
				foreach ($data['chemistry'] as $studentId => $grade) {
					$query = "UPDATE grades SET chemistry = '{$grade}' WHERE student_id = {$studentId}";
	        		if ($this->connection->query($query) == TRUE) {
	        			$log['chemistry'][$studentId] = "Grade set to ".$grade;
	        		} else {
	        			$log['chemistry'][$studentId] = $this->connection->error;
	        		}
				}
			}

			if (array_key_exists('maths', $data)) {
				foreach ($data['maths'] as $studentId => $grade) {
					$query = "UPDATE grades SET maths = '{$grade}' WHERE student_id = {$studentId}";
					if ($this->connection->query($query) == TRUE) {
	        			$log['maths'][$studentId] = "Grade set to ".$grade;
	        		} else {
	        			$log['maths'][$studentId] = $this->connection->error;
	        		}
	        	}
			}

			if (array_key_exists('physics', $data)) {
				foreach ($data['physics'] as $studentId => $grade) {
					$query = "UPDATE grades SET physics = '{$grade}' WHERE student_id = {$studentId}";
	        		if ($this->connection->query($query) == TRUE) {
	        			$log['physics'][$studentId] = "Grade set to ".$grade;
	        		} else {
	        			$log['physics'][$studentId] = $this->connection->error;
	        		}
				}
			}
			return $log;
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
	}
?>